@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.log') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('log.customer.index') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 客户{{ config('subscribesystem.log') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="logs-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>时间</th>
                            <th>账号</th>
                            <th>成功</th>
                            <th>IP地址</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->logintime }}</td>
                            <td>{{ $log->loginaccount }}</td>
                            <td>{{ $log->successflag }}</td>
                            <td>{{ $log->ipaddress }}</td>

                            <td>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {!! $logs->render()  !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
      
    </script>
@stop