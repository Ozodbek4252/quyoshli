@extends('site.layouts.app')

@section('title', trans("app.search.title"))

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.search.title')</li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="section-search">
        <div class="container">
            <form action="{{ route('search') }}" method="get">
                <div class="searching my-4">
                    <input type="text" name="name" value="{{ request()->get('name') }}" placeholder="@lang('app.search.search_by')">
                    <button type="submit"><i class="fal fa-search"></i> <span>@lang('app.search.title')</span></button>
                </div>
            </form>

            <search-block :search-data="{{ json_encode($products) }}" :login-info="{{ json_encode(auth()->check()) }}" :search-text="{{ json_encode(request()->get('name')) }}"></search-block>

        </div>
    </section>
    <div class="container">
        {{ $products->appends(request()->query())->links() }}
    </div>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
