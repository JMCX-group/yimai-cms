<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "推送内容";

        return view('pushs.index', compact('page_title'));
    }

    public function banner()
    {
        $page_title = "Banner";

        return view('pushs.index', compact('page_title'));
    }

    public function shareFwd()
    {
        $page_title = "Share/fwd";

        return view('pushs.index', compact('page_title'));
    }

    public function broadcast()
    {
        $page_title = "广播站";

        return view('pushs.index', compact('page_title'));
    }

    public function sysMsg()
    {
        $page_title = "系统通知";

        return view('pushs.index', compact('page_title'));
    }

    public function serviceAgreement()
    {
        $page_title = "服务协议";

        return view('pushs.index', compact('page_title'));
    }

    public function manual()
    {
        $page_title = "手动推送";

        return view('pushs.index', compact('page_title'));
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
