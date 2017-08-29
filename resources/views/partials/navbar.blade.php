<ul class="nav navbar-nav">
    <li><a href="{{ url('/admin/dash') }}">首页</a></li>
    @if (Auth::check())
        @can('list-product')
            <li @if (Request::is('admin/product*')) class="active" @endif>
                <a href="{{ url('admin/product') }}">{{ config('subscribesystem.product') }}</a>
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
        @can('list-comment')
            <li @if (Request::is('admin/comment*')) @endif>
                <a href="{{ url('admin/comment') }}">{{ config('subscribesystem.comment') }}</a>
            </li>
        @endcan
    @endif
</ul>
@if (Auth::check())
    @can('is-admin')
    <ul class="nav navbar-nav nav-tabs">   
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            系统工具 <span class="caret"></span>
            </a>
            
            <ul class="dropdown-menu">
                <li><a href="{{ url('admin/area') }}">区域</a></li>
                <li><a href="{{ url('admin/company') }}">单位</a></li>
                <li><a href="{{ url('admin/productType') }}">类型</a></li>
                <li><a href="{{ url('admin/productFunction') }}">功能</a></li>
                <li><a href="{{ url('admin/customer') }}">客户</a></li>
                <li><a href="{{ url('admin/log/manager') }}">日志</a></li>
                
                <li><a href="{{ url('admin/manager') }}">管理员</a></li>
                <li><a href="{{ url('admin/role') }}">角色</a></li>
                <li><a href="{{ url('admin/permission') }}">权限</a></li>
                <li><a href="{{ url('admin/explorer/alllist') }}">导入管理员等数据</a></li>
                <li><a href="{{ url('admin/autogendetail') }}">自动产生场地细节数据</a></li>
            </ul>
        
        </li> 
    </ul>
    @endcan
@endif

<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">登录</a></li>
        <li><a href="{{ route('register') }}">注册</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->managername }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('admin.reset') }}" >                                           
                        修改密码
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        注销
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    @endif
</ul>