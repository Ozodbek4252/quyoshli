<table>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col" width="18">@lang('admin.orders.user')</th>
        <th scope="col" width="30">@lang('admin.orders.delivery_type')</th>
        <th scope="col" width="16">@lang('admin.orders.payment_system')</th>
        <th scope="col" width="15">Статус оплаты</th>
        <th scope="col" width="15">@lang('admin.orders.status')</th>
        <th scope="col" width="20">
            Комментария
        </th>
        <th scope="col" width="30">
            Комментарии от Банка
        </th>
        <th scope="col" width="20">@lang('admin.orders.date')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>
                {{ $order->id }}
            </td>
            <td>
                +{{ sprintf("%s(%s)%s-%s-%s",
              substr($order->user->getPhone(), 0, 3),
              substr($order->user->getPhone(), 3, 2),
              substr($order->user->getPhone(), 5, 3),
              substr($order->user->getPhone(), 8, 2),
              substr($order->user->getPhone(), 10, 2)) }}
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
                @if($order->payment_type == 'cash')
                    Наличный расчет
                @elseif($order->payment_type == 'credit')
                    Кредит
                @else
                    {{ $order->payment_type }}
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
            </td>
            <td>
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
                @endswitch
            </td>

            <td>
                {{ $order->comment }}
            </td>

            <td>
                @if($order->payment_type == 'credit')
                    Клиент перешел на сайт банка,
                @endif

                @foreach($order->comments_bank as $comment)
                    {{ $comment->comment }},
                @endforeach
            </td>

            <td>
                {{ date('H:i - d.m.Y', strtotime($order->created_at)) }}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
