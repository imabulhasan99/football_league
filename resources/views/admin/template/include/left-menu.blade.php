<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{route('home')}}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset('assets/images/logo.png')}}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo">
        </span>
    </a>

 

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{route('home')}}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Home </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> League </span>
                    <span class="menu-arrow"></span>
                </a>

                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('league.add')}}">Add League</a>
                        </li>
                        <li>
                            <a href="{{ route('league.all') }}">All League</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="fa-sharp fa-solid fa-people-group fa-2xl" style="color: #72eedf;"></i>
                    <span> Teams </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('team.add')}}">Add Teams</a>
                        </li>
                        <li>
                            <a href="{{route('team.all')}}">All Teams</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="fa-sharp fa-solid fa-people-group fa-2xl" style="color: #72eedf;"></i>
                    <span> Fixtures </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('team.add') }}">Add EPL Fixture</a>
                            
                        </li>
                        <li>
                            <a href="{{ route('league.all') }}">Full EPL Fixture</a>
                            
                        </li>
                        <li>
                            <a href="{{route('team.all')}}">Add La Liga Fixture</a>
                        </li>

                        <li>
                            <a href="{{route('team.all')}}">Full La Liga Fixture</a>
                        </li>

                        <li>
                            <a href="{{ route('league.all') }}">Add Seria - A Fixture</a>    
                        </li>

                        <li>
                            <a href="{{ route('league.all') }}">Full Seria - A Fixture</a>    
                        </li>

                        
                        <li>
                            <a href="{{ route('league.all') }}">Add League-1 Fixture</a>    
                        </li>

                        <li>
                            <a href="{{ route('league.all') }}">Full League-1 Fixture</a>    
                        </li>

                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false" aria-controls="sidebarPagesAuth" class="side-nav-link">
                    <i class="ri-group-2-line"></i>
                    <span> Authentication </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesAuth">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="auth-login.html">Login</a>
                        </li>
                        <li>
                            <a href="auth-register.html">Register</a>
                        </li>
                        <li>
                            <a href="auth-logout.html">Logout</a>
                        </li>
                        <li>
                            <a href="auth-forgotpw.html">Forgot Password</a>
                        </li>
                        <li>
                            <a href="auth-lock-screen.html">Lock Screen</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>