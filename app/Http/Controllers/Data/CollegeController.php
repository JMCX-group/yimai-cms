<?php

namespace App\Http\Controllers\Data;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\College;
use App\Http\Requests\Form\CollegeForm;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "数据管理";

    public function index()
    {
        $colleges = College::paginate(15);
        $page_title = "毕业院校";
        $page_level = $this->page_level;

        return view('colleges.index', compact('colleges', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新建学校";
        $page_level = $this->page_level;

        return view('colleges.create', compact('page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CollegeForm $request
     * @return mixed
     */
    public function store(CollegeForm $request)
    {
        $data = [
            'name' => $request['name']
        ];

        $data['status'] = "已核实";

        try {
            if (College::create($data)) {
                return redirect()->route('college.index')->withSuccess('新增学校成功');
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
        $college = College::find($id);
        $page_title = "编辑学校";
        $page_level = $this->page_level;

        return view('colleges.edit', compact('college', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CollegeForm $request
     * @param $id
     * @return mixed
     */
    public function update(CollegeForm $request, $id)
    {
        $college = College::find($id);
        $college->name = $request['name'];
        $college->status = $this->getCollegeStatus($request['status']);

        try {
            if ($college->save()) {
                return redirect()->route('college.index')->withSuccess('编辑学校成功');
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
        try {
            if (College::destroy($id)) {
                return redirect()->back()->withSuccess('删除学校成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '删除数据失败'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }

    /**
     * 翻译学校状态
     *
     * @param $status
     * @return string
     */
    public function getCollegeStatus($status)
    {
        switch ($status) {
            case 'Y':
                $ret = "已核实";
                break;
            case 'W':
                $ret = "待核实";
                break;
            case 'N':
                $ret = "已拒绝";
                break;
            case 'D':
                $ret = "已删除";
                break;
            default:
                $ret = "";
                break;
        }

        return $ret;
    }
}
