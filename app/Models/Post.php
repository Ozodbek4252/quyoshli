<?php

namespace App\Models;

use App\Helpers\Month;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'topped' => 'boolean',
        //'created_at' => 'datetime:j M Y',
        'keywords' => 'string',
        'descriptions' => 'string'
    ];


    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (is_file($this->image)) {
            return $this->image;
        }

        return '/images/nophoto.jpg';
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        if (!empty($this->descriptions)) {
            return $this->descriptions;
        }

        return Str::limit(strip_tags($this->content), 250);
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        if (!empty($this->keywords)) {
            return $this->keywords;
        }

        $title = str_replace(' ', ', ', $this->name);
        $description = str_replace(' ', ', ', Str::limit(strip_tags($this->content), 250));

        return "{$title}, {$description}";
    }

    public function getDatePublic()
    {
        return Carbon::parse($this->created_at)->format('d').' '
            .Month::LayoutMonth(app()->getLocale(), Carbon::parse($this->created_at)->format('m')).' '
            .Carbon::parse($this->created_at)->format('Y');
    }
}
