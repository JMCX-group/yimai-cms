<?php

namespace App\Http\Controllers\Backend;

use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{    
    public function index()
    {
        $page_title = "首页";
        $data = [
            [
                'name' => '医生数量',
                'progress' => Doctor::where('id', '>', '5')->count(),
                'color' => 'success'
            ],
            [
                'name' => '订单数量',
                'progress' => Appointment::count(),
                'color' => 'success'
            ]
        ];
        
        return view('index.index',compact( 'page_title', 'data'));
    }
}
