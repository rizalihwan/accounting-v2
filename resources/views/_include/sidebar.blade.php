<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="home">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="home"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div>
                <div class="nav-lavel">{{ __('Documentation')}} </div>
                <div class="nav-item {{ ($segment1 == 'rest-api') ? 'active' : '' }}">
                    <a href="{{url('rest-api')}}"><i class="ik ik-cloud"></i><span>{{ __('REST API')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'permission-example') ? 'active' : '' }}">
                    <a href="{{url('permission-example')}}"><i class="ik ik-unlock"></i><span>{{ __('Laravel Permission')}}</span> </a>
                </div>
                <div class="nav-item {{ ($segment1 == 'table-datatable-edit') ? 'active' : '' }}">
                    <a href="{{url('table-datatable-edit')}}"><i class="ik ik-layout"></i><span>{{ __('Editable Datatable')}}</span>  </a>

                </div>
                <div class="nav-lavel">{{ __('Themekit Pages')}} </div>
                <div class="nav-item {{ ($segment1 == 'form-components' || $segment1 == 'form-advance'||$segment1 == 'form-addon') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Forms')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('form-components')}}" class="menu-item {{ ($segment1 == 'form-components') ? 'active' : '' }}">{{ __('Components')}}</a>
                        <a href="{{url('form-addon')}}" class="menu-item {{ ($segment1 == 'form-addon') ? 'active' : '' }}">{{ __('Add-On')}}</a>
                        <a href="{{url('form-advance')}}" class="menu-item {{ ($segment1 == 'form-advance') ? 'active' : '' }}">{{ __('Advance')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'form-picker') ? 'active' : '' }}">
                    <a href="{{url('form-picker')}}"><i class="ik ik-terminal"></i><span>{{ __('Form Picker')}}</span> </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'table-bootstrap') ? 'active' : '' }}">
                    <a href="{{url('table-bootstrap')}}"><i class="ik ik-credit-card"></i><span>{{ __('Bootstrap Table')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'table-datatable') ? 'active' : '' }}">
                    <a href="{{url('table-datatable')}}"><i class="ik ik-inbox"></i><span>{{ __('Data Table')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'navbar') ? 'active' : '' }}">
                    <a href="{{url('navbar')}}"><i class="ik ik-menu"></i><span>{{ __('Navigation')}}</span> </a>
                </div>
                <div class="nav-item {{ ($segment1 == 'widgets' || $segment1 == 'widget-statistic'||$segment1 == 'widget-data'||$segment1 == 'widget-chart') ? 'active open' : '' }} has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>{{ __('Widgets')}}</span> <span class="badge badge-danger">{{ __('150+')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('widgets')}}" class="menu-item {{ ($segment1 == 'widgets') ? 'active' : '' }}">{{ __('Basic')}}</a>
                        <a href="{{url('widget-statistic')}}" class="menu-item {{ ($segment1 == 'widget-statistic') ? 'active' : '' }}">{{ __('Statistic')}}</a>
                        <a href="{{url('widget-data')}}" class="menu-item {{ ($segment1 == 'widget-data') ? 'active' : '' }}">{{ __('Data')}}</a>
                        <a href="{{url('widget-chart')}}" class="menu-item {{ ($segment1 == 'widget-chart') ? 'active' : '' }}">{{ __('Chart Widget')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'alerts' || $segment1 == 'buttons'||$segment1 == 'badges'||$segment1 == 'navigation') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-box"></i><span>{{ __('Basic')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('alerts')}}" class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Alerts')}}</a>
                        <a href="{{url('badges')}}" class="menu-item {{ ($segment1 == 'badges') ? 'active' : '' }}">{{ __('Badges')}}</a>
                        <a href="{{url('buttons')}}" class="menu-item {{ ($segment1 == 'buttons') ? 'active' : '' }}">{{ __('Buttons')}}</a>
                        <a href="{{url('navigation')}}" class="menu-item {{ ($segment1 == 'navigation') ? 'active' : '' }}">{{ __('Navigation')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'modals' || $segment1 == 'notifications'||$segment1 == 'carousel'||$segment1 == 'range-slider' ||$segment1 == 'rating') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-gitlab"></i><span>{{ __('Advance')}}</span> </a>
                    <div class="submenu-content">
                        <a href="{{url('modals')}}" class="menu-item {{ ($segment1 == 'modals') ? 'active' : '' }}">{{ __('Modals')}}</a>
                        <a href="{{url('notifications')}}" class="menu-item {{ ($segment1 == 'notifications') ? 'active' : '' }}" >{{ __('Notifications')}}</a>
                        <a href="{{url('carousel')}}" class="menu-item {{ ($segment1 == 'carousel') ? 'active' : '' }}">{{ __('Slider')}}</a>
                        <a href="{{url('range-slider')}}" class="menu-item {{ ($segment1 == 'range-slider') ? 'active' : '' }}">{{ __('Range Slider')}}</a>
                        <a href="{{url('rating')}}" class="menu-item {{ ($segment1 == 'rating') ? 'active' : '' }}">{{ __('Rating')}}</a>
                    </div>
                </div>


                <div class="nav-item {{ ($segment1 == 'charts-chartist' || $segment1 == 'charts-flot'||$segment1 == 'charts-knob'||$segment1 == 'charts-amcharts') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-pie-chart"></i><span>{{ __('Charts')}}</span> </a>
                    <div class="submenu-content">
                        <a href="{{url('charts-chartist')}}" class="menu-item {{ ($segment1 == 'charts-chartist') ? 'active' : '' }}">{{ __('Chartist')}}</a>
                        <a href="{{url('charts-flot')}}" class="menu-item {{ ($segment1 == 'charts-flot') ? 'active' : '' }}">{{ __('Flot')}}</a>
                        <a href="{{url('charts-knob')}}" class="menu-item {{ ($segment1 == 'charts-knob') ? 'active' : '' }}">{{ __('Knob')}}</a>
                        <a href="{{url('charts-amcharts')}}" class="menu-item {{ ($segment1 == 'charts-amcharts') ? 'active' : '' }}">{{ __('Amcharts')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'calendar') ? 'active' : '' }}">
                    <a href="{{url('calendar')}}"><i class="ik ik-calendar"></i><span>{{ __('Calendar')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'taskboard') ? 'active' : '' }}">
                    <a href="{{url('taskboard')}}"><i class="ik ik-server"></i><span>{{ __('Taskboard')}}</span></a>
                </div>

                <div class="nav-item {{ ($segment1 == 'login-1' || $segment1 == 'register'||$segment1 == 'forgot-password') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-lock"></i><span>{{ __('Authentication')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('login-1')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('Login')}}</a>
                        <a href="{{url('register')}}" class="menu-item {{ ($segment1 == 'register-1') ? 'active' : '' }}">{{ __('Register')}}</a>
                        <a href="{{url('forgot-password')}}" class="menu-item {{ ($segment1 == 'forgot-password') ? 'active' : '' }}">{{ __('Forgot Password')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'profile' || $segment1 == 'invoice'||$segment1 == 'session-timeout') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-file-text"></i><span>{{ __('Pages')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('profile')}}" class="menu-item {{ ($segment1 == 'profile') ? 'active' : '' }}">{{ __('Profile')}}</a>
                        <a href="{{url('invoice')}}" class="menu-item {{ ($segment1 == 'invoice') ? 'active' : '' }}">{{ __('Invoice')}}</a>
                        <a href="{{url('project')}}" class="menu-item {{ ($segment1 == 'project') ? 'active' : '' }}">{{ __('Project')}}</a>
                        <a href="{{url('view')}}" class="menu-item {{ ($segment1 == 'view') ? 'active' : '' }}">{{ __('View')}}</a>
                        <a href="{{url('session-timeout')}}" class="menu-item {{ ($segment1 == 'session-timeout') ? 'active' : '' }}">{{ __('Session Timeout')}}</a>
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'layouts') ? 'active' : '' }}">
                    <a href="{{url('layouts')}}"><i class="ik ik-layout"></i><span>{{ __('Layouts')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'icons') ? 'active' : '' }}">
                    <a href="{{url('icons')}}"><i class="ik ik-command"></i><span>{{ __('Icons')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'pricing') ? 'active' : '' }}">
                    <a href="{{url('pricing')}}"><i class="ik ik-dollar-sign"></i><span>{{ __('Pricing')}}</span><span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                </div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-list"></i><span>{{ __('Menu Levels')}}</span></a>
                    <div class="submenu-content">
                        <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.1')}}</a>
                        <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }} has-sub">
                            <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.2')}}</a>
                            <div class="submenu-content">
                                <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 3.1')}}</a>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.3')}}</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>{{ __('Disabled Menu')}}</span></a>
                </div>

        </div>
    </div>
</div>
