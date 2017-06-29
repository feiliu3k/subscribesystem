@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>角色 <small>» 权限编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑角色权限窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')
                    @include('partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/role/updatePermission', $role->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $role->id }}">


                        <table id="permissions-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>名称</th>
                                <th>标签</th>
                                <th>描述</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        @if(in_array($permission['id'],array_values($rolePermissions)))
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked />
                                        @else
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" />
                                        @endif
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->permissionname }}</td>
                                    <td>{{ $permission->permissionlabel }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('role.index') }}">
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
