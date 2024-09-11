@extends('site.layouts.app')

@section('title', trans("app.$type.title"))

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('site.main.page') }}" itemprop="item">
                    <span itemprop="name">@lang('app.main')</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">@lang("app.{$type}.title")</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="section-news-all">
        <div class="container">
            <h2 class="section-title">@lang("app.{$type}.title")</h2>

            @foreach($posts as $post)
                <div class="news my-3">
                    <div class="row">
                        <div class="col-md-5 col-lg-4">
                            <a href="{{ route('site.posts.view', [ $post->type, $post->id, $post->slug ]) }}" class="news-img">
                                <img src="/{{ $post->image }}" alt="{{ $post->name }}">
                            </a>
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <div class="news-content">
                                <h3 class="news-title"><a href="{{ route('site.posts.view', [ $post->type, $post->id, $post->slug ]) }}">{{ $post->name }}</a>
                                </h3>
                                <div class="news-widget">
                                    <div class="news-seen"><i class="fas fa-eye"></i> {{ $post->views }}</div>
                                    <div class="news-date">{{ $post->getDatePublic() }}</div>
                                </div>

                                <p class="news-subtitle">{!! str_limit(strip_tags($post->content), 500, '...') !!}</p>
                                <a href="{{ route('site.posts.view', [ $post->type, $post->id, $post->slug ]) }}" class="news-link">@lang('app.more') <i class="fal fa-chevron-right ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="all">
@endpush
