@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>管理员 <small>» 编辑</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑管理员窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')
                    @include('partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('manager.update', $manager->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $manager->id }}">


                        @include('admin.manager._form')

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
                                <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modal-change">
                                    <i class="fa fa-times-circle"></i>
                                    修改密码
                                </button>
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('manager.index') }}">
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
                    是否真的需要删除此管理员？
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('manager.destroy', $manager->id) }}">
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

{{-- 修改密码 --}}

    <div class="modal fade" id="modal-change" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">请确认修改</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('manager.changePassword') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $manager->id }}">
                        <div class="form-group">
                            <label for="newpassword" class="control-label">
                                新密码
                            </label>
                            <div >
                                <input type="password" class="form-control" name="newpassword" id="newpassword" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label">
                                确认新密码
                            </label>
                            <div >
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div >
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> 确认
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop