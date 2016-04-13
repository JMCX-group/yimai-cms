<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/23
 * Time: 上午11:30
 */
?>

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-1">
            <div class="small-box">
                <a href="{{URL::to('illness/create')}}" class="btn btn-success">新增疾病</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">疾病</h3>
                    <div class="box-tools pull-right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="快速查询">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default disabled">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>疾病编号</th>
                            <th>总疾病名称</th>
                            <th>疾病名称</th>
                            <th>科室</th>
                            <th>症状</th>
                            <th>病因</th>
                            <th>临床表现</th>
                            <th>诊断</th>
                            <th>治疗</th>
                            <th>预后</th>
                            <th>预防</th>
                            <th>管理操作</th>
                        </tr>
                        @forelse($illnesss as $illness)
                            <tr>
                                <td>{{$illness->id}}</td>
                                <td>{{$illness->general_name}}</td>
                                <td>{{$illness->name}}</td>
                                <td>
                                    @if($illness->dept1_id != 0) {{$illness->dept1_name}} @endif
                                        @if($illness->dept1_id != 0 && $illness->dept2_id != 0) , @endif
                                    @if($illness->dept2_id != 0) {{$illness->dept2_name}} @endif
                                </td>
                                <td>
                                    @if($illness->symptom_1 != '') {{ $illness->symptom_1 }} @endif
                                    @if($illness->symptom_1 != '' && $illness->symptom_2 != '') , @endif
                                    @if($illness->symptom_2 != '') {{ $illness->symptom_2 }} @endif
                                    @if($illness->symptom_2 != '' && $illness->symptom_3 != '') , @endif
                                    @if($illness->symptom_3 != '') {{ $illness->symptom_3 }} @endif
                                    @if($illness->symptom_3 != '' && $illness->symptom_4 != '') , @endif
                                    @if($illness->symptom_4 != '') {{ $illness->symptom_4 }} @endif
                                    @if($illness->symptom_4 != '' && $illness->symptom_5 != '') , @endif
                                    @if($illness->symptom_5 != '') {{ $illness->symptom_5 }} @endif
                                </td>
                                <td>{{$illness->pathogen}}</td>
                                <td>{{$illness->clinical_manifestations}}</td>
                                <td>{{$illness->diagnosis}}</td>
                                <td>{{$illness->treatment}}</td>
                                <td>{{$illness->prognosis}}</td>
                                <td>{{$illness->prevention}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('illness/'.$illness->id.'/edit')}}">
                                        编辑
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#defalutModal" data-url="{{URL::to('illness/'.$illness->id)}}">
                                        删除
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($illnesss->render() !== "")
                    <div class="box-footer">
                        {!! $illnesss->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这个疾病吗?'])
@stop
@section('script')
    <script type="text/javascript">
        $('#defalutModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var modal = $(this);

            modal.find('form').attr('action', url);
        })
    </script>
@stop