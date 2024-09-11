@extends('site.layouts.app')

@if ($page === 'all')
    @section('title', trans('app.categories.title'))
@else
    @section('title', $category->getName())
@endif

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
            @if($page == 'parent')
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a href="{{ route('categories') }}" itemprop="item">
                        <span itemprop="name">@lang('app.categories.title')</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <span itemprop="name">
                        {{ $category->getName() }}
                    </span>
                    <meta itemprop="position" content="3" />
                </li>
            @elseif($page == 'all')
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <span itemprop="name">@lang('app.categories.title')</span>
                    <meta itemprop="position" content="2" />
                </li>
            @endif
        </ol>
    </div>
@endsection

@section('content')
    <section class="section-sections">
        <div class="container">
            @if ($page === 'all')
                <h2 class="section-title">@lang('app.categories.title')</h2>
            @else
                <h2 class="section-title">{{ $category->getName() }}</h2>
            @endif

            <div class="sections">
                @foreach($parents as $parent)
                    <a href="{{ $page == 'all' ? route('category.view', [$parent->slug]) : route('category.show', [$parent->parent->slug, $parent->slug]) }}" class="sections-item">
                        <div class="sections-item__img">
                            <img src="/{{ $parent->getImage() }}" alt="{{ $parent->getName() }}">
                        </div>
                        <h3 class="sections-item__title">
                            {{ $parent->getName() }}
                        </h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('meta')
    <meta name="robots" content="all">
@endpush
