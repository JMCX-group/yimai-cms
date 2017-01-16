<?php

namespace App\Http\Controllers\Data;

use App\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "配置管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::find(1);
        $data = json_decode($configs->json, true);
        $config = [
            'id' => $configs->id,
            'top_director' => $data['top_director'],
            'top_deputy_director' => $data['top_deputy_director'],
            'bsg_3a_director' => $data['bsg_3a_director'],
            'bsg_3a_deputy_director' => $data['bsg_3a_deputy_director'],
            'other_3a_director' => $data['other_3a_director'],
            'other_3a_deputy_director' => $data['other_3a_deputy_director'],
            'other_doctor' => $data['other_doctor'],

            'doctor_to_appointment' => $data['doctor_to_appointment'],
            'patient_to_appointment' => $data['patient_to_appointment'],
            'patient_to_admissions' => $data['patient_to_admissions'],
            'patient_to_platform_appointment' => $data['patient_to_platform_appointment'],
            'patient_to_platform_appointment_specify' => $data['patient_to_platform_appointment_specify'],
        ];
        $config = (object)$config;
        $page_title = "费率设置";
        $page_level = $this->page_level;

        return view('configs.edit', compact('config', 'page_title', 'page_level'));
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
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        //
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
        $data = [
            'top_director' => $request['top-director'],
            'top_deputy_director' => $request['top-deputy-director'],
            'bsg_3a_director' => $request['bsg-3a-director'],
            'bsg_3a_deputy_director' => $request['bsg-3a-deputy-director'],
            'other_3a_director' => $request['other-3a-director'],
            'other_3a_deputy_director' => $request['other-3a-deputy-director'],
            'other_doctor' => $request['other-doctor'],

            'doctor_to_appointment' => $request['doctor-to-appointment'],
            'patient_to_appointment' => $request['patient-to-appointment'],
            'patient_to_admissions' => $request['patient-to-admissions'],
            'patient_to_platform_appointment' => $request['patient-to-platform-appointment'],
            'patient_to_platform_appointment_specify' => $request['patient-to-platform-appointment-specify'],
        ];

        $config = Config::find($id);
        $config->json = json_encode($data);

        try {
            if ($config->save()) {
                return redirect()->route('config.index')->withSuccess('更新成功');
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
