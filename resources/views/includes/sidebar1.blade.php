<!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

        <div class="navbar-header">

            <ul class="nav navbar-nav flex-row">

                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{asset('public/html/ltr/vertical-collapsed-menu-template/index.html')}}">

                <img style="margin-bottom: 15px!important;"  src="{{ asset('public/app-assets/images/logo/codify.png') }}" alt="tag" width="95" !important>


                        <h1 style="margin-left:-70px !important;margin-bottom: 15px!important;color: goldenrod;" class="brand-text">odify</h1>

                    </a></li>

                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>

            </ul>

        </div>

        <div class="shadow-bottom"></div>

        <div class="main-menu-content">

            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class=" nav-item"><a class="d-flex align-items-center" href="empDashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>

                </li>

                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>

                </li>


                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="User">Work</span></a>

                    <ul class="menu-content">

                        <li><a class="d-flex align-items-center" href="assignProject"><i data-feather="circle"></i><span class="menu-item" data-i18n="List">Project</span></a>

                        </li>

                        <li><a class="d-flex align-items-center" href="createTask"><i data-feather="circle"></i><span class="menu-item" data-i18n="List">Task</span></a>

                        </li>

                    </ul>

                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="User">Reports</span></a>

                    <ul class="menu-content">

                        <li><a class="d-flex align-items-center" href="{{route('Emp_time_log')}}"><i data-feather="circle"></i><span class="menu-item" data-i18n="List">Time Log</span></a>

                        </li>

                    </ul>

                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="User">Notice Board</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('show_emp_notice')}}"><i data-feather="circle"></i><span class="menu-item" data-i18n="List">Notice</span></a>
                        </li>
                    </ul>
                </li>


                
                
            </ul>

        </div>

    </div>

    <!-- END: Main Menu-->