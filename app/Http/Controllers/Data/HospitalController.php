<?php

namespace App\Http\Controllers\Data;

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
     * @return mixed
     */
    public function store(HospitalForm $request)
    {
        $data = [
            'city' => $request['city'],
            'name' => $request['name'],
            'three_a' => $request['three_a']
        ];

        $deptStandardIds = $this->getDeptStandardIds($request->get('dept_standard_id'));
        $data['three_a'] = $this->getThreeA($data['three_a']);
        $data['top_dept_num'] = count($deptStandardIds);
        $data['status'] = "已核实";
        
        try {
            if ($deptStandardIds) {
                $deptStandards = DeptStandard::whereIn('id', $deptStandardIds)->get();

                if (empty($deptStandards->toArray())) {
                    return redirect()->back()->withErrors("科室不存在,请刷新页面并选择其他科室")->withInput();
                }
            }

            $hospital = Hospital::create($data);
            if ($hospital && $deptStandardIds) {
                foreach ($deptStandardIds as $deptStandardId) {
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
        $hospital = Hospital::find($id);
        $dept_standards = DeptStandard::all();
        $hospital_top_dept = HospitalTopDept::where('hospital_id', $id)->lists('dept_standard_id')->toArray();
        $page_title = "编辑医院";
        $page_level = $this->page_level;

        return view('hospitals.edit', compact('hospital', 'dept_standards', 'hospital_top_dept', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HospitalForm $request
     * @param $id
     * @return mixed
     */
    public function update(HospitalForm $request, $id)
    {
        $hospital = Hospital::find($id);
        $hospital->city = $request['city'];
        $hospital->name = $request['name'];

        $deptStandardIds = $this->getDeptStandardIds($request->get('dept_standard_id'));
        $hospital->three_a = $this->getThreeA($request['three_a']);
        $hospital->top_dept_num = count($deptStandardIds);

        try {
            if ($deptStandardIds) {
                $deptStandards = DeptStandard::whereIn('id', $deptStandardIds)->get();

                if (empty($deptStandards->toArray())) {
                    return redirect()->back()->withErrors("科室不存在,请刷新页面并选择其他科室")->withInput();
                }
            }

            if ($hospital->save()) {
                HospitalTopDept::where('hospital_id', '=', $hospital->id)->delete();

                if($deptStandardIds){
                    foreach ($request->get('dept_standard_id') as $deptStandardId) {
                        $relationData = [
                            'hospital_id' => $hospital->id,
                            'dept_standard_id' => $deptStandardId,
                        ];

                        HospitalTopDept::create($relationData);
                    }
                }
            }

            return redirect()->route('hospital.index')->withSuccess('编辑医院成功');
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
        try {
            if (Hospital::destroy($id)) {
                return redirect()->back()->withSuccess('删除医院成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }

    /**
     * 处理顶级科室
     *
     * @param $deptStandardIds
     * @return mixed
     */
    public function getDeptStandardIds($deptStandardIds)
    {
        if($deptStandardIds){
            foreach ($deptStandardIds as $key=>$deptStandardId) {
                if($deptStandardId == '0'){
                    array_splice($deptStandardIds, $key, 1);
                }
            }
        }

        return $deptStandardIds;
    }

    /**
     * 处理是否三甲医院
     *
     * @param $data
     * @return string
     */
    public function getThreeA($data)
    {
        if ($data == 'N') {
            $data = ''; // 是否三甲医院,是为Y,否为空
        }

        return $data;
    }
}
