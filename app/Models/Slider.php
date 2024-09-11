<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'image',
        'language',
        'link',
        'type',
        'placement',
        'published',
        'position'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];


    protected static $logName = 'sliders';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'name',
        'image',
        'language',
        'link',
        'type',
        'placement',
        'published',
        'position'
    ];

    public function getImage(): string
    {
        if (is_file($this->image)) {
            return $this->image;
        }

        return '/images/nophoto.jpg';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
