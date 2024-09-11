<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Cart as CartModel;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductsOrderStoreJob
{
    protected $request;
    protected $order;

    /**
     * ProductsOrderStoreJob constructor.
     * @param $request
     * @param $order
     */
    public function __construct($request, $order)
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
        foreach ($this->request->products as $product) {
            $cart = CartModel::where('id', $product)->first();
            if (!empty($cart)) {
                $discount = $cart->product->product->price_discount ? 100 - $cart->product->product->price_discount * 100 / $cart->product->product->price : null;

//                if ($this->request->payment_type == 'cash') {
                    $product = Product::find($cart->product->product->id);
                    $product->count = $product->count - (int) $cart->count;
                    $product->save();
//                }

                OrderProducts::create([
                    'order_id' => $this->order->id,
                    'product_id' => $cart->product->product->id,
                    'discount' => round($discount),
                    'count' => $cart->count,
                    'size' => $cart->size,
                    'color_id' => $cart->product_id,
                    'price' => $cart->product->product->price_discount ? round($cart->product->product->price_discount, 0) : round($cart->product->product->price, 0)
                ]);
            }
        }
    }
}
