<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Cart
 * @property integer|null $user_id
 * @property integer $product_id
 * @property integer $count
 * @property string|null $size
 * @property string|null $token
 * @mixin Model
 */
class Cart extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'token' => 'string',
        'product_id' => 'integer',
        'count' => 'integer',
        'size' => 'string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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

    /**
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeFindByUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
