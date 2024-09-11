@extends('site.layouts.app')

@section('title', $brand->getName())

@section('breadcrumb')
    <div class="container mt-lg-4 mt-0">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a href="{{ route('site.main.page') }}" itemprop="item">
                    <span itemprop="name">@lang('app.main')</span>
                </a>
            </li>
            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{ $brand->getName() }}</span>
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <brand-view :products-data="{{ json_encode($products) }}" :login-info="{{ json_encode(auth()->check()) }}" :brand-data="{{ $brand }}"></brand-view>

    <div class="container mb-4">
        <div class="d-flex justify-content-center align-items-center flex-wrap mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('meta')
    <meta name="robots" content="all">
@endpush
