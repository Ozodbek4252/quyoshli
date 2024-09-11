Loading...
<form method="GET" action="https://oplata.kapitalbank.uz" id="myForm">
    <input type="hidden" name="cash" value="b7e1c1a65ee94e5e960f6cac0fb133c3"/>
    <input type="hidden" name="redirectUrl" value="{{ route('pay_check', $billing->order->id) }}"/>
    <input type="hidden" name="description" value="Оплата за заказ №{{ $billing->order->id }}"/>

    <input type="hidden" name="amount" value="{{ $billing->amount * 100 }}"/>
    <input type="hidden" name="orderId" value="{{ $billing->id }}"/>

    <input type="submit" id="submitBtn" hidden value="click">
</form>

<script src="{{ asset('vendor/site/libs/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#myForm").submit();
    });
</script>
