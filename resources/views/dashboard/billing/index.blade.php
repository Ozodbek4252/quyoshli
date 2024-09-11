@extends('dashboard.layouts.app')
@section('title', trans('admin.billing.title').' - ')
@section('links')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">
                        @lang('admin.billing.title')
                    </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    @lang('admin.home')
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.billing.title')
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
        <div class="col-12">
            <div class="col-md-4 float-right mb-2">
                <div class="row">
                    <form action="{{ route('billing.search') }}" method="get" class="w-100">
                        <div class="input-group justify-content-end">
                            <div class="input-group-append" id="button-addon2">
                                <input type="text" class="form-control" name="query" placeholder="ID или Transaction" @if(!empty(request()->get('query'))) value="{{ request()->get('query') }}" @endif aria-describedby="button-addon2">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">


            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">@lang('admin.billing.order_id')</th>
                                <th scope="col">@lang('admin.billing.amount')</th>
                                <th scope="col">@lang('admin.users.phone')</th>
                                <th scope="col">Трансакция</th>
                                <th scope="col" class="text-right">@lang('admin.billing.status')</th>
                                <th scope="col" class="text-right">@lang('admin.billing.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billings as $billing)
                                <tr>
                                    <th scope="row">
                                        {{ $billing->id }}
                                    </th>
                                    <td>
                                        # {{ $billing->order->id }}
                                    </td>
                                    <td>
                                        {{ $billing->amount }}
                                    </td>

                                    <td>
                                        +{{ $billing->order->user->phone }}
                                    </td>

                                    <td>
                                        {{ $billing->transaction_id }}
                                    </td>

                                    <td class="text-right">
                                        @switch($billing->status)
                                            @case('payed')
                                            <span class="text-success">
                                                    <i class="feather icon-check-circle"></i> @lang('admin.billing.payed')
                                                </span>
                                            @break
                                            @case('refused')
                                            <span class="text-danger">
                                                    <i class="feather icon-minus-circle"></i> @lang('admin.billing.refused')
                                                </span>
                                            @break
                                            @case('waiting')
                                            <span class="text-danger">
                                                    <i class="feather icon-pause-circle"></i> @lang('admin.billing.waiting')
                                                </span>
                                            @break
                                        @endswitch
                                    </td>

                                    <td class="text-right">
                                        {{ date('d.m.Y - H:i', strtotime($billing->created_at)) }}
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            {{ $billings->appends(request()->input())->links() }}

        </div>
    </div>
@endsection
