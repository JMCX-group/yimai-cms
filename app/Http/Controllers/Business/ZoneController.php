<?php

namespace App\Http\Controllers\Business;

use App\Patient;
use App\PatientBank;
use App\PatientWithdrawRecord;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "合作专区";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = PatientWithdrawRecord::application();
        $page_title = "申请提现";
        $page_level = $this->page_level;

        return view('zones.index', compact('records', 'page_title', 'page_level'));
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
        $record = PatientWithdrawRecord::find($id);

        $patients = Patient::getOnePatient($record->patient_id);
        $bank = PatientBank::find($record->withdraw_bank_id);
        if (!$bank) {
            $bank = new  PatientBank();
        }

        $page_title = "提现处理";
        $page_level = $this->page_level;

        return view('zones.edit', compact('record', 'patients', 'bank', 'page_title', 'page_level'));
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
        $record = PatientWithdrawRecord::find($id);
        $record->status = 'completed'; //提现状态：start为未提现，completed为成功，end为关闭
        $record->withdraw_confirm_date = date('Y-m-d H:i:s');

        try {
            if ($record->save()) {
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
        $records = PatientWithdrawRecord::completed();
        $page_title = "已提现";
        $page_level = $this->page_level;

        return view('zones.completed', compact('records', 'page_title', 'page_level'));
    }
}
