@extends('site.layouts.app')

@section('title', trans("app.cart.title"))

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.cart.title')</li>
        </ol>
    </div>
@endsection

@section('content')
    <cart-view :cart-data="{{ $cart }}" :credit-info="{{ json_encode($on_credit) }}" :prices-data="{{ json_encode($prices) }}" :login-info="{{ json_encode(auth()->check()) }}"></cart-view>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
