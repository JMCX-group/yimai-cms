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
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">医生列表</h3>
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
                            {{--<th>序号</th>--}}
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>性别</th>
                            <th>省市</th>
                            <th>医院</th>
                            <th>科室</th>
                            <th>头衔</th>
                            <th>收件人</th>
                            <th>收件电话</th>
                            <th>快递单号</th>
                        </tr>
                        @forelse($doctors as $doctor)
                            <tr>
                                {{--<td>{{$doctor->id}}</td>--}}
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->phone}}</td>
                                @if($doctor->gender == 1)
                                    <td>男</td>
                                @else
                                    <td>女</td>
                                @endif
                                <td>{{$doctor->province}} \ {{$doctor->city}}</td>
                                <td>{{$doctor->hospital}}</td>
                                <td>{{$doctor->dept}}</td>
                                <td>{{$doctor->title}}</td>
                                <td>{{$doctor->addressee}}</td>
                                <td>{{$doctor->receive_phone}}</td>
                                <td>{{$doctor->express_no}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($doctors->render() !== "")
                    <div class="box-footer">
                        {!! $doctors->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
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
