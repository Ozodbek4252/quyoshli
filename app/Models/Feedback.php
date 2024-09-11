<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'message',
        'viewed'
    ];

    protected $casts = [
        'viewed' => 'boolean'
    ];

    public function setPhoneAttribute($phone)
    {
        return $this->attributes['phone'] = str_replace(['+', '-', '(', ')', ' '], '', $phone);
    }
}
