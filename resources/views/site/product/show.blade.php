@extends('site.layouts.app', ['seo_title' => $product->getTitleSeo()])

@section('title', trans('app.buy').$product->getName())

@section('breadcrumb')
    <div class="container pt-lg-3">

        <ol class="breadcrumb d-none d-lg-flex" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" >
                <a itemprop="item" href="{{ route('site.main.page') }}">
                    <span itemprop="name"> @lang('app.main') </span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            @if($category)
                @if($category->parent)
                    @if($category->parent->parent)
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="{{ route('category.view', [$category->parent->parent->slug]) }}" itemprop="item" >
                                <span itemprop="name">
                                    {{ $category->parent->parent->getName() }}
                                </span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>

                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="{{ route('category.show', [$category->parent->parent->slug, $category->parent->slug]) }}" itemprop="item">
                                <span itemprop="name">{{ $category->parent->getName() }}</span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>

                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="{{ route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]) }}" itemprop="item">
                                <span itemprop="name">{{ $category->getName() }}</span>
                            </a>
                            <meta itemprop="position" content="4" />
                        </li>

                        <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <span itemprop="name">{{ $product->getName() }}</span>
                            <meta itemprop="position" content="5" />
                        </li>
                    @else
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="{{ route('category.view', [$category->parent->slug]) }}" itemprop="item">
                                <span itemprop="name">{{ $category->parent->getName() }}</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>

                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="{{ route('category.show', [$category->parent->slug, $category->slug]) }}" itemprop="item">
                                <span itemprop="name">{{ $category->getName() }}</span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>

                        <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <span itemprop="name">{{ $product->getName() }}</span>
                            <meta itemprop="position" content="4" />
                        </li>
                    @endif
                @else
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a href="{{ route('category.show', [$category->slug]) }}" itemprop="item">
                            <span itemprop="name">{{ $category->getName() }}</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>

                    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <span itemprop="name">{{ $product->getName() }}</span>
                        <meta itemprop="position" content="3" />
                    </li>
                @endif
            @endif

        </ol>

        <div class="back-to py-2 d-flex d-lg-none">
            <a href="javascript:history.back()"><i class="far fa-arrow-left"></i> @lang('app.back')</a>
        </div>

    </div>
@endsection

@section('content')
    @auth
        <product-show :product-data="{{ json_encode($product) }}" :setting-data="{{ $setting }}" :login-info="true"
                      :first-name="{{ json_encode(auth()->user()->first_name) }}"
                      :phone-profile="{{ auth()->user()->phone }}"></product-show>
    @else
        <product-show :product-data="{{ json_encode($product) }}" :setting-data="{{ $setting }}" :login-info="false"
                      :first-name="null" :phone-profile="998"></product-show>
    @endauth

    <!-- Популярные товары -->
    <section class="section-products">
        <div class="container">
            <h2 class="section-title">@lang('app.index.popular_prods')</h2>
            <products-slider :products-data="{{ json_encode($popularProducts) }}"
                             :login-info="{{ json_encode(auth()->check()) }}"></products-slider>
        </div>
    </section>

    @auth
        <credit-modal :product-data="{{ json_encode($product) }}"></credit-modal>
    @endauth
    <!-- Ваш заказ успешно зарегистрирован -->
    <div class="modal fade success" id="success">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="/vendor/site/img/tick.png" alt="Tick icon" />
                    <div class="my-3">
                        <h5 class="text-center px-lg-5">
                            @lang('app.credit.success')
                        </h5>
                    </div>
                    <div class="mt-4">
                        <button type="button" data-dismiss="modal" class="my-btn my-btn__orange">
                            ОК
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="/vendor/site/libs/slick/slick.min.js"></script>
    <script src="/vendor/site/libs/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/jquery.mousewheel.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lightgallery.min.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-fullscreen.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-video.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-autoplay.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-zoom.js"></script>
    <script src="/vendor/site/libs/lightgallery/js/lg-thumbnail.js"></script>

    <script>
        $(".slider-big").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            fade: true,
            asNavFor: ".slider-small",
            infinite: false,
            draggable: false,
            responsive: [
                {
                    breakpoint: 576,
                    settings: {
                        fade: false,
                        arrows: true,
                        autoplaySpeed: 5000,
                        speed: 750,
                        arrows: true,
                    },
                },
            ],
        });

        $(".slider-small").slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: ".slider-big",
            dots: false,
            focusOnSelect: true,
            arrows: true,
            infinite: false,
            centerPadding: "10px",
            swipe: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 5,
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 6,
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 6,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });

        $(document).ready(() => {
            $('#aniimated-thumbnials').lightGallery({
                thumbnail: true,
                selector: '.item1',
                download: false

            });
            $('#aniimated-thumbnial').lightGallery({
                thumbnail: true,
                selector: '.item',
                download: false
            });
        });

        // tabbed content
        $(".tab_content").hide();
        $(".tab_content:first").show();

        /* if in tab mode */
        $("ul.tabs li").click(function () {
            if (!$(this).hasClass("active")) {
                $(".tab_content").hide();
                var activeTab = $(this).attr("rel");
                $("#" + activeTab).fadeIn();

                $("ul.tabs li").removeClass("active");
                $(this).addClass("active");

                $(".tab_drawer_heading").removeClass("d_active");
                $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
            }
        });

        /* if in drawer mode */
        $(".tab_drawer_heading").click(function () {
            if (!$(this).hasClass("d_active")) {
                $(".tab_content").hide();
                var d_activeTab = $(this).attr("rel");
                $("#" + d_activeTab).fadeIn();

                $(".tab_drawer_heading").removeClass("d_active");
                $(this).addClass("d_active");

                $("ul.tabs li").removeClass("active");
                $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
            }
        });
    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.months').click(function () {--}}
{{--                let month = $(this).val()--}}
{{--                let price = $('#all_price').val()--}}
{{--                let first_pay = $('#initial-payment').val()--}}
{{--                let res = Math.round((price - first_pay) / month)--}}
{{--                $('#for_month').val(res)--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endpush

@push('css')
    <link rel="stylesheet" href="/vendor/site/libs/slick/slick.css">
    <link rel="stylesheet" href="/vendor/site/libs/slick/slick-theme.css">
    <link rel="stylesheet" href="/vendor/site/libs/lightgallery/css/lightgallery.min.css">
@endpush

@push('meta')
    <meta name="description" content="{{ $product->getShortBody() }}">
    <meta name="keywords" content="{{ $product->getKeywords() }}">
    <meta type="image/jpeg" name="link" href="/{{ $product->getPoster() }}" rel="image_src">
    <meta property="og:title" content="{{ $product->getName() }}">
    <meta property="og:description" content="{{ strip_tags($product->getBody()) }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ route('product.show', [$product->id, $product->slug]) }}">
    <meta property="og:image" content={{ env('APP_URL') }}/{{ $product->getPoster() }}">
    <meta property="og:site_name" content="AliStore.uz">
    <meta name="robots" content="all">
@endpush
