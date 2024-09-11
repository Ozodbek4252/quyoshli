<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProducts
 *
 * @property string|null $size
 * @property integer|null $count
 *
 * @property-read Order $order
 * @property-read Product $product
 * @property-read Color $color
 *
 * @mixin Model
 */
class OrderProducts extends Model
{

    public $timestamps = false;

    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'count' => 'integer',
        'size' => 'string',
        'color_id' => 'integer',
        'discount' => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class)->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Product::class, 'color_id', 'id')->withTrashed();
    }


    /**
     * @return int
     */
    public function getCount(): int
    {
        return (int) $this->count;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return (string) $this->size;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return (string) $this->color;
    }

    public static function getTotalPrice($id)
    {
        $products = self::where('order_id', $id)->get();

        $price = 0;
        foreach($products as $order) {
            if ($order->product->price_discount > 0) {
                $pricee = $order->product->getPriceDiscount();
            } else {
                $pricee = $order->product->getPrice();
            }
            $sum = $pricee * $order->count;
            $price += $sum;
        }

        return $price;
    }

}
