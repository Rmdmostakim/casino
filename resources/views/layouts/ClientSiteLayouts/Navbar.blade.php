<div class="header">
    <div class="container">
        <div class="header-bottom">
            <div class="header-bottom-area align-items-center">
                <div class="logo"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a></div>
                <ul class="menu">
                    <li>
                        <a href="{{url('/')}}">{{ __('lang.Home') }}</a>
                    </li>
                    <li>
                        <a href="{{url('/about')}}">{{ __('lang.About') }}</a>
                    </li>
                    <li>
                        <a href="{{url('/games')}}">{{ __('lang.Games') }} <span class="badge badge--sm badge--base text-dark">{{ __('lang.New') }}</span></a>
                    </li>
                    <li>
                        @if( \UserAuth::userInfo() )
                            <a>{{ \UserAuth::userInfo()->username }}</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}">Logout</a>
                                </li>
                            </ul>
                        @else
                            <a>Login</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{url('/login')}}">Sign In</a>
                                </li>
                                <li>
                                    <a href="{{url('/registration')}}">Sign Up</a>
                                </li>
                            </ul>
                        @endif
                    </li>
                    <li>
                        <a>Language</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('lang', 'en') }}">English</a>
                                </li>
                                <li>
                                    <a href="{{ route('lang', 'bn') }}">বাংলা</a>
                                </li>
                                <li>
                                    <a href="{{ route('lang', 'hn') }}">हिन्दी</a>
                                </li>
                            </ul>
                    </li>
                    <button class="btn-close btn-close-white d-lg-none"></button>
                </ul>
                <div class="header-trigger-wrapper d-flex d-lg-none align-items-center">
                    <div class="header-trigger me-4">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
