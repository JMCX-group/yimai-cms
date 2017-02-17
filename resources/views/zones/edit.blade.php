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
        <div class="col-md-6">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('zone/'.$record->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <ul class="breadcrumb">
                            <li><a href="#">提现信息</a> <span class="divider"></span></li>
                        </ul>

                        <div class="form-group">
                            <label for="withdrawal-amount" class="col-sm-3 control-label">提现金额</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="withdrawal-amount" name="withdrawal-amount" placeholder="无" value="{{($record->total)}}">
                                @include('layouts.message.tips',['field'=>'withdrawal-amount'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">银行卡信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="bank-name" class="col-sm-3 control-label">银行名称</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="bank-name" name="bank-name" placeholder="无" value="{{$bank->bank_name}}">
                                @include('layouts.message.tips',['field'=>'bank-name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bank-no" class="col-sm-3 control-label">银行卡号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="bank-no" name="bank-no" placeholder="无" value="{{$bank->bank_no}}">
                                @include('layouts.message.tips',['field'=>'bank-no'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">患者基本信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="name" name="name" placeholder="无" value="{{$patients->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="phone" name="phone" placeholder="无" value="{{$patients->phone}}">
                                @include('layouts.message.tips',['field'=>'phone'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="col-sm-3 control-label">头像</label>
                            <div class="col-sm-9">
                                <img src="{{$patients->avatar}}" alt="image without thumbnail corners">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">省市</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="city" name="city" placeholder="无" value="{{$patients->province ? $patients->province . ' - ' : '' . $patients->city}}">
                                @include('layouts.message.tips',['field'=>'city'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('zone.index')}}">返回</a>
                        <button type="submit" class="btn btn-primary pull-right">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
