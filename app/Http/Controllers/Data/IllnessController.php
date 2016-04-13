<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Illness;
use DB;

class IllnessController extends Controller
{
    public $page_level = "数据管理";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $illnesss = Illness::paginate(15);
        $this->getDeptNames($illnesss);
        $page_title = "疾病";
        $page_level = $this->page_level;

        return view('illnesss.index', compact('illnesss', 'page_title', 'page_level'));
    }

    /**
     * ID转Name
     *
     * @param $illnesss
     */
    public function getDeptNames($illnesss)
    {
        $deptIdArr = array();
        foreach ($illnesss as $illness) {
            if (!in_array($illness->dept1_id, $deptIdArr)) {
                array_push($deptIdArr, $illness->dept1_id);
            }

            if (!in_array($illness->dept2_id, $deptIdArr)) {
                array_push($deptIdArr, $illness->dept2_id);
            }
        }

        $deptNames = DB::table('dept_standards')
            ->whereIn('id', $deptIdArr)->get();

        foreach ($illnesss as &$illness) {
            foreach ($deptNames as $deptName) {
                if ($illness->dept1_id == $deptName->id) {
                    $illness['dept1_name'] = $deptName->name;
                }

                if ($illness->dept2_id == $deptName->id) {
                    $illness['dept2_name'] = $deptName->name;
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
        //
    }
}
