@extends('dashboard.layouts.app')
@section('title', trans('admin.currency.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.currency.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.currency.title')
                            </li>
                            {{--                            <li class="breadcrumb-item active">Fixed Layout--}}
                            {{--                            </li>--}}
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
            @can('create', 'currencies')
                <a href="{{ route('dashboard.currency.store') }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.edit')
                </a>
            @endcan
        </div>

        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('admin.currency.dollar')</th>
                                <th scope="col">@lang('admin.currency.euro')</th>
                                <th scope="col" class="text-right">@lang('admin.currency.created_at')</th>
{{--                                <th scope="col" class="text-right">@lang('admin.actions')</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($currencies as $currency)
                                    <tr>
                                        <td>
                                            {{ $currency->dollar }}$
                                        </td>
                                        <td>
                                            {{ $currency->euro }}€
                                        </td>
                                        <td class="text-right">
                                            {{ $currency->created_at->format('j M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
