@extends('layouts.app')

@section('styles')
    <link href="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.css')  }}" rel="stylesheet" />
@stop

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.badrecord') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">                
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-search">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.badrecord') }}
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="badrecords-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>                           
                            <th>客户账号</th> 
                            <th>{{ config('subscribesystem.product') }}名称</th>
                            <th>预定日期</th>
                            <th>开始时间</th> 
                            <th>结束时间</th>
                            <th>数量</th> 
                            <th>token</th> 
                            <th>下单时间</th> 
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($badrecords as $badrecord)
                        <tr>                                                       
                            <td>{{ $badrecord->customer->customeraccount }}</td>
                            <td>{{ $badrecord->product->productname }}</td>
                            <td>{{ $badrecord->detail->usedate }}</td>
                            <td>{{ $badrecord->detail->usebegintime }}</td>                            
                            <td>{{ $badrecord->detail->useendtime }}</td>                            
                            <td>{{ $badrecord->buyproductnum }}</td>                           
                            <td>{{ $badrecord->buytoken }}</td>                           
                            <td>{{ $badrecord->buytime }}</td>                           
                            <td>
                                <a href="{{ route('badrecord.edit', $badrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 详细
                                </a>   
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 搜索框 --}}
    <div class="modal fade" id="modal-search" tabIndex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">请输入查询条件</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('badrecord.search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="productname" class="col-md-3 control-label">
                                {{ config('subscribesystem.product') }}名称
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="productname" name="productname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="customeraccount" class="col-md-3 control-label">
                                客户账号
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customeraccount" name="customeraccount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usebegindate" class="col-md-3 control-label">
                                日期范围
                            </label>
                            <div class="col-md-4">
                                <div class="input-group date" id="usebegindate">
                                    <input type="text" class="form-control" name="usebegindate">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group date" id="useenddate">
                                    <input type="text" class="form-control" name="useenddate">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usebegintime" class="col-md-3 control-label">
                                时间范围
                            </label>
                            <div class="col-md-4">
                                <div class="input-group date" id="usebegintime">
                                    <input type="text" class="form-control" name="usebegintime">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group date" id="useendtime">
                                    <input type="text" class="form-control" name="useendtime">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>             
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3 ">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-times-circle"></i> 提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/moment-with-locales.js')  }}">
    </script>
	<script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.js')  }}">
    </script>
    
    <script type="text/javascript">
        $(function () {
            $('#usebegindate').datetimepicker({
                locale: 'zh-CN',
                format: 'YYYY-MM-DD',
            });
            
            $('#useenddate').datetimepicker({
                locale: 'zh-CN',
                format: 'YYYY-MM-DD'
            });

            $('#usebegintime').datetimepicker({
                locale: 'zh-CN',
                format: 'HH:mm:ss'
            });
            
            $('#useendtime').datetimepicker({
                locale: 'zh-CN',
                format: 'HH:mm:ss'
            });
        });
    </script>
@stop