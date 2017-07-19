@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('subscribesystem.productFunction') }} <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建{{ config('subscribesystem.productFunction') }}窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('productFunction.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.productfunction._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加新{{ config('subscribesystem.productFunction') }}
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