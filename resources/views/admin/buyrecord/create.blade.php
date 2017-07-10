@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('subscribesystem.buyrecord') }} <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建{{ config('subscribesystem.buyrecord') }}窗口</h3>
                </div>
                <div class="panel-body">
                
                    @include('partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('buyrecrod.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.buyrecord._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加新{{ config('subscribesystem.buyrecord') }}
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
             </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
	<script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/ueditor.all.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
	
    <script src="{{ URL::asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/js/i18n/zh-CN.js') }}"></script>

   
@stop