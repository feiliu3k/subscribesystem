<ul class="nav navbar-nav">
    <li><a href="{{ url('/') }}">首页</a></li>
    @if (Auth::check())
        @can('list-product')
            <li @if (Request::is('admin/product*')) class="active" @endif>
                <a href="{{ url('admin/product') }}">{{ config('subscribesystem.product') }}</a>
            </li>
        @endcan
        @can('list-detail')
            <li @if (Request::is('admin/productDetail*')) @endif>
                <a href="{{ url('admin/productDetail') }}">{{ config('subscribesystem.detail') }}</a>
            </li>
        @endcan
        @can('list-buyrecord')
            <li @if (Request::is('admin/buyrecord*')) @endif>
                <a href="{{ url('admin/buyrecord') }}">{{ config('subscribesystem.buyrecord') }}</a>
            </li>
        @endcan
        @can('list-badrecord')
            <li @if (Request::is('admin/badrecord*')) @endif>
                <a href="{{ url('admin/badrecord') }}">{{ config('subscribesystem.badrecord') }}</a>
            </li>
        @endcan
    @endif
</ul>
<ul class="nav navbar-nav nav-tabs">
    @if (Auth::check())
        @can('edit-user')
        <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          系统工具 <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/area') }}">区域</a></li>
            <li><a href="{{ url('admin/company') }}">单位</a></li>
            <li><a href="{{ url('admin/company') }}">类型</a></li>
            <li><a href="{{ url('admin/company') }}">功能</a></li>
            <li><a href="{{ url('admin/customer') }}">客户</a></li>
            <li><a href="{{ url('admin/log/manager') }}">日志</a></li>
            <hr>
            <li><a href="{{ url('admin/manager') }}">管理员</a></li>            
            <li><a href="{{ url('admin/role') }}">角色</a></li>
            <li><a href="{{ url('admin/permission') }}">权限</a></li>
        </ul>
        </li>
        @endcan
    @endif
</ul>


<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <li><a href="{{ url('auth/login') }}">登陆</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('auth/logout') }}">注销</a></li>
            </ul>
        </li>
    @endif
</ul>