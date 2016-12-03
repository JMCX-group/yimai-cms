<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;

use DB;
use App\Tag;
use App\DeptStandard;
use App\Http\Requests\Form\TagForm;

class TagController extends Controller
{
    public $page_level = "数据管理";

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $tags = Tag::paginate(15);
        $this->getDeptNames($tags);
        $page_title = "特长标签";
        $page_level = $this->page_level;

        return view('tags.index', compact('tags', 'page_title', 'page_level'));
    }

    /**
     * ID转Name
     *
     * @param $tags
     */
    public function getDeptNames($tags)
    {
        $deptIdArr = array();
        foreach ($tags as $tag) {
            if (!in_array($tag->dept_id, $deptIdArr)) {
                array_push($deptIdArr, $tag->dept_id);
            }

            if (!in_array($tag->dept_lv2_id, $deptIdArr)) {
                array_push($deptIdArr, $tag->dept_lv2_id);
            }
        }

        $deptNames = DB::table('dept_standards')
            ->whereIn('id', $deptIdArr)->get();

        foreach ($tags as &$tag) {
            foreach ($deptNames as $deptName) {
                if ($tag->dept_id == $deptName->id) {
                    $tag['dept_name'] = $deptName->name;
                }

                if ($tag->dept_lv2_id == $deptName->id) {
                    $tag['dept_lv2_name'] = $deptName->name;
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $dept_standards = DeptStandard::all();
        $page_title = "新建标签";
        $page_level = $this->page_level;

        return view('tags.create', compact('dept_standards', 'page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagForm $request
     * @return mixed
     */
    public function store(TagForm $request)
    {
        $data = [
            'dept_id' => $request['dept_id'],
            'dept_lv2_id' => $request['dept_lv2_id'],
            'name' => $request['name'],
            'hot' => $request['hot'],
            'status' => "已核实"
        ];

        try {
            if (Tag::create($data)) {
                return redirect()->route('tag.index')->withSuccess('新增标签成功');
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
        $tag = Tag::find($id);
        $dept_standards = DeptStandard::all();
        $page_title = "编辑标签";
        $page_level = $this->page_level;

        return view('tags.edit', compact('tag', 'dept_standards', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagForm $request
     * @param $id
     * @return mixed
     */
    public function update(TagForm $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request['name'];
        $tag->dept_id = $request['dept_id'];
        $tag->dept_lv2_id = $request['dept_lv2_id'];
        $tag->hot = $request['hot'];
        $tag->status = $request['status'];

        try {
            if ($tag->save()) {
                return redirect()->route('tag.index')->withSuccess('编辑标签成功');
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
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            if (Tag::destroy($id)) {
                return redirect()->back()->withSuccess('删除标签成功');
            } else {
                return redirect()->back()->withErrors(array('error' => '删除数据失败'))->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
