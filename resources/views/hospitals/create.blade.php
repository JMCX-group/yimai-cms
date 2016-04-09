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
                <form class="form-horizontal" action="{{URL::to('hospital')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">所属城市</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="city" name="city" placeholder="所属城市" value="{{old('city')}}">
                                @include('layouts.message.tips',['field'=>'city'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">医院名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="医院名称" value="{{old('name')}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否三甲</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="three_a">
                                    <option value="Y">Y</option>
                                    <option value="N" selected>N</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'three_a'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">顶级科室</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" multiple="multiple" name="dept_standard_id[]" style="min-height: 480px;">
                                    <option value="0" selected>无</option>
                                    @foreach($dept_standards as $dept_standard)
                                        @if($dept_standard->dept_id == 0)
                                            <option value="{{$dept_standard->id}}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$dept_standard->name}}</option>
                                        @else
                                            <option value="{{$dept_standard->id}}">{{$dept_standard->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'dept_standard_id'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('hospital.index')}}">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
