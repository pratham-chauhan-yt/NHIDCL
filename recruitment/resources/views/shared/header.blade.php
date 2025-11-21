<header>
    <div class="header_parent_cust">
        <div class="container-fluid main_header">
            <div class="logo_cust logo_cust">
                @if(auth()->user() && auth()->user()->hasRole('Recruitment User'))
                <a href="{{ route('recruitment-portal.recruitment.dashboard') }}"> <img class="" src="{{ asset('public/images/logo.png') }}" alt="logo"></a>
                @else
                <a href="{{url('/')}}"> <img class="" src="{{ asset('public/images/logo.png') }}" alt="logo"></a>
                @endif
                <div class="logo_content ">
                    <h4 class="">Recruitment Portal</h4>
                    {{-- <p class="">National Highways & Infrastructure Development Corporation Ltd.</p> --}}
                </div>
                <div class="logo-details">
                    <i class='fa fa-bars' id="btn"></i>
                </div>
            </div>
            @if(auth()->user() && auth()->user()->hasRole('Recruitment User'))
            <div class="flex flex-col justify-between">
                <div class="pb-3 mt-2">
                    <ul class="header_li">
                        <li><a target="_blank" href="https://www.nhidcl.com/sites/default/files/Circular/nhidcl_rectt._seniority_and_promotion_rules-2025_1.pdf">NHIDCL Cadre Rules 2025</a></li>
                        <li><a target="_blank" href="{{ asset('public/pdf/RP_USER_MANUAL.pdf') }}">User Manual</a></li>
                        <li><a target="_blank" href="{{ route(name: 'recruitment.help.desk') }}">Help Desk</a></li>
                        <li><a target="_blank" href="{{ route('recruitment.faqs') }}">FAQ</a></li>
                        <li><a target="_blank" href="{{ asset('public/video/rp-video.mp4') }}">Explainer Video</a></li>
                    </ul>
                </div>
            </div>
            @endif
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
                            @if(auth()->user() && auth()->user()->hasRole('Recruitment User'))
                            <li><a href="{{ route('recruitment-portal.recruitment.profile') }}">View Profile</a></li>
                            <li><a href="{{ route('recruitment-portal.recruitment.change.password') }}">Change Password</a></li>
                            <li><a href="{{ route('recruitment-portal.recruitment.login.history') }}">Login History</a></li>
                            <li>
                                <form action="{{ route('recruitment-portal.recruitment.logout') }}" method="POST" class="d-inline">
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
                                    <li><a href="{{ route('user.login.history') }}" class="">Login History</a></li>
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
