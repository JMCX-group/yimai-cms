<?php
namespace App\Http\Controllers\Business;

use App\Http\Helper\MsgAndNotification;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * 判断是否上传新的首图
         */
        $file = $request->file('upload_focus_img');
        if ($file == null) {
            $focusImgUrl = 'http://cms.medi-link.cn/uploads/article/1.png'; //默认图片
        } else {
            $focusImgUrl = $this->upload($file);
        }

        /**
         * 生成数据
         */
        $data = [
            'title' => $request['title'],
            'img_url' => $focusImgUrl,
            'content' => $request['content'],
//            'author' => $request['author'],
            'd_or_p' => $request['d_or_p'],
//            'valid' => $request['valid']
        ];

        try {
            $radioId = RadioStation::create($data);
            $radioId = $radioId->id;

            /**
             * 给IOS和Android推送消息
             */
            MsgAndNotification::pushBroadcast($data['d_or_p'], $data['title'], 'radio', $radioId);

            return redirect()->route('radio.index')->withSuccess('新增广播成功；推送广播成功');
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
        $radio = RadioStation::find($id);
        $page_title = "编辑广播";
        $page_level = $this->page_level;

        return view('radios.edit', compact('radio', 'page_title', 'page_level'));
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
            $focusImgUrl = $request['img_url'];
        } else {
            $focusImgUrl = $this->upload($file);
        }

        $radio = RadioStation::find($id);
        $radio->title = $request['title'];
        $radio->img_url = $focusImgUrl;
        $radio->content = $request['content'];
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
        $destinationPath = \Config::get('constants.ARTICLE_PATH');
        $filename = date('YmdHis') . '.jpg';  //新文件名

        $file->move($destinationPath, $filename);

        $fullPath = $destinationPath . $filename;
        $newPath = str_replace('.jpg', '_thumb.jpg', $fullPath);

        Image::make($fullPath)->encode('jpg', 50)->save($newPath);

        return $domain . $newPath;
    }
}
