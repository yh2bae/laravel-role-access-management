<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Main Menu</li>
    
                {{-- <li>
                    <a href="{{ route('dashboard.index') }}" data-bs-toggle="collapse">
                        <i data-feather="airplay"></i>
                        <span> Dashboards </span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="index.html">Dashboard 1</a>
                            </li>
                            <li>
                                <a href="dashboard-2.html">Dashboard 2</a>
                            </li>
                            <li>
                                <a href="dashboard-3.html">Dashboard 3</a>
                            </li>
                            <li>
                                <a href="dashboard-4.html">Dashboard 4</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fe-users"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                @if(user_akses2('user', Auth::user()->role_id )->view ?? 0 =='1' OR user_akses2('role', Auth::user()->role_id )->view ?? 0 =='1')  
                <li class="menu-title mt-2">User Setting</li>
                @endif


                @if(user_akses2('user', Auth::user()->role_id )->view ?? 0 =='1')  
                <li>
                    <a href="{{ route('user.index') }}">
                        <i class="fe-users"></i>
                        <span> Users Account</span>
                    </a>
                </li>
                @endif

                @if(user_akses2('role', Auth::user()->role_id)->view ?? 0 =='1')
                <li>
                    <a href="{{ route('role.index') }}">
                        <i class="fas fa-user-lock"></i>
                        <span> Role Access</span>
                    </a>
                </li>
                @endif

                
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>