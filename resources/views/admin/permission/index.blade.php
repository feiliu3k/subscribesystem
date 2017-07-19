@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>权限 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('permission.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建权限
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="permission-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>名称</th>
                            <th>标签</th>
                            <th>描述</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td data-order="{{ $permission->id }}">{{ $permission->id }}</td>
                            <td>{{ $permission->permissionname }}</td>
                            <td>{{ $permission->permissionlabel }}</td>
                            <td>{{ $permission->description}}</td>
                            <td>
                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $("#permission-table").DataTable({
            });
        });
    </script>
@stop