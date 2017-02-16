<?php

namespace App\Http\Controllers\Business;

use App\Config;
use App\Doctor;
use App\InvitedDoctor;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $doctors = Doctor::getOneDoctor($id);
        $doctors->auth_img = explode(',', $doctors->auth_img);

        $page_title = "审核认证";
        $page_level = $this->page_level;

        return view('verifys.edit', compact('doctors', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $doctors = Doctor::find($id);
        $doctors->auth = 'completed';

        try {
            if ($doctors->save()) {
                $this->invitedProcess($doctors);

                return redirect()->route('verify.todo')->withSuccess('通过成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '更新数据失败'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * 发放邀请奖励
     *
     * @param $doctor
     */
    public function invitedProcess($doctor)
    {
        $configs = Config::find(1);
        $data = json_decode($configs->json, true);

        $invitedDoctor = InvitedDoctor::where('doctor_id', $doctor->id)->first();
        if (!empty($invitedDoctor)) {
            $invitedDoctor->status = 'completed'; //wait：等待邀请；invited：已邀请/未加入；re-invite：可以重新邀请了；join：已加入；processing：认证中；completed：完成认证
            switch ($doctor->title) {
                //主任医师,副主任医师,主治医师,住院医师
                case '主任医师':
                    $invitedDoctor->bonus = $data['chief_physician'];
                    break;
                case '副主任医师':
                    $invitedDoctor->bonus = $data['deputy_chief_physician'];
                    break;
                case '主治医师':
                    $invitedDoctor->bonus = $data['attending_doctor'];
                    break;
                default: //住院医师
                    $invitedDoctor->bonus = $data['resident_doctor'];
                    break;
            }
            $invitedDoctor->save();
        }
    }

    /**
     * 拒绝认证
     *
     * @param $id
     * @return $this
     */
    public function refuse($id)
    {
        $doctors = Doctor::find($id);
        $doctors->auth = 'fail';

        try {
            if ($doctors->save()) {
                return redirect()->route('verify.todo')->withSuccess('拒绝成功');
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
