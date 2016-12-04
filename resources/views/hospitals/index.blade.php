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
        <div class="col-md-1">
            <div class="small-box">
                <a href="{{URL::to('hospital/create')}}" class="btn btn-success">新增医院</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">医院列表</h3>
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
                            <th>医院编号</th>
                            <th>城市</th>
                            <th>医院名称</th>
                            <th>是否三甲</th>
                            <th>顶级科室数</th>
                            {{--<th>上线科室数</th>--}}
                            {{--<th>上线医生数</th>--}}
                            <th>状态</th>
                            <th>管理操作</th>
                        </tr>
                        @forelse($hospitals as $hospital)
                            <tr>
                                <td>{{$hospital->id}}</td>
                                <td>{{$hospital->city}}</td>
                                <td>{{$hospital->name}}</td>
                                <td>{{$hospital->three_a}}</td>
                                <td>{{$hospital->top_dept_num}}</td>
                                {{--<td></td>--}}
                                {{--<td></td>--}}
                                <td>{{$hospital->status}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('hospital/'.$hospital->id.'/edit')}}">
                                        编辑
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#defalutModal" data-url="{{URL::to('hospital/'.$hospital->id)}}">
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

                @if($hospitals->render() !== "")
                    <div class="box-footer">
                        {!! $hospitals->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这个医院吗?'])
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