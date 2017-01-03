<?php

namespace App\Http\Controllers\Business;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
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
        $banners = Banner::paginate(15);
        $page_title = "Banner";
        $page_level = $this->page_level;

        return view('banners.index', compact('banners', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新建Banner";
        $page_level = $this->page_level;

        return view('banners.create', compact('page_title', 'page_level'));
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
            'focus_img_url' => $request['focus_img_url'],
            'content' => $request['container'],
            'location' => $request['location'],
            'd_or_p' => $request['d_or_p']
        ];

        try {
            Banner::create($data);

            /**
             * 更新相应的医生/患者端的位置为空：
             */
            if($data['location'] != ''){
                Banner::where('location', $data['location'])
                    ->where('d_or_p', $data['d_or_p'])
                    ->update(['location' => '']);
            }

            return redirect()->route('banner.index')->withSuccess('新增Banner成功');
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
        $banner = Banner::find($id);
        $page_title = "编辑Banner";
        $page_level = $this->page_level;

        return view('banners.edit', compact('banner', 'page_title', 'page_level'));
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
        $banner = Banner::find($id);
        $banner->title = $request['title'];
        $banner->focus_img_url = $request['focus_img_url'];
        $banner->content = $request['container'];
        $banner->location = $request['location'];
        $banner->d_or_p = $request['d_or_p'];

        try {
            $banner->save();

            /**
             * 更新相应的医生/患者端的位置为空：
             */
            if($request['location'] != ''){
                Banner::where('location', $request['location'])
                    ->where('d_or_p', $request['d_or_p'])
                    ->update(['location' => '']);
            }

            return redirect()->route('banner.index')->withSuccess('更新Banner成功');
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
