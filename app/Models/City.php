<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{

    use LogsActivity;

    protected $table = 'cities';

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'region_id' => 'integer'
    ];

    protected static $logName = 'cities';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'region_id'];
    protected static $submitEmptyLogs = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function getName(): string
    {
        return (string) $this->name['ru'] ?? null;
    }
}
