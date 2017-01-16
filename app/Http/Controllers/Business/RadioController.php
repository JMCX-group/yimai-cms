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
             * 推送IOS广播
             */
            $result = $this->sendNotification_IOS($data['d_or_p'], $request['e_or_a'], $data['title'], $radioId);
            if ($result['result'] == false) {
                return redirect()->back()->withErrors(array('error' => $result['message']))->withInput();
            }

            /**
             * 推送安卓广播
             */
            $result = $this->sendNotification_Android($data['d_or_p'], $data['title'], $radioId);
            if ($result['result'] == false) {
                return redirect()->back()->withErrors(array('error' => $result['message']))->withInput();
            }

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

    /**
     * 发送广播-IOS
     *
     * @param $dOrP
     * @param $eOrA
     * @param $title
     * @param $radioId
     * @return array
     */
    public function sendNotification_IOS($dOrP, $eOrA, $title, $radioId)
    {
        require(dirname(dirname(dirname(__FILE__))) . '/Helper/UmengNotification/NotificationPush.php');

        if ($dOrP == 'd') { //医生端
            if ($eOrA == 'enterprise') { //医生端企业版
                $push = new \NotificationPush('58073c2ae0f55a4ac00023e4', 'npypnjmmor5ufydocxyia3o6lwq1vh5n');
            } else { //医生端AppStore
                $push = new \NotificationPush('587704278f4a9d795e001f79', 'ajcvonw3kas06oyljq1xcujvuadqszcj');
            }
        } else { //患者端
            if ($eOrA == 'enterprise') { //患者端企业版
                $push = new \NotificationPush('58770533c62dca6297001b7b', 'mnbtm9nu5v2cw5neqbxo6grqsuhxg1o8');
            } else { //患者端AppStore
                $push = new \NotificationPush('587704b3310c934edb002251', 'mngbtbi7lj0y8shlmdvvqdkek9k3hfin');
            }
        }

        return $push->sendIOSBroadcast($title, 'radio', $radioId);
    }

    /**
     * 发送广播-Android
     *
     * @param $dOrP
     * @param $title
     * @param $radioId
     * @return array
     */
    public function sendNotification_Android($dOrP, $title, $radioId)
    {
        require(dirname(dirname(dirname(__FILE__))) . '/Helper/UmengNotification/NotificationPush.php');

        if ($dOrP == 'd') { //医生端
            $push = new \NotificationPush('58073313e0f55a4825002a47', '0hmugthtu84nyou6egw3kmdsf6v4zmom');
        } else { //患者端
            $push = new \NotificationPush('587b786af43e4833800004cb', 'oth53caymcr5zxc2edhi0ghuoyuxbov3');
        }

        return $push->sendAndroidBroadcast($title, 'radio', $radioId);
    }
}
