@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
        @include('backpack::inc.sidebar_user_panel')

        <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
            {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
            <!-- ================================================ -->
                <!-- ==== Recommended place for admin menu items ==== -->
                <!-- ================================================ -->
                <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i>
                        <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
                <li><a href="{{  backpack_url('elfinder') }}"><i class="fa fa-files-o"></i>
                <span>Менеджер файлов</span></a></li>
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class="fa fa-globe"></i> <span>Translations</span> <i--}}
                                {{--class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language') }}"><i--}}
                                        {{--class="fa fa-flag-checkered"></i> Languages</a></li>--}}
                        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/language/texts') }}"><i--}}
                                        {{--class="fa fa-language"></i> Site texts</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Окна</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ backpack_url('windows') }}"><i class="fa fa-circle-o"></i> <span>Окна</span></a>
                            <a href="{{ backpack_url('wtype') }}"><i class="fa fa-circle-o"></i> <span>Типы окон</span></a>
                            <a href="{{ backpack_url('wprofile') }}"><i class="fa fa-circle-o"></i>
                                <span>Профили окон</span></a>
                        </li>
                    </ul>
                </li>
                <li class="header">Пользователи</li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-group"></i> <span>Права, роли</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i
                                        class="fa fa-user"></i> <span>Пользователи</span></a></li>
                        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i
                                        class="fa fa-group"></i> <span>Роли</span></a></li>
                        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i
                                        class="fa fa-key"></i> <span>Права</span></a></li>
                    </ul>
                </li>
                <li class="header">Настройки</li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}"><i
                                class="fa fa-cog"></i> <span>Настройки</span></a></li>

                <!-- ======================================= -->
                {{-- <li class="header">Other menus</li> --}}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
@endif
