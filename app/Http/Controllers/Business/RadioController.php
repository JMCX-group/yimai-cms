<?php

namespace App\Http\Controllers\Business;

use App\RadioStation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RadioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "推送内容";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radios = RadioStation::paginate(15);
        $page_title = "广播站";
        $page_level = $this->page_level;

        return view('radios.index', compact('radios', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新建广播";
        $page_level = $this->page_level;

        return view('radios.create', compact('page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request['title'],
            'img_url' => $request['img_url'],
            'content' => $request['container'],
//            'author' => $request['author'],
            'd_or_p' => $request['d_or_p'],
//            'valid' => $request['valid']
        ];

        try {
            RadioStation::create($data);
            return redirect()->route('radio.index')->withSuccess('新增广播成功');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
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
        $radio = RadioStation::find($id);
        $page_title = "编辑广播";
        $page_level = $this->page_level;

        return view('radios.edit', compact('radio', 'page_title', 'page_level'));
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
        $radio = RadioStation::find($id);
        $radio->title = $request['title'];
        $radio->img_url = $request['img_url'];
        $radio->content = $request['container'];
        $radio->d_or_p = $request['d_or_p'];

        try {
            $radio->save();
            return redirect()->route('radio.index')->withSuccess('更新广播成功');
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
