@extends('site.layouts.app')

@section('title', trans("app.auth.profile"))

@section('breadcrumb')
    <div class="container pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.auth.profile')</li>
        </ol>
    </div>
@endsection

@section('content')
    <section class="section-checkout">
        <div class="container">
            <h2 class="section-title">@lang('app.profile.title')</h2>

            <form action="{{ route('profile.update') }}" method="post" class="my-form my-form__checkout mb-4 mt-4">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h3 class="mb-3">@lang('app.profile.personal_data')</h3>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 my-form__group">
                        <input type="text" placeholder="@lang('app.profile.first')"  name="first_name" value="{{ auth()->user()->first_name }}" id="your_name" required>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 my-form__group">
                        <input type="text" placeholder="@lang('app.profile.last')" name="last_name" value="{{ auth()->user()->last_name }}" id="your_last_name">
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 my-form__group">
                        <input type="text" placeholder="@lang('app.profile.index')" value="{{ auth()->user()->postal_address }}"  name="postal_address" id="your_email">
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 my-form__group">
                        <input type="tel" value="+{{ auth()->user()->phone }}" placeholder="@lang('app.profile.phone')" disabled id="your_phone" required>
                    </div>
                </div>

                <button type="button" class="btn btn-primary mr-2" data-target="#password-edit" data-toggle="modal">
                    <i class="fa fa-key"></i>
                    @lang('app.profile.change')
                </button>

                <button type="submit" class="btn btn-success float-right">
                    <i class="fa fa-save"></i> @lang('app.profile.save')
                </button>

            </form>
        </div>
    </section>

    <!-- Избранные товары -->

    <favorite-block :products="{{ json_encode($favorites) }}"></favorite-block>

    <section class="section-order-history">
        <div class="container">

            <h3 class="mb-3 section-title-small">@lang('app.profile.history')</h3>
            @if (count($orders) > 0)
                <div class="accordion" id="accordionExample">
                    @foreach($orders as $order)
                        <div class="card order-history">
                            <div class="card-head" id="headingOne{{$order->id}}">
                                <h2 class="mb-0" data-toggle="collapse" data-target="#collapseOne{{$order->id}}" aria-expanded="false"
                                    aria-controls="collapseOne{{$order->id}}">
                                    <div class="order-history__number">@lang('app.profile.number') {{$order->id}}</div>
                                </h2>
                            </div>
                            <div id="collapseOne{{$order->id}}" class="collapse" aria-labelledby="headingOne{{$order->id}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="order-history__list">
                                        <ul>
                                            <li>@lang('app.profile.status'):
                                                @switch($order->status)
                                                    @case('processing')
                                                        <b>@lang('app.profile.processing')</b>
                                                        @break
                                                    @case('collected')
                                                        <b>@lang('app.profile.collected')</b>
                                                        @break
                                                    @case('waiting_buyer')
                                                        <b>@lang('app.profile.waiting_buyer')</b>
                                                        @break
                                                    @case('in_way')
                                                        <b>@lang('app.profile.in_way')</b>
                                                        @break
                                                    @case('closed')
                                                        <b>@lang('app.profile.closed')</b>
                                                        @break
                                                    @case('cancelled')
                                                        <b>@lang('app.profile.cancelled')</b>
                                                        @break
                                                    @case('replacement')
                                                        <b>@lang('app.profile.replacement')</b>
                                                        @break
                                                    @default
                                                        <b>{{ $order->payment_type }}</b>
                                                        @break
                                                @endswitch

                                            </li>


                                            <li>@lang('app.profile.date'): <b>{{ date('d.m.Y - H:i', strtotime($order->created_at)) }}</b></li>
                                            @if($order->type_delivery == 'delivery')
                                                @if(!empty($order->address))
                                                    <li>@lang('app.profile.address'): <b>{{ $order->address->city->region->getName() }}, {{ $order->address->city->getName() }}, {{ $order->address->street }}</b></li>
                                                @endif

                                                <li>@lang('app.profile.price_delivery'): <b>{{ $order->price_delivery }} uzs</b></li>
                                            @endif
                                            <li>
                                                @lang('app.profile.payment_system'):
                                                @switch($order->payment_type)
                                                    @case('cash')
                                                        <b>@lang('app.profile.cash')</b>
                                                        @break
                                                    @default
                                                        <b>{{ $order->payment_type }}</b>
                                                        @break
                                                @endswitch
                                            </li>

                                            @if($order->payment_status != 'cash')
                                                <li>@lang('app.profile.status_payed'):
                                                    @switch($order->payment_status)
                                                        @case('waiting')
                                                            <b>@lang('app.profile.waiting')</b>
                                                            @break

                                                        @case('cancelled')
                                                            <b>@lang('app.profile.cancelled')</b>
                                                            @break

                                                        @case('payed')
                                                            <b>@lang('app.profile.payed')</b>
                                                            @break
                                                    @endswitch

                                                </li>
                                            @endif

                                            @if(!empty($order->comment))
                                                <li>
                                                    @lang('app.profile.comment'): <b>{{ $order->comment }}</b>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>@lang('app.profile.product_name')</th>
                                                <th>@lang('app.profile.count')</th>
                                                <th>@lang('app.profile.price')</th>
                                                <th>@lang('app.profile.total')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->products as $product)
                                                    <tr>
                                                        <td>
                                                            {{ $product->product->getName() }}
                                                        </td>
                                                        <td>
                                                            {{ $product->count }}
                                                        </td>
                                                        <td>{{ number_format($product->price, 0, '', ' ') }} @lang('app.sum') </td>
                                                        <td>{{ number_format($product->price * $product->count , 0, '', ' ') }} @lang('app.sum') </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="sum-of-products">
                                        <h3>@lang('app.profile.delivery'): {{ number_format($order->price_delivery, 0, '', ' ') }} @lang('app.sum')</h3>
                                        <h3>@lang('app.profile.totall'): <span>{{ number_format($order->price_product + $order->price_delivery, 0, '', ' ') }} @lang('app.sum')</span></h3>
                                    </div>
                                    @if($order->payment_status == 'waiting')
                                        <hr>
                                        <form action="{{ route('pay_check', $order->id) }}" method="post" class="my-form my-form__checkout d-flex justify-content-end">
                                            @csrf
                                            <div class="">
                                                <h3 class="mt-4 mb-3">@lang('app.profile.pay_help'):</h3>
                                                <div class="form-payment d-flex justify-content-md-end justify-content-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" checked id="payment-3" value="payme" name="payment_type">
                                                        <label class="custom-control-label" for="payment-3">Payme</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="payment-4" value="click" name="payment_type">
                                                        <label class="custom-control-label" for="payment-4">Click</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-md-end justify-content-center mt-3">
                                                    <button type="sumbit" class="my-btn my-btn__orange">@lang('app.profile.pay')</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mb-3">@lang('app.profile.not_history')</p>
            @endif
        </div>
    </section>

    <change-password></change-password>
@endsection

@push('meta')
    <meta name="robots" content="noindex">
@endpush
