<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    @php
        use App\Models\Employee;
        $user_role=Employee::where('employee_id',Session::get('profile_id'))->first();

@endphp

    @if ($user_role->user_type==0)
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{url('/admin/dashboard')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>Dashboards

                    </a>

                </li>
                <li class="app-sidebar__heading">Employee Components</li>
                <li>
                    <a href="{{url('/admin/create-employee')}}">
                        <i class="metismenu-icon pe-7s-add-user"></i>AddEmployee
                    </a>
                </li>
                <li>
                    <a href="{{url('/controlpanel/all-employee')}}">
                        <i class="metismenu-icon pe-7s-user"></i>AllEmployee
                    </a>
                </li>
                <li class="app-sidebar__heading">Website Components</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-culture"></i>Properties
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/controlpanel/create-property')}}" >
                                <i class="metismenu-icon"></i>New Properties
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/controlpanel/property')}}">
                                <i class="metismenu-icon"></i>All Properties
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-browser"></i>Homepage
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="pages-login.html" >
                                <i class="metismenu-icon"></i>Banners
                            </a>
                        </li>
                        <li>
                            <a href="pages-login-boxed.html" >
                                <i class="metismenu-icon"></i>Testimonial
                            </a>
                        </li>
                        <li>
                            <a href="pages-register.html" >
                                <i class="metismenu-icon"></i>Partner
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-browser"></i>Blogs
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="pages-login.html" >
                                <i class="metismenu-icon"></i>New Blog
                            </a>
                        </li>
                        <li>
                            <a href="pages-login-boxed.html" >
                                <i class="metismenu-icon"></i>All Blogs
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Leads Components</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-news-paper"></i>Leads
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/admin/leads')}}" >
                                <i class="metismenu-icon"></i>All Leads
                            </a>
                        </li>
                        <li>
                        <a href="{{url('/admin/leads-status')}}" >
                                <i class="metismenu-icon"></i>Lead Status
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </div>
    @elseif(Session::get('Employee-Role'))
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{url('/crm-employee/dashboard')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Leads Components</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-news-paper"></i>Leads
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/crm-employee/leads')}}" >
                                <i class="metismenu-icon"></i>All Leads
                            </a>
                        </li>

                        <li>
                        <a href="{{url('/crm-employee/leads-status')}}" >
                                <i class="metismenu-icon"></i>Active Leads
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/crm-employee/assigned-leads')}}" >
                                    <i class="metismenu-icon"></i>Assigned Leads
                                </a>
                        </li>
                        <li>
                            <a href="{{url('/crm-employee/leads-status')}}" >
                                    <i class="metismenu-icon"></i>Due Calls Leads
                                </a>
                        </li>
                        <li>
                            <a href="{{url('/crm-employee/leads-status')}}" >
                                    <i class="metismenu-icon"></i>Dead Leads
                                </a>
                        </li>
                        <li>
                            <a href="{{url('/crm-employee/leads-status')}}" >
                            <i class="metismenu-icon"></i>Closed Leads
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    @else

    @endif

</div>
