<table>
    <thead>
    <tr>
        <th scope="col" width="50">ID</th>
        <th scope="col">Артикул</th>
        <th scope="col">Название на русском</th>
        <th scope="col">Старая цена</th>
        <th scope="col">Старая цена со скидкой</th>
        <th scope="col">Старая цена для рассрочки</th>
        <th scope="col">Новая цена</th>
        <th scope="col">Новая цена со скидкой</th>
        <th scope="col">Новая цена для рассрочки</th>
        <th scope="col">Количество товара</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td width="6">
                    {{ $product->id }}
                </td>

                <td width="15">
                    {{ $product->article_number }}
                </td>

                <td width="30">
                    {{ $product->name['ru'] }}
                </td>

                <td width="20">
                    {{ $product->price }}
                </td>

                <td width="25">
                    {{ $product->price_discount }}
                </td>

                <td width="25">
                    {{ $product->price_credit }}
                </td>

                <td width="25">

                </td>

                <td width="25">

                </td>

                <td width="25">

                </td>

                <td width="20">
                    {{ $product->count }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
