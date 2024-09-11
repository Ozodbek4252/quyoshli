@extends('site.layouts.app', ['seo_title' => $page_name])

@section('breadcrumb')
    <div class="container pt-md-3 pt-4 mt-5 mt-md-0">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('site.main.page') }}" itemprop="item">
                    <span itemprop="name">@lang('app.main')</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('categories') }}" itemprop="item">
                    <span itemprop="name">@lang('app.categories.title')</span>
                </a>
                <meta itemprop="position" content="2" />
            </li>

            @if($page == 'main')
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <span itemprop="name">@lang('app.all') {{ $category->getName() }}</span>
                    <meta itemprop="position" content="3" />
                </li>
                @php($page_name = $category->getTitleSeo())
            @elseif($page == 'show')
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a href="{{ route('category.view', [$category->slug]) }}" itemprop="item">
                        <span itemprop="name">{{ $category->getName() }}</span>
                    </a>
                    <meta itemprop="position" content="3" />
                </li>

                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <span itemprop="name"> @lang('app.all') {{ $Category->getName() }}</span>
                    <meta itemprop="position" content="4" />
                </li>
                @php($page_name = $Category->getTitleSeo())
            @elseif($page == 'showCatalog')
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a href="{{ route('category.view', [$category->slug]) }}" itemprop="item">
                        <span itemprop="name">{{ $category->getName() }}</span>
                    </a>
                    <meta itemprop="position" content="3" />
                </li>

                <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a href="{{ route('category.show', [$category->slug, $catalog->slug]) }}" itemprop="item">
                        <span itemprop="name">{{ $catalog->getName() }}</span>
                    </a>
                    <meta itemprop="position" content="4" />
                </li>
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <span itemprop="name">@lang('app.all') {{ $Category->getName() }}</span>
                    <meta itemprop="position" content="5" />
                </li>
                @php($page_name = $Category->getTitleSeo())
            @endif
        </ol>
    </div>
@endsection

@section('title', $page_name)

@section('content')
    <catalog-show :products-data="{{ json_encode($products) }}" :categories-data="{{ $categories }}" :login-info="{{ json_encode(auth()->check()) }}" :characteristics-data="{{ $characteristics }}" :category-data="{{ $page == 'main' ? $category : $Category }}" :page="{{ json_encode($page) }}"></catalog-show>
@endsection

@push('js')
    <script>
        $('document').ready(function () {
            $('.outer-ul>li.catalog').on('click', function () {
                $(".outer-ul>li.catalog").toggleClass('active')
                $('.outer-ul .filtr').removeClass('active')
            });

            $(".outer-ul>li.catalog").clickOutside(
                function () {
                    $(".outer-ul>li.catalog").removeClass("active");
                }
            );

            $('.outer-ul>li.view').on('click', function () {
                $(".outer-ul>li.view").toggleClass('active')
                $('.outer-ul .filtr').removeClass('active')
            });

            $(".outer-ul>li.view").clickOutside(
                function () {
                    $(".outer-ul>li.view").removeClass("active");
                }
            );

            $('.outer-ul .filtr').on('click', function () {
                $('.outer-ul .filtr').toggleClass('active')
            });

            $('.apply_mobile').on('click', function () {
                $('.outer-ul .filtr').removeClass('active')
            });

            $('.topbar, .row-outer, .footer, .modal').on('click', function () {
                $('.outer-ul .filtr').removeClass('active')
            })

        })
    </script>
@endpush

@push('meta')
    <meta name="description" content="{{ $descriptions }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta property="og:title" content="{{ $page_name }}">
    <meta property="og:description" content="{{ $descriptions }}">
    <meta property="og:type" content="category">
    <meta property="og:url" content="{{ env('APP_URL').$_SERVER['REQUEST_URI'] }}">
    <meta property="og:site_name" content="AliStore.uz">
    <meta name="robots" content="all">
@endpush
