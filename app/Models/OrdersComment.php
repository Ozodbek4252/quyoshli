<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersComment extends Model
{
    protected $guarded = ['id'];

    protected $table = 'orders_comments';

    public function user()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'id');
    }
}
