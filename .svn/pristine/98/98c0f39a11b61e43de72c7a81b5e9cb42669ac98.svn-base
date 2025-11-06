<header>
    <div class="header_parent_cust">
        <div class="container-fluid main_header">
            <div class="logo_cust logo_cust">
                <a href="{{url('/')}}"> <img class="" src="{{ asset('public/images/logo.png') }}" alt="logo"></a>
                <div class="logo_content ">
                    <h4 class="">Resource Pool Portal</h4>
                    {{-- <p class="">National Highways & Infrastructure Development Corporation Ltd.</p> --}}
                </div>
                <div class="logo-details">
                    <i class='fa fa-bars' id="btn"></i>
                </div>
            </div>
            <div class="cust_notif_prf_">
                <div class="drop_profile_bg" id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName">
                    <button class="" type="button">
                        <img class="" src="{{ asset('public/images/user-sample.png') }}" alt="user photo">
                    </button>
                    <a class="drop_cont_cust">
                        {{ ucwords(@Auth::user()->name) }}
                        <span class="">Profile</span>
                    </a>
                    <div id="dropdownAvatarName" class="z-10 hidden divide-y divide-gray-100 shadow-xl w-44  ">
                        <ul class="after_dropdown">
                            @if (auth()->user() && auth()->user()->getRoleNames()->isEmpty())
                                <li><a href="{{ route('candidate.applicantProfile') }}">View Profile</a></li>
                                <li><a href="{{ route('candidate.change-password') }}">Change Password</a></li>
                                <li><a href="{{ route('candidate.login-history') }}">Login History</a></li>
                                <li>
                                    <form action="{{ route('candidate.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                @auth
                                    <li>
                                        <a href="{{ route('user-config.show', Crypt::encrypt(Auth::id())) }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('change-password', Crypt::encrypt(Auth::id())) }}"
                                            class="">Change Password</a>
                                    </li>
                                    <li><a href="{{ route('user.login.history') }}">Login History</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
