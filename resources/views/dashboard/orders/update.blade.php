@extends('dashboard.layouts.app')
@section('title', trans('admin.edit') . ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.edit')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.products') }}">@lang('admin.products.title')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.edit')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div id="app">
        <order-edit :order="{{ json_encode($order) }}" :branches="{{ json_encode($branches) }}"></order-edit>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    @vite('resources/js/app.js')</script>
@endpush
