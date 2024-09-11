@extends('site.layouts.app')

@section('title', $post->name)

@section('meta')
    <meta property="og:title" content="{{ $post->name }} - Alistore.uz">
    <meta property="og:description" content="{{ $post->content }}">
    <meta property="og:url" content="ali.brig.uz{{ $_SERVER['REQUEST_URI'] }}">

    <meta property="og:site_name" content="Alistore" />

    <meta property="og:image" content="ali.brig.uz/{{ $post->image }}" />

    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="ali.brig.uz">
@endsection

@section('breadcrumb')
    <div class="container pt-lg-3">
        <ol class="breadcrumb d-none d-lg-flex itemscope itemtype="https://schema.org/BreadcrumbList"">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('site.main.page') }}" itemprop="item">
                    <span itemprop="name">@lang('app.main')</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('site.posts.index', $post->type) }}" itemprop="item">
                    <span itemprop="name">@lang("app.{$post->type}.title")</span>
                </a>
                <meta itemprop="position" content="2" />
            </li>
            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{ $post->name }}</span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>

        <div class="back-to py-2 d-block d-lg-none">
            <a href="{{ route('site.posts.index', $post->type) }}"><i class="far fa-arrow-left"></i> @lang('app.back')</a>
        </div>
    </div>
@endsection

@section('content')
    <section class="section-news-item">
        <div class="container">
            <h2 class="section-title">{{ $post->name }}</h2>

            <div class="news-item my-3">
                <div class="news-item-widget">
                    <div class="news-item-seen"><i class="fas fa-eye"></i> {{ $post->views }}</div>
                    <div class="news-item-date">{{ $post->getDatePublic() }}</div>
                </div>

                <div class="news-item-content">
                    @if($post->image)
                        <center>
                            <img src="/{{ $post->getImage() }}" style="max-width:100%" alt="{{ $post->name }}">
                        </center>
                    @endif

                    {!! $post->content !!}
                </div>

                <div class="share">
                    <p>@lang('app.share'):</p>
                    <div class="socials">
                        <a href="#https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://telegram.me/share/url?url={{ url()->current() }}" target="_blank"><i class="fab fa-telegram-plane"></i></a>
                        <a href="https://vk.com/share.php?url={{ url()->current() }}" target="_blank"><i class="fab fa-vk"></i></a>
                        <a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl={{ url()->current() }}" target="_blank"><i class="fab fa-odnoklassniki"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Популярные товары -->
    <section class="section-products">
        <div class="container">
            <h2 class="section-title">@lang('app.news.other_news')</h2>
            <news-slider :posts-data="{{ $otherPosts }}"></news-slider>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="all">

    <meta name="description" content="{{ $post->getDescription() }}">
    <meta name="keywords" content="{{ $post->getKeywords() }}">
    <meta type="image/jpeg" name="link" href="/{{ $post->getImage() }}" rel="image_src">
    <meta property="og:title" content="{{ $post->name }}">
    <meta property="og:description" content="{{ $post->getDescription() }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ route('site.posts.view', [$post->type, $post->id, $post->slug]) }}">
    <meta property="og:image" content={{ env('APP_URL') }}/{{ $post->getImage() }}">
    <meta property="og:site_name" content="AliStore.uz">

@endpush
