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
    <checkout-view :delivery-price="{{ json_encode($delivery_price) }}" :regions-data="{{ $regions }}" :cart-data="{{ $cart }}" :prices-data="{{ json_encode($prices) }}" :login-info="{{ json_encode(auth()->check()) }}" :pickup-info="{{ json_encode($pickup) }}" :delivery-info="{{ json_encode($delivery) }}" :pickup-text="{{ json_encode($pickup_text) }}" :first-name="{{ auth()->check() ? json_encode(auth()->user()->first_name) : json_encode(null) }}" :address-data="{{ auth()->check() ? json_encode(auth()->user()->postal_address) : json_encode(null) }}"></checkout-view>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
