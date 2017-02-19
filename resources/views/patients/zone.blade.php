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
                    <h3 class="box-title">{{ $page_title }}</h3>
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
                            <th>健康合作码</th>
                            <th>姓名</th>
                            <th>手机号</th>
                            <th>总收入</th>
                            <th>性别</th>
                            <th>省市</th>
                        </tr>
                        @forelse($patients as $patient)
                            <tr>
                                <td>{{str_pad($patient->city_code, 4, '0', STR_PAD_LEFT) . str_pad($patient->code, 3, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->phone}}</td>
                                <td>{{(empty($patient->total) ? 0 : $patient->total) . '元'}}</td>
                                @if($patient->gender == 1)
                                    <td>男</td>
                                @else
                                    <td>女</td>
                                @endif
                                <td>{{(($patient->province) ? $patient->province . ' \ ' : '') . $patient->city}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($patients->render() !== "")
                    <div class="box-footer">
                        {!! $patients->render() !!}
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
