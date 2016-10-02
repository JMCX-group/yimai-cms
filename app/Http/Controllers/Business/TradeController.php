<?php

namespace App\Http\Controllers\Business;

use App\Appointment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "交易管理";


    public function index()
    {
        $page_title = "交易管理";
        $page_level = $this->page_level;

        return view('trades.index', compact('page_title', 'page_level'));
    }

    public function pendingAppointment()
    {
        $appointments = Appointment::getWait();
        $page_title = "待处理约诊";
        $page_level = $this->page_level;

        return view('trades.pending-appointment', compact('appointments', 'page_title', 'page_level'));
    }

    public function faceToFace()
    {
        $page_title = "当面咨询";
        $page_level = $this->page_level;

        return view('trades.index', compact('page_title', 'page_level'));
    }

    public function appointmentIncomplete()
    {
        $page_title = "约诊-未完成";
        $page_level = $this->page_level;

        return view('trades.index', compact('page_title', 'page_level'));
    }

    public function appointmentCompleted()
    {
        $page_title = "约诊-已完成";
        $page_level = $this->page_level;

        return view('trades.index', compact('page_title', 'page_level'));
    }

    public function evaluate()
    {
        $page_title = "评价";
        $page_level = $this->page_level;

        return view('trades.index', compact('page_title', 'page_level'));
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
