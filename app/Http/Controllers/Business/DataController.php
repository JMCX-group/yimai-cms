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
    public $page_level = "数据管理";

    public function index()
    {
        $page_title = "数据管理";

        return view('datas.index', compact('page_title', 'page_level'));
    }

    public function hospital()
    {
        $page_title = "医院";
        $page_level = $this->page_level;

        return view('datas.hospital', compact('page_title', 'page_level'));
    }

    public function newHospital()
    {
        $page_title = "新建院校";
        $page_level = $this->page_level;

        return view('datas.new-hospital', compact('page_title', 'page_level'));
    }


    public function college()
    {
        $page_title = "毕业院校";
        $page_level = $this->page_level;

        return view('datas.index', compact('page_title', 'page_level'));
    }

    public function newCollege()
    {
        $page_title = "新建院校";
        $page_level = $this->page_level;

        return view('datas.index', compact('page_title', 'page_level'));
    }

    public function tag()
    {
        $page_title = "特长标签";
        $page_level = $this->page_level;

        return view('datas.index', compact('page_title', 'page_level'));
    }

    public function doctor()
    {
        $page_title = "医生数据";
        $page_level = $this->page_level;

        return view('datas.index', compact('page_title', 'page_level'));
    }

    public function illness()
    {
        $page_title = "疾病";
        $page_level = $this->page_level;

        return view('datas.index', compact('page_title', 'page_level'));
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
