<?php

namespace App\Http\Controllers\Business;

use App\Doctor;
use App\Order;
use App\SettlementRecord;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "税务管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settlements = SettlementRecord::getSettlementRecord();
        $page_title = "待缴税";
        $page_level = $this->page_level;

        return view('taxs.index', compact('settlements', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settlement = SettlementRecord::find($id);
        $doctors = Doctor::getOneDoctor($settlement['attributes']['doctor_id']);
        $page_title = "申报缴税";
        $page_level = $this->page_level;

        return view('Taxs.edit', compact('settlement', 'doctors', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $settlement = SettlementRecord::find($id);
        $settlement->tax_payment = $request['tax-payment'];
        $settlement->tax_time = date('Y-m-d H:i:s');
        $settlement->status = 1; //结算状态； 0：未缴税；1：已完成结算，可提现

        try {
            if ($settlement->save()) {
                /**
                 * 更新可提现的订单状态：
                 */
                $settlementIdList = Order::allPending($settlement->doctor_id, $settlement->year, $settlement->month);
                Order::whereIn('id', $settlementIdList)
                    ->update(['settlement_status' => '可提现']); //settlement_status：结算状态:待结算、可提现

                return redirect()->route('tax.index')->withSuccess('报税成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '更新数据失败'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
