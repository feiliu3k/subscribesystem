@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('subscribesystem.buyrecord') }} <small>» 编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑{{ config('subscribesystem.buyrecord') }}窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')
                    @include('partials.success')

                    <form class="form-horizontal" role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                        
                        <input type="hidden" name="id" value="{{ $buyrecord->id }}">
                        
                        @include('admin.buyrecord._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">                                
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('buyrecord.index') }}">
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
@stop
