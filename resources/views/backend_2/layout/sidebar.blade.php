<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @can('show-profile')
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{!! route('profile.show', auth()->user()->getAuthIdentifier()) !!}" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>
        @endcan
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @can('index-dashboard')
                    <li class="nav-item">
                        <a href="{!! route('dashboard') !!}" class="nav-link">
                            <i class="fa fa-home blue" aria-hidden="true"></i>
                            <p>
                                {{trans('dashboard.dashboard')}}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('index-user')
                    <li class="nav-item">
                        <a href="{!! route('user.index') !!}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                {{trans('user.users')}}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('index-activity-log')
                    <li class="nav-item">
                        <a href="{!! route('activity_log.index') !!}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                {{trans('activity_log.activity_logs')}}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('index-role')
                    <li class="nav-item">
                        <a href="{!! route('role.index') !!}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                {{trans('role.roles')}}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('index-permission')
                    <li class="nav-item">
                        <a href="{!! route('permission.index') !!}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                {{trans('permission.permissions')}}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('index-setting')
                    <li class="nav-item">
                        <a href="{!! route('setting.index') !!}" class="nav-link">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                {{trans('setting.setting')}}
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('manage-log')
                    <li class="nav-item">
                        <a href="{!! route('logs') !!}" class="nav-link">
                            <i class="nav-icon fa fa-history"></i>
                            <p>
                                {{trans('common.logs')}}
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>