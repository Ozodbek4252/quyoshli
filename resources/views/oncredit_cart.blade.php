Loading...
<form action="https://alistore.apelsin.uz" method="POST" id="myForm">
    <input type="hidden" name="orderNumber" value="{{ $order->id }}">
    <input type="hidden" name="orderAmount" value="{{ $order->price_product * 100 }}">
    <input type="hidden" name="orderComment" value="Nomer order: {{ $order->id }}">
    <input type="submit" id="submitBtn" hidden value="click">
</form>
<script src="{{ asset('vendor/site/libs/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#myForm").submit();
    });
</script>
