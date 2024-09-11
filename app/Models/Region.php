<?php

namespace App\Models;

use App\Traits\LogOptionsTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Region extends Model
{
    use LogsActivity, LogOptionsTrait;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'cash' => 'boolean'
    ];

    protected static $logName = 'regions';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'cash'];
    protected static $submitEmptyLogs = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }

    public function getName(): string
    {
        return (string) $this->name[App::getLocale()] ?? null;
    }
}
