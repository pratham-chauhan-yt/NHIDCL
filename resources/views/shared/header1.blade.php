<header>
    <div class="header_parent_cust">
        <div class="container main_header">
            <div class="logo_cust">
                <a href="{{ route('auth.login') }}"> <img src="{{ asset('public/images/logo.png') }}"
                        alt="NHIDCL Logo"></a>
                <div class="logo_content ">
                    <h4 class="">Resource Pool Portal</h4>
                    <p class="">National Highways & Infrastructure Development Corporation Ltd.</p>
                </div>
            </div>
            <div class="flex flex-col justify-between">
                <div class="pb-3 mt-2">
                    <ul class="header_li">
                        <li><a target="_blank" href="{{ asset('public/pdf/Scheme.pdf') }}">Scheme</a></li>
                        <li><a target="_blank" href="{{ asset('public/pdf/RPP_User_Manual.pdf') }}">User Manual</a></li>
                        <li><a target="_blank" href="{{ route(name: 'help.desk') }}">Help Desk</a></li>
                        <li><a target="_blank" href="{{ route('faqs') }}">FAQ</a></li>
                        <li><a target="_blank" href="{{ asset('public/video/sample.mp4') }}">Explainer Video</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>