<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
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
        $page_title = "已认证医生";
        $page_level = $this->page_level;

        return view('verifys.already', compact('page_title', 'page_level'));
    }

    public function todo()
    {
        $page_title = "待认证医生";
        $page_level = $this->page_level;

        return view('verifys.todo', compact('page_title', 'page_level'));
    }

    public function not()
    {
        $page_title = "未认证医生";
        $page_level = $this->page_level;

        return view('verifys.not', compact('page_title', 'page_level'));
    }

    public function pending()
    {
        $page_title = "待审核头像";
        $page_level = $this->page_level;

        return view('verifys.pending', compact('page_title', 'page_level'));
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
