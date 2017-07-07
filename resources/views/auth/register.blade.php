@extends('layouts.app')

@section('styles')
    <style>
        .reqf {
            color: #F00;
            font-family: "SimSun";
            padding-right: 4px;
        }
    </style>   
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('managername') ? ' has-error' : '' }}">
                            <i class="reqf">*</i>
                            <label for="managername" class="col-md-2 control-label">姓名：</label>

                            <div class="col-md-8">
                                <input id="managername" type="text" class="form-control" name="managername" value="{{ old('managername') }}" required autofocus>

                                @if ($errors->has('managername'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('managername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('manageraccount') ? ' has-error' : '' }}">
                            <i class="reqf">*</i>
                            <label for="manageraccount" class="col-md-2 control-label">账号：</label>

                            <div class="col-md-8">
                                <input id="manageraccount" type="text" class="form-control" name="manageraccount" value="{{ old('manageraccount') }}" required>

                                @if ($errors->has('manageraccount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manageraccount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <i class="reqf">*</i>
                            <label for="password" class="col-md-2 control-label">密码：</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <i class="reqf">*</i>
                            <label for="password_confirmation" class="col-md-2 control-label">确认密码：</label>

                            <div class="col-md-8">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cellphone" class="col-md-2 control-label">手机号：</label>

                            <div class="col-md-8">
                                <input id="cellphone" type="text" class="form-control" name="cellphone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">email：</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="IDCard" class="col-md-2 control-label">身份证：</label>

                            <div class="col-md-8">
                                <input id="IDCard" type="text" class="form-control" name="IDCard">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="application_note" class="col-md-2 control-label">申请说明：</label>

                            <div class="col-md-8">                                
                                <textarea class="form-control" rows="3" id="application_note" name="application_note">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    注册
                                </button>
                                <button type="reset" class="btn btn-primary">
                                    重置
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
