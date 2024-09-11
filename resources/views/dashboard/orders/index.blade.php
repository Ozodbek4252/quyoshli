@extends('dashboard.layouts.app')
@section('title', trans('admin.orders.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.orders.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.orders.title')
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
            <a href="{{ route('dashboard.orders.archive') }}" class="btn btn-icon btn-secondary float-right mr-1">
                <i class="feather icon-box"></i> Архив заказов
            </a>

            <a href="{{ route('dashboard.orders.export') }}" class="btn btn-icon btn-success float-right mr-1">
                <i class="feather icon-box"></i> Export
            </a>

        </div>
    </div>
    <div class="row" id="table-head">

{{--        <div class="col-md-4 mb-1 ">--}}
{{--            <form action="{{ route('dashboard.orders.search') }}" method="get">--}}
{{--                <div class="input-group ">--}}
{{--                    <input type="text" class="form-control" name="id" placeholder="ID заказа" aria-describedby="button-addon2">--}}
{{--                    <div class="input-group-append" id="button-addon2">--}}
{{--                        <button class="btn btn-primary waves-effect waves-light" type="button">Искать</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}

        @if(!empty(auth()->user()->role->permissions['orders']['filter']))
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="collapse-margin">
                        <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <span class="lead collapse-title">
                                <i class="fa fa-filter"></i> Фильтр
                            </span>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <form method="get" action="{{ route('dashboard.orders.filter') }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="id">ID заказа</label>
                                                    <input type="number" id="id" class="form-control" value="{{ request()->get('id') }}" placeholder="ID заказа" name="id">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="user">Пользователь</label>
                                                    <input type="text" id="user" class="form-control" value="{{ request()->get('user') }}" placeholder="Пользователь" name="user">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="delivery_status">Статус заказа</label>
                                                    <select class="form-control" id="status" name="delivery_status">
                                                        <option selected disabled>Не выбрано</option>

                                                        <option value="processing" @if(request('delivery_status') == 'processing') selected @endif>В обработке</option>
                                                        <option value="collected" @if(request('delivery_status') == 'collected') selected @endif>Собран</option>
                                                        <option value="waiting_buyer" @if(request('delivery_status') == 'waiting_buyer') selected @endif>Ожидает покупателя</option>
                                                        <option value="in_way" @if(request('delivery_status') == 'in_way') selected @endif>В пути</option>
                                                        <option value="closed" @if(request('delivery_status') == 'closed') selected @endif>Закрыт</option>
                                                        <option value="cancelled" @if(request('delivery_status') == 'cancelled') selected @endif>Отменен</option>
                                                        <option value="replacement" @if(request('delivery_status') == 'replacement') selected @endif>Замена</option>
                                                        <option value="completed" @if(request('delivery_status') == 'completed') selected @endif>Завершен</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pay_status">Тип оплаты</label>
                                                    <select class="form-control" id="pay_status" name="pay_status">
                                                        <option selected disabled>Не выбрано</option>
                                                        <option value="cancelled" @if(request('pay_status') == 'cancelled') selected @endif>Отменено</option>
                                                        <option value="payed" @if(request('pay_status') == 'payed') selected @endif>Оплачено</option>
                                                        <option value="waiting" @if(request('pay_status') == 'waiting') selected @endif>Не оплачено</option>
                                                        <option value="cash" @if(request('pay_status') == 'cash') selected @endif>Наличный</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="delivery_type">Тип доставки</label>
                                                    <select class="form-control" id="delivery_type" name="delivery_type">
                                                        <option selected disabled>Не выбрано</option>
                                                        <option value="delivery" @if(request('delivery_type') == 'delivery') selected @endif>Стандартная доставка</option>
                                                        <option value="pickup" @if(request('delivery_type') == 'pickup') selected @endif>Самовывоз из пункта выдачи</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="delivery_type">Дата</label>
                                                    <input type="text" class="form-control" name="datefilter" value="{{ request('datefilter') }}" />
                                                    <input type="hidden" name="from" id="from" value="{{ request('from') }}">
                                                    <input type="hidden" name="to" id="to" value="{{ request('to') }}">

                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-filter"></i> Применить</button>
                                                <a href="{{ route('dashboard.orders') }}" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Сброс</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <form method="post" action="{{ route('dashboard.orders.mass_archived') }}">
                        @csrf
                        <div class="table">
                            <table class="table mb-0">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="50" class="text-right">
                                        <div class="form-group text-right">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" name="order_id[]" class="change-check"
                                                           id="select-all">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </th>

                                    <th scope="col" width="50">ID</th>
                                    <th scope="col">@lang('admin.orders.user')</th>
                                    <th scope="col">@lang('admin.orders.delivery_type')</th>
                                    <th scope="col">@lang('admin.orders.payment_system')</th>
                                    <th scope="col">@lang('admin.orders.status')</th>
                                    <th scope="col">@lang('admin.orders.date')</th>
                                    <th scope="col" class="text-right">@lang('admin.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) == 0)
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                @lang('admin.no_data')
                                            </td>
                                        </tr>
                                    @endif

                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-right">
                                                <div class="form-group">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" value="{{ $order->id }}" name="order_id[]" class="change-check"
                                                                   id="checkbox-{{ $loop->iteration }}">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </td>

                                            <td>
                                                {{ $order->id }}
                                            </td>
                                            <td>
                                                +{{ $order->user->getPhone() }}
                                            </td>

                                            <td>
                                                @if($order->type_delivery == 'delivery')
                                                    Стандартная доставка
                                                @else
                                                    Самовывоз из пункта выдачи
                                                @endif

                                                @if($order->type == 'one_click')
                                                        <br><span class="text-danger">(Купить в 1 клик)</span>
                                                @endif
                                            </td>

                                            <td>
                                                @switch($order->payment_status)
                                                    @case('cancelled')
                                                        Отменено
                                                        @break
                                                    @case('payed')
                                                        Оплачено
                                                        @break
                                                    @case('waiting')
                                                        Не оплачено
                                                        @break
                                                    @case('review')
                                                        На рассмотрение
                                                        @break;
                                                @endswitch

                                                (
                                                    @if($order->payment_type == 'cash')
                                                        Наличный расчет
                                                    @elseif($order->payment_type == 'credit')
                                                        Кредит
                                                    @else
                                                        {{ $order->payment_type }}
                                                    @endif
                                                )
                                            </td>

                                            <td>

                                                <div class="btn-group dropleft mr-1 mb-1">
                                                    <button type="button" class="btn @if($order->status == 'delivered') btn-success @elseif($order->status == 'cancelled') btn-danger @elseif($order->status == 'processing') btn-primary @elseif($order->status == 'waiting') btn-warning @endif  dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        @switch($order->status)
                                                            @case('processing')
                                                                В обработке
                                                                @break
                                                            @case('collected')
                                                                Собран
                                                                @break
                                                            @case('waiting_buyer')
                                                                Ожидает покупателя
                                                                @break
                                                            @case('in_way')
                                                                В пути
                                                                @break
                                                            @case('closed')
                                                                Закрыт
                                                                @break
                                                            @case('cancelled')
                                                                Отменен
                                                                @break
                                                            @case('replacement')
                                                                Замена
                                                                @break
                                                            @case('completed')
                                                                Завершен
                                                                @break
                                                        @endswitch
                                                    </button>
                                                    <div class="dropdown-menu" x-placement="left-start" style="position: absolute; transform: translate3d(-147px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['processing'])|| !empty(auth()->user()->role->permissions['order_status']['cancelled']))
                                                            <a class="dropdown-item @if($order->status == 'processing') disabled @endif" onclick="return confirm('Вы действительно хотите изменить статус')" href="{{ route('dashboard.orders.status', [$order->id, 'processing']) }}">
                                                                В обработке
                                                            </a>
                                                        @endif

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['processing']) || !empty(auth()->user()->role->permissions['order_status']['collected']))
                                                            <a class="dropdown-item @if($order->status == 'collected') disabled @endif" onclick="return confirm('Вы действительно хотите изменить статус')" href="{{ route('dashboard.orders.status', [$order->id, 'collected']) }}">
                                                                Собран
                                                            </a>
                                                        @endif

                                                        @if($order->type_delivery == 'pickup' && !empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || $order->type_delivery == 'pickup' && !empty(auth()->user()->role->permissions['order_status']['closed']) || $order->type_delivery == 'pickup' && !empty(auth()->user()->role->permissions['order_status']['collected']))
                                                            <a class="dropdown-item @if($order->status == 'waiting_buyer') disabled @endif" onclick="return confirm('Вы действительно хотите изменить статус')" href="{{ route('dashboard.orders.status', [$order->id, 'waiting_buyer']) }}">
                                                                Ожидает покупателя
                                                            </a>
                                                        @endif

                                                        @if($order->type_delivery == 'delivery' && !empty(auth()->user()->role->permissions['order_status']['in_way']) || $order->type_delivery == 'delivery' && !empty(auth()->user()->role->permissions['order_status']['closed']))
                                                            <a class="dropdown-item @if($order->status == 'in_way') disabled @endif" onclick="return confirm('Вы действительно хотите изменить статус')" href="{{ route('dashboard.orders.status', [$order->id, 'in_way']) }}">
                                                                В пути
                                                            </a>
                                                        @endif

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['closed']))
                                                            <a class="modal-comment dropdown-item @if($order->status == 'closed') disabled @endif" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $order->id }}" data-type="closed"> {{-- href="{{ route('dashboard.orders.status', [$order->id, 'cancelled']) }}"--}}
                                                                Закрыт
                                                            </a>
                                                        @endif

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['cancelled']))
                                                            <a class="modal-comment dropdown-item @if($order->status == 'cancelled') disabled @endif" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $order->id }}" data-type="cancelled"> {{-- href="{{ route('dashboard.orders.status', [$order->id, 'cancelled']) }}"--}}
                                                                Отменен
                                                            </a>
                                                        @endif

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['replacement']) || !empty(auth()->user()->role->permissions['order_status']['closed']))
                                                            <a class="modal-comment dropdown-item @if($order->status == 'replacement') disabled @endif" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $order->id }}" data-type="replacement"> {{--href="{{ route('dashboard.orders.status', [$order->id, 'replacement']) }}--}}
                                                                Замена
                                                            </a>
                                                        @endif

                                                        @if(!empty(auth()->user()->role->permissions['order_status']['completed']))
                                                            <a class="modal-comment dropdown-item @if($order->status == 'completed') disabled @endif" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $order->id }}" data-type="completed"> {{--href="{{ route('dashboard.orders.status', [$order->id, 'replacement']) }}--}}
                                                                Завершен
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>


                                            </td>

                                            <td>
                                                {{ date('H:i - d.m.Y', strtotime($order->created_at)) }}
                                            </td>

                                            <td class="text-right">
    {{--                                            @can('update', 'orders')--}}
    {{--                                                <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-info btn-icon btn-sm">--}}
    {{--                                                    <i class="fa fa-edit"></i>--}}
    {{--                                                </a>--}}
    {{--                                            @endcan--}}
                                                @if(!empty(auth()->user()->role->permissions['orders']['print']))
                                                    <a href="{{ route('dashboard.invoice_print', $order->id) }}" target="_blank" class="btn btn-success btn-icon btn-sm">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endif

                                                @can('view', 'orders')
                                                    <a href="{{ route('dashboard.orders.view', $order->id) }}" class="btn btn-primary btn-icon btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer" id="show-action">
                            <button type="submit" name="action" value="archived" class="btn btn-secondary">
                                <i class="feather icon-box"></i> Архивировать
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{ $orders->appends(request()->input())->links() }}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="/vendor/picker/daterangepicker.css" />

@endpush

@push('js')

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.orders.comments_status') }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Написать комментарий</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="order_id" value="" id="id_order">
                        <input type="hidden" name="type" value="" id="type_order">
                        <textarea cols="3" class="form-control" name="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-secondary">Изменить статус</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script type="text/javascript" src="/vendor/picker/moment.min.js"></script>
    <script type="text/javascript" src="/vendor/picker/daterangepicker.js"></script>

    <script type="text/javascript">
        $(function() {

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $('#from').val(picker.startDate.format('YYYY-MM-DD'));
                $('#to').val(picker.endDate.format('YYYY-MM-DD'));
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            $('.modal-comment').on('click', function (e) {
                var id = $(this).data('id');
                var type = $(this).data('type');

                $('#type_order').val(type);
                $('#id_order').val(id);
            })

        });


    </script>

    <script>
        // Listen for click on toggle checkbox
        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#show-action").hide();

            $(".change-check").change(function () {
                $("#show-action").show();
            });
        });
    </script>
@endpush
