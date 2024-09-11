<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title', 'body', 'language'
    ];

    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'language' => 'string',
    ];
}
