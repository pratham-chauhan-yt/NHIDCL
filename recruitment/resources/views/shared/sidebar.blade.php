<div class="sidebar">
    <ul class="nav-list ">
        <li
            class="menu-item {{ request()->is('dashboard') || request()->is('resource-pool-portal/hr/dashboard') || request()->is('recruitment-portal/dashboard') ? 'active' : '' }}">
            @if (auth()->user() && auth()->user()->getRoleNames()->isEmpty())
                <a href="{{ route('candidate.dashboard') }}">
            @elseif(auth()->user() && auth()->user()->hasRole('HR Resource Pool'))
                <a href="{{ route('hr.dashboard') }}">
            @elseif(auth()->user() && auth()->user()->hasRole('Recruitment User'))
                <a href="{{ route('recruitment-portal.recruitment.dashboard') }}">
            @else
                <a href="{{ route('admin.dashboard') }}">
            @endif
            <img src="{{ asset('public/images/dashboard.svg') }}" alt="Dashboard">
            <span class="links_name">Dashboard</span>
            </a>
        </li>

        @hasrole('Super Admin')
        @canModule('User Management')
        <li class="menu-item dropdown {{ request()->is(['user-config*', 'roles*', 'permissions*']) ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link">
                <img src="{{ asset('public/images/MDI-information-outline.svg') }}" alt="User Management">
                <span class="links_name">User Management</span>
            </a>
            <ul class="dropdown-menu cust_drop">
                @canany(['user config - view user', 'user config - view role'])
                    <li><a class="dropdown-item" href="{{ route('user-config.index') }}">Dashboard</a></li>
                @endcanany
                @can('user config - create user')
                    <li><a class="dropdown-item" href="{{ route('user-config.create') }}">Create User</a></li>
                @endcan
                @canany(['user config - view user', 'user config - edit user'])
                    <li><a class="dropdown-item" href="{{ route('user-config.view') }}">View Users</a></li>
                @endcanany
            </ul>
        </li>
        @endcanModule
        @endhasrole
        
        @canModule('Recruitment Management')
        @hasrole('Recruitment User')
            @can('recruitment-management-advertisement')
            <li class="menu-item {{ request()->is('recruitment-portal/candidate/advertisement*') ? 'active' : '' }}">
                <a href="{{ route('recruitment-portal.candidate.advertisement') }}">
                    <img src="{{ asset('public/images/MDI-information-outline.svg') }}" alt="Vacancies">
                    <span class="links_name">Vacancies</span>
                </a>
            </li>
            <li class="menu-item {{ request()->is('recruitment-portal/recruitment/current/vacancies') ? 'active' : '' }}">
                <a href="{{ route('recruitment-portal.candidate.current.vacancies') }}">
                    <img src="{{ asset('public/images/MDI-information-outline2.svg') }}" alt="Current Vacancies">
                    <span class="links_name">Current Vacancies</span>
                </a>
            </li>
            <li class="menu-item {{ request()->is('recruitment-portal/candidate/archieve/advertisement') ? 'active' : '' }}">
                <a href="{{ route('recruitment-portal.candidate.archieve.advertisement') }}">
                    <img src="{{ asset('public/images/MDI-information-outline3.svg') }}" alt="Archive Vacancies">
                    <span class="links_name">Archive Vacancies</span>
                </a>
            </li>
            <li class="menu-item {{ request()->is('recruitment-portal/candidate/application*') ? 'active' : '' }}">
                <a href="{{ route('recruitment-portal.recruitment.candidate.application') }}">
                    <img src="{{ asset('public/images/MDI-information-outline4.svg') }}" alt="My Application">
                    <span class="links_name">My Application</span>
                </a>
            </li>
            @can('recruitment-management-profile')
            <!-- <li class="menu-item {{ request()->is('recruitment-portal/candidate/profile') ? 'active' : '' }}">
                    <a href="{{ route('recruitment-portal.candidate.profile') }}">
                        <img src="{{ asset('public/images/MDI-information-outline.svg') }}" alt="Applicant Profile">
                        <span class="links_name">Applicant Profile</span>
                    </a>
                </li> -->
            @endcan
            @endcan
        @endhasrole
        @unlessrole(['Recruitment User', 'Super Admin'])
        <li class="menu-item dropdown {{ request()->is('recruitment-portal*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link">
                <img src="{{ asset('public/images/MDI-information-outline.svg') }}" alt="Employee Management">
                <span class="links_name">Recruitment Portal</span>
            </a>
            <ul class="dropdown-menu cust_drop">
                @can('recruitment-management-advertisement')
                    <li><a class="dropdown-item" href="{{ route('recruitment-portal.advertisement.index') }}">Advertisement</a></li>
                @endcan
                @can('recruitment-management-post')
                    <li><a class="dropdown-item" href="{{ route('recruitment-portal.post.index') }}">Recruitment Post</a></li>
                @endcan
                @can('recruitment-management-selection-process')
                    <li><a class="dropdown-item" href="{{ route('recruitment-portal.selection.process') }}">Selection Process</a></li>
                @endcan
            </ul>
        </li>
        @endunlessrole
        @endcanModule
    </ul>
</div>
