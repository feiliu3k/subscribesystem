@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>管理员 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('manager.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建管理员
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="managers-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>姓名</th>
                            <th>账号</th>
                            <th>电话</th>
                            <th>邮件</th>
                            <th>身份证</th>
                            <th>申请说明</th>
                            <th>单位</th>
                            <th>审核</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($managers as $manager)
                        <tr>
                            <td>{{ $manager->id }}</td>
                            <td>{{ $manager->managername }}</td>
                            <td>{{ $manager->manageraccount }}</td>
                            <td>{{ $manager->cellphone }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->IDCard }}</td>
                            <td>{{ $manager->application_note }}</td>
                            <td>
                             @if ($manager->company)
                                {{ $manager->company->companyname }}
                             @endif   
                            </td>
                            <td>
                                @if ($manager->verifyflag)
                                    已审核
                                @else
                                    未审核
                                @endif                            
                            <td>
                                <a href="{{ route('manager.edit', $manager->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="{{ url('admin/manager/editRole', $manager->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 角色
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
            $("#managers-table").DataTable({
            });
        });
    </script>
@stop