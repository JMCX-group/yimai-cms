<?php

namespace App\Http\Controllers\Business;

use App\Doctor;
use App\DoctorBank;
use App\Order;
use App\SettlementRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "提现管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settlements = SettlementRecord::getWithdrawRecord();
        $page_title = "已申请提现";
        $page_level = $this->page_level;

        return view('withdraws.index', compact('settlements', 'page_title', 'page_level'));
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

        $doctorId = $settlement['attributes']['doctor_id'];
        $doctors = Doctor::getOneDoctor($doctorId);

        $bankId = $settlement['attributes']['withdraw_bank_no'];
        $bank = DoctorBank::find($bankId);

        $page_title = "提现处理";
        $page_level = $this->page_level;

        return view('withdraws.edit', compact('settlement', 'doctors', 'bank', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $settlement = SettlementRecord::find($id);
        $settlement->withdraw_status = 9; //提现状态，是否已提现；0为未提现，1为申请提现，9为成功
        $settlement->withdraw_confirm_date = date('Y-m-d H:i:s');

        try {
            if ($settlement->save()) {
                /**
                 * 更新已提现的订单状态：
                 */
                $settlementIdList = Order::allPending($settlement->doctor_id, $settlement->year, $settlement->month);
                Order::whereIn('id', $settlementIdList)
                    ->update(['settlement_status' => '已提现']); //settlement_status：结算状态:待结算、可提现

                return redirect()->route('withdraw.index')->withSuccess('转账信息更新成功');
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function completed()
    {
        $settlements = SettlementRecord::getWithdrawRecord(9);
        $page_title = "已提现列表";
        $page_level = $this->page_level;

        return view('withdraws.completed', compact('settlements', 'page_title', 'page_level'));
    }
}
