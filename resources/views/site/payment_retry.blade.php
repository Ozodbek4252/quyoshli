@extends('site.layouts.app')

@section('title', trans('app.profile.number') . ' ' . $order->id)

@section('breadcrumb')
    <div class="container mt-lg-4 mt-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('site.main.page') }}">@lang('app.main')</a></li>
            <li class="breadcrumb-item active">@lang('app.profile.number') {{ $order->id }}</li>
        </ol>
    </div>
@endsection


@section('content')
    <section class="section-order-history">
        <div class="container">
            <div class="card order-history border-0 m-0 p-0">
                <div class="card-head" id="headingOne">
                    <h2 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        <div class="order-history__number">@lang('app.profile.number') {{$order->id}}</div>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body p-0">
                        <div class="order-history__list">
                            <ul>



                                <li>@lang('app.profile.date'): <b>{{ date('d.m.Y - H:i', strtotime($order->created_at)) }}</b></li>

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
                    </div>
                </div>
            </div>
            @if($order->payment_status == 'waiting')
                <hr>
                <form action="{{ route('pay_check', $order->id) }}" method="post" class="my-form my-form__checkout d-flex justify-content-end">
                    @csrf
                    <div class="">
                        <h3 class="mt-4 mb-3">@lang('app.profile.pay_help'):</h3>
                        <div class="form-payment d-flex justify-content-md-end justify-content-center">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" checked id="payment-2" value="apelsin" name="payment_type">
                                <label class="custom-control-label" for="payment-2">Apelsin</label>
                            </div>

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

    </section>
@endsection
