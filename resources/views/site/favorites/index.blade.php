@extends('site.layouts.app')

@section('title', trans("app.favorites.title"))

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.favorites.title')</li>
        </ol>
    </div>
@endsection

@section('content')
    <favorite-block :products="{{ json_encode($favorites) }}" ></favorite-block>

    <div class="container mb-4">
        <div class="d-flex justify-content-center align-items-center flex-wrap mt-4">
            {{ $favorites->links() }}
        </div>
    </div>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush

