<?php

namespace App\Models;

use App\Traits\LogOptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity, LogOptionsTrait;

    protected $fillable = [
        'name',
        'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    protected static $logName = 'roles';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'permissions'];
    protected static $submitEmptyLogs = false;

    public function staff()
    {
        return $this->hasOne(Staff::class, 'role_id', 'id');
    }

    public function hasPermission($type, $permissions): bool
    {
        return $this->permissions[$type][$permissions] ?? false;
    }
}
