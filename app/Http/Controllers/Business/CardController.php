<?php

namespace App\Http\Controllers\Business;

use App\Doctor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public $page_level = "名片申请";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "申请名片";
        $page_level = $this->page_level;

        return view('cards.index', compact('page_title', 'page_level'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function todo()
    {
        $doctors = Doctor::getDoctorCardInfoList('1');
        $page_title = "待审核";
        $page_level = $this->page_level;

        return view('cards.todo', compact('doctors', 'page_title', 'page_level'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {
        $doctors = Doctor::getDoctorCardInfoList('2');
        $page_title = "已发货";
        $page_level = $this->page_level;

        return view('cards.success', compact('doctors', 'page_title', 'page_level'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function failed()
    {
        $doctors = Doctor::getDoctorCardInfoList('3');
        $page_title = "已拒绝";
        $page_level = $this->page_level;

        return view('cards.failed', compact('doctors', 'page_title', 'page_level'));
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
        $doctors = Doctor::getOneDoctor($id);

        $page_title = "名片发货";
        $page_level = $this->page_level;

        return view('cards.edit', compact('doctors', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        $expressNo = $request['express_no'];
        $refuseInfo = $request['refuse_info'];
        if ($expressNo != '' && $refuseInfo == '') {
            $ifSuccess = true;
        } elseif ($expressNo == '' && $refuseInfo != '') {
            $ifSuccess = false;
        } else {
            return redirect()->back()->withErrors(array('error' => '快递单号和拒绝理由只能选填且必填其一！'))->withInput();
        }

        $doctors = Doctor::find($id);
        ($ifSuccess) ? $doctors->application_card = '2' : $doctors->application_card = '3'; //是否申请名片，1为申请，2为已寄出，3为拒绝
        $doctors->express_no = $expressNo;
        $doctors->refuse_info = $refuseInfo;

        try {
            if ($doctors->save()) {
                return redirect()->route('card.todo')->withSuccess('操作成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '更新数据失败'))->withInput();
            }
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
