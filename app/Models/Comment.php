<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'first_name',
        'body',
        'user_id',
        'product_id',
        'star',
        'publish'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'body' => 'string',
        'first_name' => 'string',
        'created_at' => 'datetime:H:i d.m.Y',
        'publish' => 'boolean',
        'star' => 'integer'
    ];

    protected $hidden = [
        'update_at', 'user_id', 'product_id'
    ];

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
    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
