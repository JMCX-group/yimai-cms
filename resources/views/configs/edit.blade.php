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
        <div class="col-md-9">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('config/'.$config->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <ul class="breadcrumb">
                            <li><a href="#">接诊费设置</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="top-director" class="col-sm-4 control-label">顶级科室 - 主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="top-director" name="top-director" placeholder="无" value="{{$config->top_director}}">
                                @include('layouts.message.tips',['field'=>'top-director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="top-deputy-director" class="col-sm-4 control-label">顶级科室 - 副主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="top-deputy-director" name="top-deputy-director" placeholder="无" value="{{$config->top_deputy_director}}">
                                @include('layouts.message.tips',['field'=>'top-deputy-director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="bsg-3a-director" class="col-sm-4 control-label">北上广三甲 - 主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bsg-3a-director" name="bsg-3a-director" placeholder="无" value="{{$config->bsg_3a_director}}">
                                @include('layouts.message.tips',['field'=>'bsg-3a-director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="bsg-3a-deputy-director" class="col-sm-4 control-label">北上广三甲 - 副主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bsg-3a-deputy-director" name="bsg-3a-deputy-director" placeholder="无" value="{{$config->bsg_3a_deputy_director}}">
                                @include('layouts.message.tips',['field'=>'bsg-3a-deputy_director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="other-3a-director" class="col-sm-4 control-label">三甲 - 主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="other-3a-director" name="other-3a-director" placeholder="无" value="{{$config->other_3a_director}}">
                                @include('layouts.message.tips',['field'=>'other-3a-director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="other-3a-deputy-director" class="col-sm-4 control-label">三甲 - 副主任医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="other-3a-deputy-director" name="other-3a-deputy-director" placeholder="无" value="{{$config->other_3a_deputy_director}}">
                                @include('layouts.message.tips',['field'=>'other-3a-deputy-director'])
                            </div>
                            <label class="control-label">元</label>
                        </div>
                        <div class="form-group">
                            <label for="other-doctor" class="col-sm-4 control-label">其他 - 各种医师</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="other-doctor" name="other-doctor" placeholder="无" value="{{$config->other_doctor}}">
                                @include('layouts.message.tips',['field'=>'other-doctor'])
                            </div>
                            <label class="control-label">元</label>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">费率设置</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="doctor-to-appointment" class="col-sm-4 control-label">医生发送约诊请求</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="doctor-to-appointment" name="doctor-to-appointment" placeholder="无" value="{{$config->doctor_to_appointment}}">
                                @include('layouts.message.tips',['field'=>'doctor-to-appointment'])
                            </div>
                            <label class="control-label">%</label>
                        </div>
                        <div class="form-group">
                            <label for="patient-to-appointment" class="col-sm-4 control-label">患者发送代约请求</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="patient-to-appointment" name="patient-to-appointment" placeholder="无" value="{{$config->patient_to_appointment}}">
                                @include('layouts.message.tips',['field'=>'patient-to-appointment'])
                            </div>
                            <label class="control-label">%</label>
                        </div>
                        <div class="form-group">
                            <label for="patient-to-admissions" class="col-sm-4 control-label">患者发送约诊请求</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="patient-to-admissions" name="patient-to-admissions" placeholder="无" value="{{$config->patient_to_admissions}}">
                                @include('layouts.message.tips',['field'=>'patient-to-admissions'])
                            </div>
                            <label class="control-label">%</label>
                        </div>
                        <div class="form-group">
                            <label for="patient-to-platform-appointment" class="col-sm-4 control-label">患者发送平台代约请求（已有专家）</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="patient-to-platform-appointment" name="patient-to-platform-appointment" placeholder="无" value="{{$config->patient_to_platform_appointment}}">
                                @include('layouts.message.tips',['field'=>'patient-to-platform-appointment'])
                            </div>
                            <label class="control-label">%</label>
                        </div>
                        <div class="form-group">
                            <label for="patient-to-platform-appointment-specify" class="col-sm-4 control-label">患者发送平台代约请求（指定专家）</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="patient-to-platform-appointment-specify" name="patient-to-platform-appointment-specify" placeholder="无" value="{{$config->patient_to_platform_appointment_specify}}">
                                @include('layouts.message.tips',['field'=>'patient-to-platform-appointment-specify'])
                            </div>
                            <label class="control-label">%</label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('config.index')}}">返回</a>
                        <button type="submit" class="btn btn-primary pull-right">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
