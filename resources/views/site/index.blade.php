@extends('site.layouts.app')

@section('title', trans('app.main'))

@section('content')
    <features-section :setting-data="{{ $setting }}"></features-section>

    @if ($setting->permissions['special_block'] == true)
        <!-- Спецпредложения -->
        <section class="section-special">
            <div class="container">
                <h2 class="section-title mb-3">@lang('app.index.special_offer')</h2>

                <special-block :offers-data="{{ $offers }}"></special-block>
            </div>
        </section>
    @endif

    @if ($setting->permissions['lider_products'] == true)
        <!-- Лидеры продаж -->
        <section class="section-products">
            <div class="container">
                <h2 class="section-title">@lang('app.index.leader_of_sales')</h2>
                <products-slider :products-data="{{ json_encode($liderProducts) }}"
                    :login-info="{{ json_encode(auth()->check()) }}"></products-slider>
            </div>
        </section>
    @endif

    @if ($setting->permissions['popular_products'] == true)
        <!-- Популярные товары -->
        <section class="section-products">
            <div class="container">
                <h2 class="section-title">@lang('app.index.popular_prods')</h2>
                <products-slider :products-data="{{ json_encode($popularProducts) }}"
                    :login-info="{{ json_encode(auth()->check()) }}"></products-slider>
            </div>
        </section>
    @endif

    @if ($setting->permissions['middle_banner'] == true)
        <!-- Bonus -->
        <bonus-section :banners-data="{{ $middleSliders }}"></bonus-section>
    @endif

    @if ($setting->permissions['popular_categories'] == true)
        <!-- Популярные категории -->
        <section class="section-popular_category">
            <div class="container">
                <h2 class="section-title">@lang('app.index.popular_categories')</h2>

                <div class="popular_category">
                    @foreach ($popularCategories as $popularCategory)
                        <a href="{{ $popularCategory->link }}" class="popular_category--item">
                            <div class="popular_category--item__img">
                                <img src="{{ asset("/$popularCategory->image") }}" alt="{{ $popularCategory->getName() }}">
                            </div>
                            <h5 class="popular_category--item__title">{{ $popularCategory->getName() }}</h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($setting->permissions['new_products'] == true)
        <!-- Новинки -->
        <section class="section-products">
            <div class="container">
                <h2 class="section-title">@lang('app.index.new_income')</h2>
                <products-slider :products-data="{{ json_encode($newProducts) }}"
                    :login-info="{{ json_encode(auth()->check()) }}"></products-slider>
            </div>
        </section>
    @endif

    @if ($setting->permissions['news'] == true)
        <!-- Новости -->
        <news-section :posts-data="{{ $posts }}" :top-post="{{ $toppedPost }}"></news-section>
    @endif

    @if ($setting->permissions['brands'] == true)
        <!-- Наши партнеры -->
        <section class="section-products">
            <div class="container">
                <h2 class="section-title">@lang('app.index.our_partners')</h2>
                <partners-slider :partners-data="{{ json_encode($brands) }}"></partners-slider>
            </div>
        </section>
    @endif

    @if (!empty(request()->get('order')) && request()->get('order') === 'success')
        <div class="modal fade success" id="success">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="/vendor/site/img/tick.png" alt="Tick icon">
                        <div class="my-3">
                            <h4 class="text-center">
                                @lang('app.order.success.title')
                            </h4>
                            <h6 class="text-center px-lg-5">
                                @lang('app.order.success.text')
                            </h6>
                        </div>
                        <div class="mt-4">
                            <button type="button" data-dismiss="modal" class="my-btn my-btn__orange">ОК</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script>
        $('#success').modal('show')
    </script>
@endpush

@push('meta')
    <meta name="robots" content="all">

    <meta name="description" content="{{ $setting->getDescription() }}">
    <meta name="keywords" content="{{ $setting->getKeywords() }}">
    <meta property="og:title" content="{{ $setting->getTitle() }}">
    <meta property="og:description" content="{{ $setting->getDescription() }}">
    <meta property="og:type" content="site">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:site_name" content="AliStore.uz">
@endpush
