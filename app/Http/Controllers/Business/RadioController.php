<?php
namespace App\Http\Controllers\Business;

use App\Doctor;
use App\DoctorRadioRead;
use App\Http\Helper\MsgAndNotification;
use App\Http\Helper\SaveImage;
use App\Patient;
use App\PatientRadioRead;
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
            $focusImgUrl = SaveImage::radio($file);
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

            /**
             * 部署未读状态
             */
            $this->deployUnread($data['d_or_p'], $radioId);

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
            $focusImgUrl = SaveImage::radio($file);
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
     * 部署未读状态
     *
     * @param $recipient
     * @param $radioId
     */
    public function deployUnread($recipient, $radioId)
    {
        if ($recipient == 'd' || $recipient == 'all') {
            $doctorIdCount = Doctor::count();
            $data = array();
            for ($id = 6; $id <= $doctorIdCount; $id++) {
                $tmp = [
                    'user_id' => $id,
                    'radio_station_id' => $radioId,
                    'value' => 1
                ];
                array_push($data, $tmp);
            }

            DoctorRadioRead::insert($data);
        }

        if ($recipient == 'p' || $recipient == 'all') {
            $patientIdCount = Patient::count();
            $data = array();
            for ($id = 1; $id <= $patientIdCount; $id++) {
                $tmp = [
                    'user_id' => $id,
                    'radio_station_id' => $radioId,
                    'value' => 1
                ];
                array_push($data, $tmp);
            }

            PatientRadioRead::insert($data);
        }
    }
}
