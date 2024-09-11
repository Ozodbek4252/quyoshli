<!DOCTYPE html>
<html class="loading" lang="ru" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuesax admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuesax admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')Alistore</title>
    <link rel="apple-touch-icon" href="/vendor/dashboard/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/vendor/dashboard/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/vendors/css/ui/prism.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/vendor/dashboard/assets/css/style.css">
    <!-- END: Custom CSS-->

    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky fixed-footer  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Alistore</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ active('dashboard') }}"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="">
                        @lang('admin.home')
                    </span>
                </a>
            </li>
{{--            <li class=" nav-item"><a href="#"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="">Starter kit</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li><a href="sk-layout-1-column.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.1_column">1 column</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="sk-layout-2-columns.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.2_columns">2 columns</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="sk-layout-fixed-navbar.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.fixed_navbar">Fixed navbar</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="sk-layout-floating-navbar.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.fixed_navigation">Floating navbar</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="active"><a href="sk-layout-fixed.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.fixed_layout">Fixed layout</span></a>--}}
{{--                    </li>--}}
{{--                    <li><a href="sk-layout-static.html"><i></i><span class="menu-item" data-i18n="nav.sk_starter_kit.static_layout">Static layout</span></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            @can('view', 'users')
                <li class="nav-item {{ active([route('dashboard.users'), route('dashboard.users').'/*']) }}"><a href="{{ route('dashboard.users') }}">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.users.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can('view', 'staffs')
                <li class="nav-item {{ active([route('dashboard.staffs'), route('dashboard.staffs').'/*']) }}"><a href="{{ route('dashboard.staffs') }}">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.staffs.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can('view', 'roles')
                <li class="nav-item {{ active([route('dashboard.roles'), route('dashboard.roles').'/*']) }}"><a href="{{ route('dashboard.roles') }}">
                        <i class="feather icon-check-circle"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.roles.title')
                        </span>
                    </a>
                </li>
            @endif

            @can('view', 'products')
                <li class="nav-item {{ active([route('dashboard.products'), route('dashboard.products'). '/*']) }}">
                    <a href="{{ route('dashboard.products') }}">
                        <i class="feather icon-box"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.products.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can('view', 'compilations')
                {{--            @if(auth()->user()->isContentManager() || auth()->user()->isAdmin())--}}
                <li class="nav-item {{ active([route('dashboard.compilations'), route('dashboard.compilations'). '/*']) }}">
                    <a href="{{ route('dashboard.compilations') }}">
                        <i class="feather icon-command"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.compilations.title')
                        </span>
                    </a>
                </li>
                {{--            @endif--}}
            @endcan

            @can('view', 'orders')
                {{--            @if(auth()->user()->isModerator() || auth()->user()->isAdmin())--}}
                <li class="nav-item {{ active([route('dashboard.orders'), route('dashboard.orders'). '/*']) }}">
                    <a href="{{ route('dashboard.orders') }}">
                        <i class="feather icon-shopping-cart"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.orders.title')
                        </span>
                    </a>
                </li>
                {{--            @endif--}}
            @endcan

            @can('view', 'brands')
                {{--            @if(auth()->user()->isContentManager() || auth()->user()->isAdmin())--}}
                <li class="nav-item {{ active([route('dashboard.brands'), route('dashboard.brands'). '/*']) }}">
                    <a href="{{ route('dashboard.brands') }}">
                        <i class="feather icon-cast"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.brands.title')
                        </span>
                    </a>
                </li>
            @endcan

{{--            @can('view', 'partners')--}}
{{--                <li class="nav-item {{ active([route('dashboard.partners'), route('dashboard.partners'). '/*']) }}">--}}
{{--                    <a href="{{ route('dashboard.partners') }}">--}}
{{--                        <i class="feather icon-briefcase"></i>--}}
{{--                        <span class="menu-title" data-i18n="">--}}
{{--                            @lang('admin.partners.title')--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

            @can('view', 'posts')
                <li class="nav-item has-sub">
                    <a href="#">
                        <i class="feather icon-align-center"></i>
                        <span class="menu-title" data-i18n="Content">@lang('admin.posts.title')</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ (request()->is("ru/dashboard/posts/ru*")) ? 'active' : '' }}">
                            <a href="{{ route('dashboard.posts', 'ru') }}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Grid">Ru</span>
                            </a>
                        </li>
                        <li class="{{ (request()->is("ru/dashboard/posts/uz*")) ? 'active' : '' }}">
                            <a href="{{ route('dashboard.posts', 'uz') }}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Grid">UZ</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('view', 'sliders')
                <li class="nav-item {{ active([route('dashboard.sliders'), route('dashboard.sliders'). '/*']) }}">
                    <a href="{{ route('dashboard.sliders') }}">
                        <i class="feather icon-align-center"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.slider.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can('view', 'categories')
                <li class="nav-item {{ active([route('dashboard.categories'), route('dashboard.categories'). '/*']) }}">
                    <a href="{{ route('dashboard.categories') }}">
                        <i class="feather icon-tag"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.categories.title')
                        </span>
                    </a>
                </li>
            @endif

            @can('view', 'special-offers')
                <li class="nav-item {{ active([route('dashboard.specialOffers'), route('dashboard.specialOffers'). '/*']) }}">
                    <a href="{{ route('dashboard.specialOffers') }}">
                        <i class="feather icon-command"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.specialOffers.title')
                        </span>
                    </a>
                </li>
            @endif

            @can('create', 'pages')
                <li class="nav-item has-sub">
                    <a href="#">
                        <i class="feather icon-align-center"></i>
                        <span class="menu-title" data-i18n="Content">@lang('admin.pages.title')</span>
                    </a>
                    <ul class="menu-content">
                        @foreach($pages = Page::all() as $page)
                            <li class="{{ (request()->is("dashboard/pages/update/$page->id*")) ? 'active' : '' }}">
                                <a href="{{ route('dashboard.pages.update', $page->id) }}">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="Grid">{{ $page->name['ru'] }}</span>
                                </a>
                            </li>
                        @endforeach
                        <li class="{{ request()->is("dashboard/pages/store*") ? 'active' : '' }}">
                            <a href="{{ route('dashboard.pages.store') }}">
                                <i class="feather icon-plus-circle"></i>
                                <span class="menu-item" data-i18n="Grid">@lang('admin.add')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--            @endif--}}
            @endcan

            @can('view', 'feedback')
                {{--            @if(auth()->user()->isModerator() || auth()->user()->isAdmin())--}}
                <li class=" nav-item {{ request()->is('dashboard/feedback*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.feedback.index') }}">
                        <i class="feather icon-message-circle"></i><span class="menu-title" >@lang('admin.feedback.title')
                            <span class="badge badge-pill badge-primary">{{ Feedback::where('viewed', false)->count() }}</span></span>
                    </a>
                </li>
            @endcan

            @can('view', 'comments')
                <li class=" nav-item {{ request()->is('dashboard/comments*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.comments') }}">
                        <i class="feather icon-message-square"></i><span class="menu-title" >@lang('admin.comments.title')
                            <span class="badge badge-pill badge-primary">{{ Comment::where('publish', false)->count() }}</span></span>
                    </a>
                </li>
            @endcan

            @can('view', 'billings')
                {{--            @if(auth()->user()->isAdmin())--}}
                <li class=" nav-item {{ active([route('billing'), route('billing').'/*' ]) }} ">
                    <a href="{{ route('billing') }}">
                        <i class="feather icon-credit-card"></i>
                        <span class="menu-title" >
                            @lang('admin.billing.title')
                        </span>
                    </a>
                </li>
            @endcan

{{--            @can('view', 'colors')--}}
{{--                --}}{{--            @if(auth()->user()->isContentManager() || auth()->user()->isAdmin())--}}
{{--                <li class="nav-item {{ active([route('dashboard.colors'), route('dashboard.colors'). '/*']) }}">--}}
{{--                    <a href="{{ route('dashboard.colors') }}">--}}
{{--                        <i class="feather icon-edit-2"></i>--}}
{{--                        <span class="menu-title" data-i18n="">--}}
{{--                            @lang('admin.colors.title')--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

            @can('view', 'regions')
                <li class="nav-item {{ active([route('dashboard.regions'), route('dashboard.regions'). '/*']) }}">
                    <a href="{{ route('dashboard.regions') }}">
                        <i class="feather icon-database"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.regions.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can('view', 'cities')
                <li class="nav-item {{ active([route('dashboard.cities'), route('dashboard.cities'). '/*']) }}">
                    <a href="{{ route('dashboard.cities') }}">
                        <i class="feather icon-layers"></i>
                        <span class="menu-title" data-i18n="">
                            @lang('admin.cities.title')
                        </span>
                    </a>
                </li>
            @endcan

{{--            @can('view', 'files')--}}
{{--                <li class="nav-item {{ active([route('dashboard.files'), route('dashboard.files'). '/*']) }}">--}}
{{--                    <a href="{{ route('dashboard.files') }}">--}}
{{--                        <i class="feather icon-file"></i>--}}
{{--                        <span class="menu-title" data-i18n="">--}}
{{--                            @lang('admin.files.title')--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

            {{--                <li class="nav-item {{ active([route('dashboard.branches'), route('dashboard.branches'). '/*']) }}">--}}
            {{--                    <a href="{{ route('dashboard.branches') }}">--}}
            {{--                        <i class="feather icon-compass"></i>--}}
            {{--                        <span class="menu-title" data-i18n="">--}}
            {{--                            @lang('admin.branches.title')--}}
            {{--                        </span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}




            <li class="nav-item {{ active([route('dashboard.notification_available'), route('dashboard.notification_available'). '/*']) }}">
                <a href="{{ route('dashboard.notification_available') }}">
                    <i class="fa fa-bell"></i>
                    <span class="menu-title" data-i18n="">
                            @lang('admin.notification_available.title')
                        </span>
                </a>
            </li>

            @can('view', 'logs')
                <li class="nav-item {{ active([route('dashboard.logs'), route('dashboard.logs'). '/*']) }}">
                    <a href="{{ route('dashboard.logs') }}">
                        <i class="feather icon-activity"></i>
                        <span class="menu-title" data-i18n="">
                               Журнал действий
                        </span>
                    </a>
                </li>
            @endcan


            @if(Gate::check('update', 'settings') || Gate::check('delivery', 'settings') || Gate::check('view', 'currencies'))
                <li class="nav-item has-sub">
                    <a href="#">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title" data-i18n="Content">@lang('admin.settings.title')</span>
                    </a>
                    <ul class="menu-content">
                        @can('update', 'settings')
                            <li class="{{ (request()->is("dashboard/settings")) ? 'active' : '' }}">
                                <a href="{{ route('dashboard.settings') }}">
                                    <i class="feather icon-settings"></i>
                                    <span class="menu-item" data-i18n="Grid">
                                        @lang('admin.settings.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @if(Gate::check('update', 'settings'))
                            <li class="{{ active([route('dashboard.settings.delivery'), route('dashboard.settings.delivery'). '/*']) }}">
                                <a href="{{ route('dashboard.settings.delivery') }}">
                                    <i class="feather icon-truck"></i>
                                    <span class="menu-item" data-i18n="Grid">
                                        @lang('admin.delivery.title')
                                    </span>
                                </a>
                            </li>
                        @endif

                        @can('view', 'currencies')
                            <li class="{{ active([route('dashboard.currency'), route('dashboard.currency'). '/*']) }}">
                                <a href="{{ route('dashboard.currency') }}">
                                    <i class="feather icon-dollar-sign"></i>
                                    <span class="menu-item" data-i18n="Grid">
                                        @lang('admin.currency.title')
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content">

    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                            <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                            <!--     i.ficon.feather.icon-menu-->
                            {{--                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="sk-layout-1-column.html" data-toggle="tooltip" data-placement="top" title="1-Column"><i class="ficon feather icon-file-text"></i></a></li>--}}
                            {{--                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="sk-layout-2-columns.html" data-toggle="tooltip" data-placement="top" title="2-Columns"><i class="ficon feather icon-sidebar"></i></a></li>--}}
                            {{--                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="sk-layout-static.html" data-toggle="tooltip" data-placement="top" title="Static Layout"><i class="ficon feather icon-sliders"></i></a></li>--}}
                        </ul>

                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a href="/" target="_blank" class="nav-link "><i class="ficon feather icon-globe"></i></a></li>

                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ auth()->user()->first_name }}</span><span class="user-status">Available</span></div><span><img class="round" src="/vendor/dashboard/app-assets/images/portrait/small/avatar-s-11.png" alt="avatar" height="40" width="40" /></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"><i class="feather icon-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <div class="content-wrapper">
        @yield('speedbar')
        <div class="content-body">
            @include('dashboard.includes.alerts')
            @yield('content')
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer fixed-footer footer-light">
    <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Alistore &copy; {{ date('Y', time()) }}<a class="text-bold-800 grey darken-2" href="https://usoft.uz" target="_blank">Usoft,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
    </p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/vendor/dashboard/app-assets/vendors/js/vendors.min.js"></script>
<script src="/vendor/dashboard/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/vendor/dashboard/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Page Vendor JS-->
<script src="/vendor/dashboard/app-assets/vendors/js/ui/prism.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/vendor/dashboard/app-assets/js/core/app-menu.js"></script>
<script src="/vendor/dashboard/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<script src="/vendor/dashboard/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>

@stack('js')

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
