@extends('layouts.app')

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
                            <label for="managername" class="col-md-4 control-label">姓名：</label>

                            <div class="col-md-6">
                                <input id="managername" type="text" class="form-control" name="managername" value="{{ old('managername') }}" required autofocus>

                                @if ($errors->has('managername'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('managername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('manageraccount') ? ' has-error' : '' }}">
                            <label for="manageraccount" class="col-md-4 control-label">账号：</label>

                            <div class="col-md-6">
                                <input id="manageraccount" type="text" class="form-control" name="manageraccount" value="{{ old('manageraccount') }}" required>

                                @if ($errors->has('manageraccount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manageraccount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">确认密码：</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    注册
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
