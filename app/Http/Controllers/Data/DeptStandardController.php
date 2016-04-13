<?php

namespace App\Http\Controllers\Data;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DeptStandard;
use App\Http\Requests\Form\DeptStandardForm;

class DeptStandardController extends Controller
{
    public $page_level = "数据管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dept_standards = DeptStandard::paginate(15);
        $this->getParentNames($dept_standards);
        $page_title = "科室";
        $page_level = $this->page_level;

        return view('depts.index', compact('dept_standards', 'page_title', 'page_level'));
    }

    /**
     * ID转Name
     *
     * @param $dept_standards
     */
    public function getParentNames($dept_standards)
    {
        $deptAll = DeptStandard::all();

        foreach ($dept_standards as &$dept_standard) {
            if ($dept_standard->parent_id == 0) {
                $dept_standard['parent_id'] = "无";
            } else {
                foreach ($deptAll as $dept) {
                    if ($dept_standard->parent_id == $dept->id) {
                        $dept_standard['parent_id'] = $dept->name;
                    }
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept_standards = DeptStandard::where('parent_id', '=', 0)->get();
        $page_title = "新建科室";
        $page_level = $this->page_level;

        return view('depts.create', compact('dept_standards', 'page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeptStandardForm $request
     * @return mixed
     */
    public function store(DeptStandardForm $request)
    {
        $data = [
            'parent_id' => $request['parent_id'],
            'name' => $request['name']
        ];

        try {
            if (DeptStandard::create($data)) {
                return redirect()->route('dept.index')->withSuccess('新增科室成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '插入数据失败'))->withInput();
            }
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
        $dept_standards = DeptStandard::find($id);
        $dept_lv1 = DeptStandard::where('parent_id', '=', 0)->get();
        $page_title = "编辑科室";
        $page_level = $this->page_level;

        return view('depts.edit', compact('dept_standards', 'dept_lv1', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeptStandardForm $request
     * @param $id
     * @return mixed
     */
    public function update(DeptStandardForm $request, $id)
    {
        $deptStandard = DeptStandard::find($id);
        $deptStandard->parent_id = $request['parent_id'];
        $deptStandard->name = $request['name'];

        try {
            if ($deptStandard->save()) {
                return redirect()->route('dept.index')->withSuccess('编辑科室成功');
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
        try {
            if (DeptStandard::destroy($id)) {
                return redirect()->back()->withSuccess('删除科室成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '删除数据失败'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
