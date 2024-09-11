<?php

namespace App\Models;

use App\User;
use App\Models\Address;
use App\Models\OrderProducts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Order
 * @property string|null $comment
 * @property integer|null $amount
 *
 * @property-read User $user
 * @property-read Address $address
 * @property-read Collection|OrderProducts[] $products
 *
 * @mixin Model
 */
class Order extends Model
{

    use LogsActivity;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'address_id' => 'integer',
        'price_product' => 'integer',
        'price_delivery' => 'integer',
        'discount' => 'integer',
        'type_delivery' => 'string',
        'status' => 'string',
        'payment_type' => 'string',
        'comment' => 'string',
        'branch_id' => 'integer',
        'payment_status' => 'string',
        'currency' => 'array',
        'type' => 'string',
        'apelsin_data' => 'array',
    ];

    protected static $logName = 'orders';
    protected static $logOnlyDirty = true;

    protected static $logAttributes = [
        'price_product', 'price_delivery', 'discount', 'type_delivery',
        'status', 'payment_type', 'payment_status', 'comment'
    ];
    protected static $submitEmptyLogs = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(OrdersComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments_bank()
    {
        return $this->hasMany(CommentBank::class);
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return (int) $this->price_product;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return (string) $this->comment;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billing()
    {
        return $this->belongsTo(Billing::class, 'id', 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyw
     */
    public function products()
    {
        return $this->hasMany(OrderProducts::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }


    /**
     * @param $query
     * @param $token
     * @return mixed
     */
    public function scopeFindByToken($query, $token)
    {
        return $query->where('token', $token);
    }

    public static function status($status)
    {
        switch ($status)
        {
            case 1;
                return 'Оформлено';
                break;
            case 2;
                return 'Доставляется';
                break;
            case 3;
                return 'Доставлено';
                break;
            case 4;
                return 'Отменено';
                break;
            default:
                return 'Обработка';

        }
    }

    public function scopeArchived($query, $bool)
    {
        return $query->where('archived', $bool);
    }

    public static function color($color)
    {
        switch ($color)
        {
            case 1;
                return '#FF9F43';
                break;
            case 2;
                return '#7367F0';
                break;
            case 3;
                return '#28C76F';
                break;
            case 4;
                return '#EA5455';
                break;
            default:
                return '#1E1E1E';

        }
    }

}
