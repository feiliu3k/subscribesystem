<ul class="nav navbar-nav">
    <li><a href="{{ url('/') }}">首页</a></li>
    <li><a href="# }}">项目1</a></li>
    <li><a href="# }}">项目1</a></li>
    <li><a href="# }}">项目1</a></li>    
</ul>
<ul class="nav navbar-nav nav-tabs">   
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        系统工具 <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{ url('admin/dept') }}">单位</a></li>
            <li><a href="{{ url('admin/pro') }}">栏目</a></li>

            <li><a href="{{ url('admin/user') }}">用户</a></li>
            <li><a href="{{ url('admin/role') }}">角色</a></li>
            <li><a href="{{ url('admin/permission') }}">权限</a></li>
        </ul>
    </li> 
</ul>


            <!-- Right Side Of Navbar -->
<ul class="nav navbar-nav">
    &nbsp;
</ul>

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