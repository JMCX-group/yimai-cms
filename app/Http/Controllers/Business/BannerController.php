<?php

namespace App\Http\Controllers\Business;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * 判断是否上传新的首图
         */
        $file = $request->file('upload_focus_img');
        if ($file == null) {
            $focusImgUrl = 'http://cms.medi-link.cn/uploads/banner/20161218205430.png'; //默认图片
        } else {
            $focusImgUrl = $this->upload($file);
        }

        /**
         * 生成数据
         */
        $data = [
            'title' => $request['title'],
            'focus_img_url' => $focusImgUrl,
            'content' => $request['container'],
            'location' => $request['location'],
            'd_or_p' => $request['d_or_p']
        ];

        try {
            $retBanner = Banner::create($data);

            /**
             * 更新相应的医生/患者端的位置为空：
             */
            if ($data['location'] != '') {
                Banner::where('location', $data['location'])
                    ->where('d_or_p', $data['d_or_p'])
                    ->where('id', '!=', $retBanner->id)
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * 判断是否上传新的首图
         */
        $file = $request->file('upload_focus_img');
        if ($file == null) {
            $focusImgUrl = $request['focus_img_url'];
        } else {
            $focusImgUrl = $this->upload($file);
        }

        /**
         * Update data.
         */
        $banner = Banner::find($id);
        $banner->title = $request['title'];
        $banner->focus_img_url = $focusImgUrl;
        $banner->content = $request['container'];
        $banner->location = $request['location'];
        $banner->d_or_p = $request['d_or_p'];

        try {
            $banner->save();

            /**
             * 更新相应的医生/患者端的位置为空：
             */
            if ($request['location'] != '') {
                Banner::where('location', $request['location'])
                    ->where('d_or_p', $request['d_or_p'])
                    ->where('id', '!=', $id)
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 上传文件
     *
     * @param $file
     * @return string
     */
    public function upload($file)
    {
        //文件是否上传成功
        if ($file->isValid()) {    //判断文件是否上传成功
//            $originalName = $file->getClientOriginalName(); //源文件名
//            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            $type = $file->getClientMimeType(); //文件类型

            $imgUrl = $this->saveImg($file);

            return $imgUrl;
        } else {
            return '';
        }
    }

    /**
     * 保存图片
     *
     * @param $file
     * @return string
     */
    public function saveImg($file)
    {
        $domain = \Config::get('constants.DOMAIN');
        $destinationPath = \Config::get('constants.BANNER_PATH');
        $filename = date('YmdHis') . '.jpg';  //新文件名

        $file->move($destinationPath, $filename);

        $fullPath = $destinationPath . $filename;
        $newPath = str_replace('.jpg', '_thumb.jpg', $fullPath);

        Image::make($fullPath)->encode('jpg', 50)->save($newPath);

        return $domain . $newPath;
    }
}
