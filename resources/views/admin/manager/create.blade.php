@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>管理员 <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建管理员窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('manager.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.manager._form')

                        <div class="form-group">
                            <label for="newpassword" class="col-md-3 control-label">
                                密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="newpassword" name="newpassword">
                            </div>
                        </div>    
 
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-3 control-label">
                                确认新密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加管理员
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