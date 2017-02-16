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
    public $page_level = "财务管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::find(1);
        $data = json_decode($configs->json, true);
        if ($data == null) {
            /**
             * 没有就初始化参数：
             */
            $data = [
                'top_director' => '1500',
                'top_deputy_director' => '1000',
                'bsg_3a_director' => '800',
                'bsg_3a_deputy_director' => '550',
                'other_3a_director' => '400',
                'other_3a_deputy_director' => '300',
                'other_doctor' => '150',

                'doctor_to_appointment' => '10',
                'patient_to_appointment' => '10',
                'patient_to_admissions' => '10',
                'patient_to_platform_appointment' => '20',
                'patient_to_platform_appointment_specify' => '30',

                'patient_less_than_24h' => '50',
                'patient_more_than_24h' => '80',

                'chief_physician' => '200', //主任医师,副主任医师,主治医师,住院医师;奖励金额
                'deputy_chief_physician' => '150',
                'attending_doctor' => '100',
                'resident_doctor' => '50'
            ];
            $configs->json = json_encode($data);
            $configs->save();
        }

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

            'patient_less_than_24h' => $data['patient_less_than_24h'],
            'patient_more_than_24h' => $data['patient_more_than_24h'],

            //主任医师,副主任医师,主治医师,住院医师;奖励金额
            'chief_physician' => isset($data['chief_physician']) ? $data['chief_physician'] : '200',
            'deputy_chief_physician' => isset($data['deputy_chief_physician']) ? $data['deputy_chief_physician'] : '150',
            'attending_doctor' => isset($data['attending_doctor']) ? $data['attending_doctor'] : '100',
            'resident_doctor' => isset($data['resident_doctor']) ? $data['resident_doctor'] : '50'
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
        /**
         * 'top_director' => '1500',
         * 'top_deputy_director' => '1000',
         * 'bsg_3a_director' => '800',
         * 'bsg_3a_deputy_director' => '550',
         * 'other_3a_director' => '400',
         * 'other_3a_deputy_director' => '300',
         * 'other_doctor' => '150',
         *
         * 'doctor_to_appointment' => '10',
         * 'patient_to_appointment' => '10',
         * 'patient_to_admissions' => '10',
         * 'patient_to_platform_appointment' => '20',
         * 'patient_to_platform_appointment_specify' => '30',
         *
         * 'patient_less_than_24h' => '50',
         * 'patient_more_than_24h' => '80',
         *
         * 'chief_physician' => '200', //主任医师,副主任医师,主治医师,住院医师;奖励金额
         * 'deputy_chief_physician' => '150',
         * 'attending_doctor' => '100',
         * 'resident_doctor' => '50'
         */

        $data = [
            'top_director' => isset($request['top-director']) && $request['top-director'] != '' ? $request['top-director'] : 1500,
            'top_deputy_director' => isset($request['top-deputy-director']) && $request['top-deputy-director'] != '' ? $request['top-deputy-director'] : 1000,
            'bsg_3a_director' => isset($request['bsg-3a-director']) && $request['bsg-3a-director'] != '' ? $request['bsg-3a-director'] : 800,
            'bsg_3a_deputy_director' => isset($request['bsg-3a-deputy-director']) && $request['bsg-3a-deputy-director'] != '' ? $request['bsg-3a-deputy-director'] : 550,
            'other_3a_director' => isset($request['other-3a-director']) && $request['other-3a-director'] != '' ? $request['other-3a-director'] : 400,
            'other_3a_deputy_director' => isset($request['other-3a-deputy-director']) && $request['other-3a-deputy-director'] != '' ? $request['other-3a-deputy-director'] : 300,
            'other_doctor' => isset($request['other-doctor']) && $request['other-doctor'] != '' ? $request['other-doctor'] : 150,

            'doctor_to_appointment' => isset($request['doctor-to-appointment']) && $request['doctor-to-appointment'] != '' ? $request['doctor-to-appointment'] : 10,
            'patient_to_appointment' => isset($request['patient-to-appointment']) && $request['patient-to-appointment'] != '' ? $request['patient-to-appointment'] : 10,
            'patient_to_admissions' => isset($request['patient-to-admissions']) && $request['patient-to-admissions'] != '' ? $request['patient-to-admissions'] : 10,
            'patient_to_platform_appointment' => isset($request['patient-to-platform-appointment']) && $request['patient-to-platform-appointment'] != '' ? $request['patient-to-platform-appointment'] : 20,
            'patient_to_platform_appointment_specify' => isset($request['patient-to-platform-appointment-specify']) && $request['patient-to-platform-appointment-specify'] != '' ? $request['patient-to-platform-appointment-specify'] : 30,

            'patient_less_than_24h' => isset($request['patient-less-than-24h']) && $request['patient-less-than-24h'] != '' ? $request['patient-less-than-24h'] : 50,
            'patient_more_than_24h' => isset($request['patient-more-than-24h']) && $request['patient-more-than-24h'] != '' ? $request['patient-more-than-24h'] : 80,

            //主任医师,副主任医师,主治医师,住院医师;奖励金额
            'chief_physician' => isset($request['chief-physician']) && $request['chief-physician'] != '' ? $request['chief-physician'] : 200,
            'deputy_chief_physician' => isset($request['deputy-chief-physician']) && $request['deputy-chief-physician'] != '' ? $request['deputy-chief-physician'] : 150,
            'attending_doctor' => isset($request['attending-doctor']) && $request['attending-doctor'] != '' ? $request['attending-doctor'] : 100,
            'resident_doctor' => isset($request['resident-doctor']) && $request['resident-doctor'] != '' ? $request['resident-doctor'] : 50
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
