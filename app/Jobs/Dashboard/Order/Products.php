<?php

namespace App\Jobs\Dashboard\Order;

use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;
use App\Models\Order;
use App\Models\OrderProducts;


class Products
{
    protected $order;
    protected $request;

    public function __construct(Order $order, UpdateRequest $request)
    {
        $this->order = $order;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        OrderProducts::where('order_id', $this->order->id)->delete();

        foreach ($this->request->getProducts() as $product) {
            OrderProducts::create([
                'color_id' => $product['color_id'],
                'order_id' => $this->order->id,
                'size' => $product['size'],
                'product_id' => $product['product_id'],
                'count' => $product['count'],
                'price' => $product['product']['price_discount'] ? $product['product']['price_discount'] : $product['product']['price'],
                'discount' => $product['discount']
            ]);
        }
    }
}
