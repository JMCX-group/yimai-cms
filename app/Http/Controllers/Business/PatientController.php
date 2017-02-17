<?php

namespace App\Http\Controllers\Business;

use App\InvitedDoctor;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "用户管理";
    
    public function index()
    {
        $patients = Patient::paginate(15);
        $page_title = "患者列表";
        $page_level = $this->page_level;

        return view('patients.index', compact('patients', 'page_title', 'page_level'));
    }

    /**
     * 加入合作专区的用户
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function zone()
    {
        $patients = Patient::getZonePatients();
        foreach ($patients as $patient){
            $patient->total = InvitedDoctor::sumTotal($patient->id)[0]->total;
        }
        $page_level = "合作专区";
        $page_title = "合作伙伴";

        return view('patients.zone', compact('patients', 'page_title', 'page_level'));
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
