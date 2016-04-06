<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Http\Requests\Form\RoleForm;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(25);
        $page_title = "角色列表";

        return view('roles.index', compact('roles', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = "新建角色";

        return view('roles.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleForm $request
     * 
     * @return mixed
     */
    public function store(RoleForm $request)
    {
        try {
            if (Role::create($request->all())) {
                return redirect()->route('role.index')->withSuccess('新增角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = "角色赋权";

        return view('roles.show', compact('id', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $page_title = "编辑角色";

        return view('roles.edit', compact('role', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param RoleForm $request
     * @param $id
     * 
     * @return mixed
     */
    public function update(RoleForm $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        try {
            if (Role::where('id', $id)->update($data)) {
                return redirect()->back()->withSuccess('编辑角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Role::destroy($id)) {
                return redirect()->back()->withSuccess('删除角色成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
