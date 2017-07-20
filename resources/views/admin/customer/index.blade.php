@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>客户 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('customer.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建客户
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="customers-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>姓名</th>
                            <th>账号</th>
                            <th>电话</th>
                            <th>邮件</th>
                            <th>身份证</th>
                            <th>信用</th>
                            <th>性别</th>                            
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->customername }}</td>
                            <td>{{ $customer->customeraccount }}</td>
                            <td>{{ $customer->cellphone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->IDCard }}</td>
                            <td>{{ $customer->credit }}</td>                            
                            <td>
                                @if ($customer->sex==0)
                                    未知
                                @elseif ($customer->sex==1)
                                    男
                                @else
                                    女
                                @endif                            
                            <td>
                                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-xs btn-info">
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
            $("#customers-table").DataTable({
            });
        });
    </script>
@stop