<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Hospital;
use App\DeptStandard;
use App\HospitalTopDept;
use App\Http\Requests\Form\HospitalForm;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "数据管理";

    public function index()
    {
        $hospitals = Hospital::paginate(15);
        $page_title = "医院";
        $page_level = $this->page_level;

        return view('hospitals.index', compact('hospitals', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept_standards = DeptStandard::all();
        $page_title = "新建医院";
        $page_level = $this->page_level;

        return view('hospitals.create', compact('dept_standards', 'page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HospitalForm $request
     */
    public function store(HospitalForm $request)
    {
        $data = [
            'city' => $request['city'],
            'name' => $request['name'],
            'three_a' => $request['three_a']
        ];

        $deptStandardIds = $request->get('dept_standard_id');

        if ($data['three_a'] == 'N') {
            $data['three_a'] = ''; // 是否三甲医院,是为Y,否为空
        }
        $data['top_dept_num'] = count($deptStandardIds); // 顶级科室数量

        try {
            if ($deptStandardIds) {
                $deptStandards = DeptStandard::whereIn('id', $deptStandardIds)->get();

                if (empty($deptStandards->toArray())) {
                    return redirect()->back()->withErrors("科室不存在,请刷新页面并选择其他科室")->withInput();
                }
            }

            $hospital = Hospital::create($data);
            if ($hospital && $deptStandardIds) {
                foreach ($request->get('dept_standard_id') as $deptStandardId) {
                    $relationData = [
                        'hospital_id' => $hospital->id,
                        'dept_standard_id' => $deptStandardId,
                    ];

                    HospitalTopDept::create($relationData);
                }
            }

            return redirect()->route('hospital.index')->withSuccess('新增医院成功');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Hospital::destroy($id)) {
                return redirect()->back()->withSuccess('删除医院成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
