<?php

namespace App\Http\Controllers\Business;

use App\Doctor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * completed：已认证；空：未认证；processing：认证中；fail：认证失败。
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "医生认证";


    public function index()
    {
        $page_title = "医生认证";
        $page_level = $this->page_level;

        return view('verifys.index', compact('page_title', 'page_level'));
    }

    public function already()
    {
        $doctors = Doctor::getVerifyDoctor('completed');
        $page_title = "已认证";
        $page_level = $this->page_level;

        return view('verifys.already', compact('doctors', 'page_title', 'page_level'));
    }

    public function todo()
    {
        $doctors = Doctor::getVerifyDoctor('processing');
        $page_title = "待审核";
        $page_level = $this->page_level;

        return view('verifys.todo', compact('doctors', 'page_title', 'page_level'));
    }

    public function not()
    {
        $doctors = Doctor::getVerifyDoctor('');
        $page_title = "未认证";
        $page_level = $this->page_level;

        return view('verifys.not', compact('doctors', 'page_title', 'page_level'));
    }

    public function failed()
    {
        $doctors = Doctor::getVerifyDoctor('fail');
        $page_title = "认证失败";
        $page_level = $this->page_level;

        return view('verifys.failed', compact('doctors', 'page_title', 'page_level'));
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
