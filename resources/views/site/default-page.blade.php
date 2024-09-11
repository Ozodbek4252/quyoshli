@extends('site.layouts.app')

@section('title', $page->getName())

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">{{ $page->getName() }}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="section-news-item">
        <div class="container">
            <h2 class="section-title">{{ $page->getName() }}</h2>
            <div class="news-item my-3">
                <div class="news-item-content">
                    {!! $page->getBody() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="description" content="{{ $page->getDescriptions() }}">
    <meta name="keywords" content="{{ $page->getKeywords() }}">
    <meta property="og:title" content="{{ $page->getName() }}">
    <meta property="og:description" content="{{ $page->getDescriptions() }}">
    <meta property="og:type" content="site">
    <meta property="og:url" content="{{ env('APP_URL').$_SERVER['REQUEST_URI'] }}">
    <meta property="og:site_name" content="AliStore.uz">

    <meta name="robots" content="noindex">
@endpush
