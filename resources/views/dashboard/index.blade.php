@extends('dashboard.layouts.app')
@section('title', trans('admin.home') . ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.home')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">
                        {{ $users }}
                    </h2>
                    <p class="mb-0">Пользователи</p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-credit-card text-success font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">
                        {{ $billing }}
                    </h2>
                    <p class="mb-0">Количество успешный транзакции</p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                        </div>
                    </div>
                    {{--                    <h2 class="text-bold-700 mt-1">{{ $orders }}</h2> --}}
                    {{--                    <p class="mt-1 mb-0">Заказы - <b>{{ $orders }}</b></p> --}}
                    {{--                    <p class="mb-0">Рассрочка - <b>{{ $credit }}</b></p> --}}
                    <div class="row" style="width: 100%">
                        <div class="col-6">
                            <h2 class="text-bold-700 mt-1">{{ $orders }}</h2>
                            <p class="mb-0">Заказы</p>
                        </div>
                        <div class="col-6">
                            <h2 class="text-bold-700 mt-1">{{ $credit }}</h2>
                            <p class="mb-0">Рассрочка</p>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ $products }}</h2>
                    <p class="mb-0">Продукты</p>
                </div>
                <br>
            </div>
        </div>

    </div>

    <div id="app">
        <dashboard-statics :statics="{{ json_encode($statics) }}"></dashboard-statics>
    </div>
@endsection
@vite('resources/js/app.js')
