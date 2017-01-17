<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/30
 * Time: 下午3:32
 */
?>

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('appointment/'.$appointments->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <ul class="breadcrumb">
                            <li><a href="#">患者基础信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="patient-name" class="col-sm-3 control-label">患者姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="patient-name" name="patient-name" placeholder="无" value="{{$appointments->patient_name}}">
                                @include('layouts.message.tips',['field'=>'patient-name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patient-phone" class="col-sm-3 control-label">患者手机号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="patient-phone" name="patient-phone" placeholder="无" value="{{$appointments->patient_phone}}">
                                @include('layouts.message.tips',['field'=>'patient-phone'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patient-history" class="col-sm-3 control-label">患者病例</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="patient-history" name="patient-history" placeholder="无" value="{{$appointments->patient_history}}">
                                @include('layouts.message.tips',['field'=>'patient-history'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">患者需求信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="demand-doctor-name" class="col-sm-3 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="demand-doctor-name" name="demand-doctor-name" placeholder="无" value="{{$appointments->patient_demand_doctor_name}}">
                                @include('layouts.message.tips',['field'=>'demand-doctor-name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="demand-hospital" class="col-sm-3 control-label">医院</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="demand-hospital" name="demand-hospital" placeholder="无" value="{{$appointments->patient_demand_hospital}}">
                                @include('layouts.message.tips',['field'=>'demand-hospital'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="demand-dept" class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="demand-dept" name="demand-dept" placeholder="无" value="{{$appointments->patient_demand_dept}}">
                                @include('layouts.message.tips',['field'=>'demand-dept'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="demand-title" class="col-sm-3 control-label">头衔</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="demand-title" name="demand-title" placeholder="无" value="{{$appointments->patient_demand_title}}">
                                @include('layouts.message.tips',['field'=>'demand-title'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">约诊医生信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="doctor-name" class="col-sm-3 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="doctor-name" name="doctor-name" placeholder="无" value="{{$appointments->doctor_name}}">
                                @include('layouts.message.tips',['field'=>'doctor-name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="doctor-avatar" class="col-sm-3 control-label">头像</label>
                            <div class="col-sm-9">
                                <img src="{{$appointments->doctor_avatar}}" alt="image without thumbnail corners">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="auth" class="col-sm-3 control-label">认证状态</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="auth" name="auth" placeholder="无" value="{{$appointments->doctor_auth}}">
                                @include('layouts.message.tips',['field'=>'auth'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">城市</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="city" name="city" placeholder="无" value="{{$appointments->city}}">
                                @include('layouts.message.tips',['field'=>'city'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hospital" class="col-sm-3 control-label">医院</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="hospital" name="hospital" placeholder="无" value="{{$appointments->hospital}}">
                                @include('layouts.message.tips',['field'=>'hospital'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept" class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="dept" name="dept" placeholder="无" value="{{$appointments->dept}}">
                                @include('layouts.message.tips',['field'=>'dept'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="college" class="col-sm-3 control-label">毕业院校</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="college" name="college" placeholder="无" value="{{$appointments->college}}">
                                @include('layouts.message.tips',['field'=>'college'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">级别</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="title" name="title" placeholder="无" value="{{$appointments->doctor_title}}">
                                @include('layouts.message.tips',['field'=>'title'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">其他信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="focus_img_url" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <p class="help-block"><strong style="color:red">注意：输入拒绝原因，提交将会拒绝此单内容。</strong>不输入直接提交则为同意。</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="refuse_info" class="col-sm-3 control-label" style="color:red">拒绝原因</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="refuse_info" name="refuse_info" placeholder="输入拒绝原因，该信息会提示用户" value="">
                                @include('layouts.message.tips',['field'=>'refuse_info'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('appointment.todo')}}">返回</a>
                        {{--<a class="btn btn-warning" href="{{URL::to('appointment/refuse/'.$appointments->id)}}">拒绝</a>--}}
                        <button type="submit" class="btn btn-primary pull-right">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
