@extends('layouts.app')

@section('styles')
    <link href="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.css')  }}" rel="stylesheet" />
@stop

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('subscribesystem.detail') }} <small>» 编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑{{ config('subscribesystem.detail') }}窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')
                    @include('partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('detail.update', [$product->id, $detail->id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="did" value="{{ $detail->id }}">                        
                        
                        <div class="form-group">
                            <label for="managername" class="col-md-3 control-label">
                                管理员
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="managername" name="managername" value="{{ $product->manager->managername }}" readonly>
                            </div>
                        </div>

                        @include('admin.productdetail._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-times-circle"></i>
                                    删除
                                </button>
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('detail.index', $product->id) }}">
                                    <i class="fa fa-reply"></i>
                                    返回
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- 确认删除 --}}
<div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请确认修改</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    是否真的需要删除此{{ config('subscribesystem.detail') }}？
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('detail.destroy', [$detail->productifo_id, $detail->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i> 确认
                    </button>
                </form>
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
        $('#usedate').datetimepicker({
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