<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "财务管理";

        return view('finances.index', compact('page_title'));
    }

    public function setting()
    {
        $page_title = "收费设置";

        return view('finances.index', compact('page_title'));
    }

    public function pendingSettlement()
    {
        $page_title = "待结算";

        return view('finances.index', compact('page_title'));
    }

    public function pendingTax()
    {
        $page_title = "待报税";

        return view('finances.index', compact('page_title'));
    }

    public function settled()
    {
        $page_title = "已结算";

        return view('finances.index', compact('page_title'));
    }

    public function pendingWithdrawals()
    {
        $page_title = "待提现";

        return view('finances.index', compact('page_title'));
    }

    public function completedWithdrawals()
    {
        $page_title = "已提现";

        return view('finances.index', compact('page_title'));
    }

    public function recharge()
    {
        $page_title = "充值";

        return view('finances.index', compact('page_title'));
    }

    public function report()
    {
        $page_title = "资金报告";

        return view('finances.index', compact('page_title'));
    }

    public function cashRecord()
    {
        $page_title = "现金交易记录";

        return view('finances.index', compact('page_title'));
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
        //
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
        //
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
