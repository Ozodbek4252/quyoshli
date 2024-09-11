<?php

namespace App\Models;

use App\Traits\LogOptionsTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Brend
 * @property string|null $name
 * @property string|null $image
 * @property integer|null $id
 * @mixin Model
 */
class Brand extends Model
{
    use LogsActivity, LogOptionsTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'slug'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'array',
        'image' => 'string'
    ];

    protected static $logName = 'brand';
    protected static $logAttributes = ['name'];
    protected static $submitEmptyLogs = false;


    /**
     * @return int
     */
    public function getID(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name[App::getLocale()] ?? null;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (is_file($this->image)) {
            return (string) $this->image;
        }

        return (string) 'images/no_brend.png';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_brands');
    }
}


