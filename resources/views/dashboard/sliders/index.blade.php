@extends('dashboard.layouts.app')
@section('title', trans('admin.slider.title') . ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.slider.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.slider.title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="table-head">
        <div class="col-md-12 mb-1">
            @can('create', 'sliders')
                <a href="{{ route('dashboard.slider.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-content">
                    <div id="app">
                        <slider-view :sliders-data="{{ $sliders }}" :role="{{ auth()->user()->role }}"></slider-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @vite('resources/js/app.js')</script>
@endpush
