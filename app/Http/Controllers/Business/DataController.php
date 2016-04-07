<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "数据管理";

        return view('datas.index', compact('page_title'));
    }

    public function hospital()
    {
        $page_title = "医院";

        return view('datas.index', compact('page_title'));
    }

    public function college()
    {
        $page_title = "毕业院校";

        return view('datas.index', compact('page_title'));
    }

    public function newCollege()
    {
        $page_title = "新建院校";

        return view('datas.index', compact('page_title'));
    }

    public function tag()
    {
        $page_title = "特长标签";

        return view('datas.index', compact('page_title'));
    }

    public function doctor()
    {
        $page_title = "医生数据";

        return view('datas.index', compact('page_title'));
    }

    public function illness()
    {
        $page_title = "疾病";

        return view('datas.index', compact('page_title'));
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
