<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if(!empty($seo_title) && $seo_title != 'null')
        <title>{{ $seo_title }}</title>
    @else
        <title>@yield('title') | {{ $setting->getTitle() }}</title>
    @endif

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#fff">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">

    <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
    <link rel="apple-touch-icon" sizes="180x180" href="/vendor/site/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/vendor/site/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/vendor/site/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/vendor/site/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/vendor/site/img/favicon/safari-pinned-tab.svg" color="#5bbad5">


    @stack('meta')

    <link rel="stylesheet" href="{{ asset('vendor/site/libs/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/site/libs/bootstrap/bootstrap.min.css') }}">
    <meta name="google-site-verification" content="WEA5xbVXzXWXn-hHYtz3xfgo0H1Y8OzDAuU9RHPXfv8">
    <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('vendor/site/css/main.min.css') }}">--}}

    @stack('css')

</head>

<body>
<div id="app">
    <!-- TopBar -->
    <div class="topbar">
        <div class="topbar-top">
            <div class="container">
                <div class="topbar-top__left">


{{--                    <a href="balance.html" class="balance d-block d-md-none">--}}
{{--                        <i class="fas fa-balance-scale"></i>--}}
{{--                        <!-- <span>Сравнение</span> -->--}}
{{--                        <div class="balance-count">--}}
{{--                            <input type="text" readonly value="0" />--}}
{{--                        </div>--}}
{{--                    </a>--}}


                    <div class="just-call d-flex d-md-none ml-auto mr-3" style="opacity: 0; visibility: hidden">
                        <a href="tel:{{ $setting->getPhone() }}"><i class="far fa-phone-alt"></i></a>
                        <a href="javascript:void(0)" class="d-flex d-lg-none" data-target="#feedback" data-toggle="modal">
                            <img width="20px" src="/vendor/site/img/feedback.svg" alt="Feedback icon">
                        </a>
                    </div>


                    <div class="lang d-block d-md-none">
                        <div class="lang-selected">{{ app()->getLocale() === 'ru' ? 'Ru' : 'Uz' }} <i class="fa fa-caret-down"></i></div>
                        <div class="lang-list">
                            <a class="{{ app()->getLocale() === 'ru' ? 'active disabled' : '' }}" href="{{ route('site.setLocale', 'ru') }}">Ru</a>
                            <a class="{{ app()->getLocale() === 'uz' ? 'active disabled' : '' }}" href="{{ route('site.setLocale', 'uz') }}">Uz</a>
                        </div>
                    </div>

                </div>
                <div class="topbar-top__right d-none d-md-flex">
                    <a href="{{ route('site.default-page', 'rassrocka') }}">@lang('app.credit.title')</a>
                    <a href="{{ route('site.default-page', 'dostavka') }}">@lang('app.delivery.title')</a>
                    <a href="{{ route('site.default-page', 'oplata') }}">@lang('app.payment.title')</a>

                    <a href="{{ route('site.default-page', 'about') }}">@lang('app.about.title')</a>
                    @guest
                        <a href="javascript:void(0)" data-target="#login" data-toggle="modal">@lang('app.layout.login')</a>
                    @else
                        <a href="{{ route('profile') }}">@lang('app.auth.profile')</a>
                        <a href="{{ route('logout') }}">@lang('app.auth.logout')</a>
                    @endguest

                    <div class="lang ml-3">
                        <div class="lang-selected">{{ app()->getLocale() === 'ru' ? 'Ru' : 'Uz' }} <i class="fa fa-caret-down"></i></div>
                        <div class="lang-list">
                            <a class="{{ app()->getLocale() === 'ru' ? 'active disabled' : '' }}" href="{{ route('site.setLocale', 'ru') }}">Ru</a>
                            <a class="{{ app()->getLocale() === 'uz' ? 'active disabled' : '' }}" href="{{ route('site.setLocale', 'uz') }}">Uz</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="topbar-bottom">
            <div class="container">
                <a class="logo" href="/">
                    <img src="{{ asset('vendor/site/img/logo.png') }}" alt="Logo">
                </a>
                <form action="{{ route('search') }}" method="get">
                    <div class="search">
                        <input type="text" name="name" value="{{ request()->get('name') }}" placeholder="@lang('app.search.search')">
                        <a href="javascript:void(0)" title="@lang('app.search.title')">
                            <button type="submit" class="bg-transparent p-0 m-0 border-0">
                                <i class="fal fa-search"></i>
                            </button>
                        </a>
                    </div>
                </form>

                <div class="topbar-top__right topbar-bottom--bottom d-flex d-md-none">
                    <a href="{{ route('site.default-page', 'rassrocka') }}">@lang('app.credit.title')</a>
                    <a href="{{ route('site.default-page', 'dostavka') }}">@lang('app.delivery.title')</a>
                    <a href="{{ route('site.default-page', 'oplata') }}">@lang('app.payment.title')</a>

                    <a href="{{ route('site.default-page', 'about') }}">@lang('app.about.title')</a>
{{--                    <a href="balance.html" class="balance">--}}
{{--                        <i class="fas fa-balance-scale"></i>--}}
{{--                        <span>@lang('app.layout.compare')</span>--}}
{{--                        <div class="balance-count">--}}
{{--                            <input type="text" readonly value="0">--}}
{{--                        </div>--}}
{{--                    </a>--}}
                </div>

                <div class="just-call">
                    <a href="tel:{{ $setting->getPhone() }}"><i class="fas fa-mobile-alt"></i> <span>{{ $setting->getPhone() }}</span></a>
                    <a href="javascript:" style="opacity: 0; visibility: hidden" data-target="#feedback" data-toggle="modal">@lang('app.callback.title')</a>
                </div>
                <div class="selected-products">
                    <a href="{{ route('favorites') }}" class="favorite">
                        <i class="fas fa-heart"></i>
                        <div class="favorite-count">
                            <input type="text" id="favorite-count" readonly value="{{ auth()->check() ? auth()->user()->products()->count() : 0 }}">
                        </div>
                    </a>

                    <cart-preview :login-info="{{ json_encode(auth()->check()) }}"></cart-preview>

{{--                    <a href="balance.html" class="balance d-none d-md-block">--}}
{{--                        <i class="fas fa-balance-scale"></i>--}}
{{--                        <!-- <span>Сравнение</span> -->--}}
{{--                        <div class="balance-count">--}}
{{--                            <input type="text" readonly value="0" />--}}
{{--                        </div>--}}
{{--                    </a>--}}

                </div>



                @guest
                    <a href="javascript:void(0)" class="d-flex d-md-none sign-in" data-target="#login" data-toggle="modal">
                        <img src="/vendor/site/img/sign-in.png" width="25px" alt="">
                    </a>
                @else
                    <a href="{{ route('profile') }}" class="d-flex d-md-none sign-in">
                        <i class="text-secondary fas fa-user-alt" style="font-size: 20px"></i>
                    </a>
                @endguest

                <button class="navbar-toggler">
                    <div class="hamburger hamburger--elastic">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div class="my-navbar">
        <x-categories-header/>
    </div>

    @yield('breadcrumb')

    <!-- Header -->
    <header>
        @if(request()->is('/'))
            @include('site.includes.main-header')
        @else

        @endif
    </header>

    <!-- Main -->
    <main id="app">
        @yield('content')
    </main>

    <!-- Footer -->

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <a class="logo mb-3" href="{{ route('site.main.page') }}">
                            <img src="{{ asset('vendor/site/img/logo3.png') }}" alt="Logo">
                        </a>
                        <div class="copyright">{{ now()->format('Y') }} © <a href="/">Alistore.uz</a> | @lang('app.layout.rights') </div>
                        <div class="software-company">@lang('app.layout.developed') <a href="https://usoft.uz" target="_blank">Usoft</a></div>
                    </div>
                    <div class="сol-md-8 col-xl-5 col-lg-4 mb-md-0 mb-3">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="{{ route('site.default-page', 'polzovatelskoe-soglasenie') }}"
                                           class="nav-link">@lang('app.layout.terms_of_use')</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{ route('site.default-page', 'pravila-dostavki') }}"--}}
{{--                                           class="nav-link">@lang('app.layout.rules_of_delivery')</a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                            <div class="col-md-3 col-6">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="{{ route('site.posts.index', 'news') }}" class="nav-link">@lang('app.news.title')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/stocks" class="nav-link">@lang('app.sales.title')</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-3 col-lg-6 col-xl-3">
                                <div class="payments d-flex justify-content-md-end justify-content-center align-items-center flex-wrap my-0">
                                    <p>@lang('app.pay_in')</p>
                                    <div class="d-flex align-items-baseline align-items-center justify-content-center flex-wrap">
                                        <div class="payments-item ml-md-4 m-3 mr-md-0 ml-md-0 my-md-0">
                                            <img class="img-fluid" src="/vendor/site/img/apelsin.png" alt="Uzcard" />
                                        </div>

                                        <div class="payments-item ml-md-4 m-3 mr-md-0 ml-md-0 my-md-0">
                                            <img class="img-fluid" src="/vendor/site/img/uzcard.png" alt="Uzcard" />
                                        </div>
                                        <div class="payments-item ml-md-4 m-3 mr-md-0 ml-md-0 my-md-0">
                                            <img class="img-fluid" src="/vendor/site/img/Humo.png" alt="Humo" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3 col-lg-4">
                        <div class="phone mb-3">
                            <a href="tel:{{ $setting->getPhone() }}"><i class="fas fa-mobile-alt"></i> <span>{{ $setting->getPhone() }} </span></a>
                        </div>
                        <div class="phone mb-3">
                            <a href="tel:{{ $setting->getPhoneOther() }}"><i class="fas fa-mobile-alt"></i> <span>{{ $setting->getPhoneOther() }} </span></a>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-1 d-lg-flex justify-content-lg-end align-items-lg-start mb-md-0 mb-3">
                        <div class="socials">
                            <a href="{{ $setting->getTelegram() }}"><i class="fab fa-telegram-plane"></i></a>
                            <a href="{{ $setting->getFacebook() }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $setting->getInstagram() }}"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $setting->getYoutube() }}"><i class="fab fa-youtube"></i></a>
                            <a href="{{ $setting->getOkru() }}"><i class="fab fa-odnoklassniki"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <div class="modal fade feedback" id="feedback">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close" data-dismiss="modal">
                        <i class="fal fa-times"></i>
                    </button>

                    <h4>@lang('app.feedback.title')</h4>

                    <form action="{{ route('leave.feedback') }}" method="post" class="my-form my-form__auth">
                        @csrf
                        <div class="mt-4 my-form__group">
                            <input type="text" name="name" placeholder="@lang('app.auth.enter_name')" id="your_name" required>
                            <label for="your_name">@lang('app.auth.name')</label>
                        </div>

{{--                        @guest--}}
{{--                            <div class="mt-4 my-form__group">--}}
{{--                                <input type="tel" name="phone" placeholder="@lang('app.auth.phone')" id="feedback_phone" required>--}}
{{--                                <label for="feedback_phone">@lang('app.auth.phone')</label>--}}
{{--                            </div>--}}
{{--                        @else--}}

                            <div class="mt-4 my-form__group">
                                <input type="tel" name="phone" placeholder="@lang('app.auth.phone')"  value="{{ auth()->user()->phone ?? '+998' }}" id="login_phone" required>
                                <label for="feedback_phone">@lang('app.auth.phone')</label>
                            </div>

{{--                        @endguest--}}

                        <div class="mt-4 my-form__group">
                            <textarea name="message" id="your_message" placeholder="@lang('app.feedback.message')" cols="30" rows="5"></textarea>
                            <label for="your_message"></label>
                        </div>

                        <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                            <button type="submit" class="my-btn my-btn__orange">@lang('app.feedback.send')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @guest
        <login></login>
    @endguest

<!-- Return to Top -->
    <a href="javascript:" id="return-to-top">
        <i class="fal fa-chevron-up"></i>
    </a>

</div>
<script src="{{ asset('vendor/site/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/site/libs/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>

<script src="{{ asset('vendor/site/libs/popper/popper.min.js') }}"></script>
<script src="{{ asset('vendor/site/libs/bootstrap/bootstrap.min.js') }}"></script>

<script src="{{ mix('js/vendor.js') }}"></script>

<script src="{{ asset('vendor/site/js/main.js') }}"></script>

@stack('js')

<script src="https://code.jivosite.com/widget/qyFN6W25Al" async></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-178431991-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-178431991-1');
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(67473268, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayerEcomm"
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/67473268" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>

</html>
