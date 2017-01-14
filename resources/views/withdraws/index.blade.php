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
                    <h3 class="box-title">提现列表</h3>
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
                            <th>序号</th>
                            <th>医生姓名</th>
                            <th>收入时间段（年 / 月）</th>
                            <th>月收入总额</th>
                            <th>已缴纳税额</th>
                            <th>提现金额</th>
                            <th>申请时间</th>
                            <th>管理操作</th>
                        </tr>
                        @forelse($settlements as $settlement)
                            <tr>
                                <td>{{$settlement->id}}</td>
                                <td>{{$settlement->doctor}}</td>
                                <td>{{$settlement->year . ' / '. $settlement->month}}</td>
                                <td>{{$settlement->total}}</td>
                                <td>{{$settlement->tax_payment}}</td>
                                <td>{{($settlement->total - $settlement->tax_payment)}}</td>
                                <td>{{$settlement->withdraw_request_date}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('withdraw/'.$settlement->id.'/edit')}}">
                                        操作
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($settlements->render() !== "")
                    <div class="box-footer">
                        {!! $settlement->render() !!}
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