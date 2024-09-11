<?php

namespace App\Models;

use App\Traits\LogOptionsTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cookie;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Product
 *
 * @property string|null $name
 * @property string|null $body
 * @property string|null $short_body
 * @property string|null $slug
 * @property array|null $colors
 * @property array|null $sizes
 * @property integer|null $price
 * @property boolean|null $published
 * @property integer|null $price_discount
 * @property integer|null $child_id
 * @property string|null $poster
 * @property string|null $poster_thumb
 * @property boolean|null $popular
 * @property boolean|null $leader_of_sales
 *
 * @property-read Category $category
 * @property-read Collection|Screen[] $screens
 * @property float price_credit
 * @mixin Model
 */
class Product extends Model
{
    use SoftDeletes, LogsActivity, LogOptionsTrait;

    protected $appends = ['isFavorite', 'discountPrice', 'diffDate', 'isCart', 'onCredit', 'isAvailable'];

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
        'body' => 'array',
        'short_body' => 'array',
        'slug' => 'string',
        'sizes' => 'array',
        'poster' => 'string',
        'poster_thumb' => 'string',

        'price' => 'float',
        'price_discount' => 'float',
        'price_credit' => 'float',

        'currency' => 'string',
        'article_number' => 'integer',

        'published' => 'boolean',

        'popular' => 'boolean',
        'leader_of_sales' => 'boolean',

        //'category_id' => 'array',
        'brand_id' => 'integer',
        'color_id' => 'integer',
        'child_id' => 'integer',
        'available' => 'boolean',
        'count' => 'integer',
        'keywords' => 'array',
        'descriptions' => 'array',
        'title_seo' => 'array',
    ];


    protected $hidden = [
        'child_id', 'deleted_at'
    ];

    protected static $logName = 'products';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['name', 'price', 'price_discount', 'article_number', 'published', 'available', 'count', 'title_seo', 'price_credit'];
    protected static $submitEmptyLogs = false;
    /**
     * @var mixed
     */

    /**
     * @return string
     */
    public function getName(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->name['ru'];
        }

        return (string) $this->name['uz'];
    }

    /**
     * @return string
     */
    public function getTitleSeo(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->title_seo['ru'];
        }

        return (string) $this->title_seo['uz'];
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        if (App::isLocale('ru')) {
            return (string) $this->body['ru'];
        }

        return (string) $this->body['uz'];
    }

    /**
     * @return string
     */
    public function getShortBody(): string
    {
        if (App::isLocale('ru')) {
            if (!empty($this->descriptions['ru'])) {
                return (string) $this->descriptions['ru'];
            }

            return (string) $this->short_body['ru'];
        }

        if (!empty($this->descriptions['uz'])) {
            return (string) $this->descriptions['uz'];
        }

        return (string) $this->short_body['uz'];
    }


    /**
     * @return string
     */
    public function getKeywords()
    {

        if (App::isLocale('ru')) {
            if (!empty($this->keywords['ru'])) {
                $title = str_replace(' ', ', ', $this->getName());
                $keywords = $this->keywords['ru'];
                return "{$title}, {$keywords}";
            }
        }

        if (!empty($this->keywords['uz'])) {
            $title = str_replace(' ', ', ', $this->getName());
            $keywords = $this->keywords['uz'];
            return "{$title}, {$keywords}";
        }

        $title = str_replace(' ', ', ', $this->getName());
        $description = str_replace(' ', ', ', $this->getShortBody());

        return "{$title}, {$description}";
    }


    /**
     * @return float
     */
    public function getPrice()
    {
        return round($this->price * $this->getCurrency());
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        if (is_file(public_path($this->poster))) {
            return $this->poster;
        }

        return '/images/no_product.jpg';
    }


    /**
     * @return float
     */
    public function getDiscountPrice()
    {
        return round($this->price_discount * $this->getCurrency());
    }

    /**
     * @return float|int
     */
    public function getOnCreditAttribute()
    {
        $price = $this->getPriceCredit();

        $credit = $price / 11;

        return abs($credit);

//        $credit = $price * 37 / 100 + $price;
//        return $credit / 12;
    }

    /**
     * @return float
     */
    public function getPriceCredit(): float
    {
        return round($this->price_credit * $this->getCurrency());
    }

    private function pmt(float $rate, int $periods, float $present_value, float $future_value = 0.0, bool $beginning = false): float
    {
        $when = $beginning ? 1 : 0;

        if ($rate == 0) {
            return - ($future_value + $present_value) / $periods;
        }

        return - ($future_value + ($present_value * pow(1 + $rate, $periods)))
            /
            ((1 + $rate * $when) / $rate * (pow(1 + $rate, $periods) - 1));
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        $currency = Currency::latest('id', 'desc')->limit(1)->first();

        if ($this->currency == 'dollar') {
            return $currency->dollar;
        } elseif ($this->currency == 'sum') {
            return 1;
        } else {
            return $currency->euro;
        }
    }

    /**
     * @return string
     */
    public function getPriceFormat()
    {
        return number_format($this->price, 0, '', ' ');
    }

    /**
     * @return int
     */
    public function getPriceDiscount(): int
    {
        return (int) $this->price_discount;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function screen()
    {
        return $this->belongsTo(Screen::class,'id', 'product_id');
    }

    /**
     * @return float|int
     */
    public function discount()
    {
        $a = $this->price;
        $b = $this->price_discount;

        $x = (($b * 100) / $a) - 100;

        return abs($x);
    }

    /**
     * @return bool
     */
    public function getDiffDate()
    {
        $original_date = date_create(Carbon::parse($this->created_at)->format('Y-m-d'));
        $now = date_create(Carbon::now()->format('Y-m-d'));
        $diff = date_diff($original_date, $now);

        if ($diff->format("%a") <= 10 ) {
            return true;
        }

        return false;
    }



    /**
     * @return array
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    /**
     * @return array
     */
    public function getSizes(): array
    {
        return $this->sizes;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products');
    }


    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (string) $this->slug;
    }

    /**
     * @return bool
     */
    public function isAviable(): bool
    {
        return $this->published;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault([
            'name' => [
                'uz' => 'Brand yo`q',
                'ru' => 'Бренд нет'
            ]
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function children()
    {
        return $this->hasOne(self::class, 'child_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany(self::class, 'child_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('publish', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrensColor()
    {
        return $this->hasMany(self::class, 'child_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screens()
    {
        return $this->hasMany(Screen::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data()
    {
        return $this->hasOne(self::class, 'child_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(self::class, 'child_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', true)->whereNull('deleted_at');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotChilds($query)
    {
        return $query->whereNull('child_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function compilations()
    {
        return $this->belongsToMany(Compilation::class, 'compilation_products');
    }

    /**
     * @param $query
     * @param $brand_id
     * @return mixed
     */
    public function scopeBrand($query, $brand_id)
    {
        return $query->where('brand_id', $brand_id);
    }

    public function getIsFavoriteAttribute()
    {
        $user = request()->user();

        if (!empty($user)) {
            $favorite = $this->belongsToMany(User::class, 'products_users')->where('user_id', $user->id)->where('product_id', $this->id)->first();

            if (!empty($favorite)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getIsAvailableAttribute()
    {
        if ($this->available && $this->count > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getIsCartAttribute()
    {
        $childrens = $this->childrens()->get()->map(function ($product) {
            return $product->id;
        });

        if (Cookie::has('cart_token'))
            $cart = !empty(Cart::whereIn('product_id', $childrens)->findByToken(Cookie::get('cart_token'))->first()) ? true : false;
        else if (auth()->check())
            $cart = !empty(Cart::whereIn('product_id', $childrens)->findByUser(auth()->user()->id)->first()) ? true : false;

        if (!empty($cart))
            return true;

        return false;
    }

    /**
     * @return float
     */
    public function getDiscountPriceAttribute()
    {
        $a = $this->price;
        $b = $this->price_discount;

        if (empty($b)) {
            return 0;
        }

        $x = (($b * 100) / $a) - 100;

        return round(abs($x));
    }

    /**
     * @return bool
     */
    public function getDiffDateAttribute()
    {
        $original_date = date_create(Carbon::parse($this->created_at)->format('Y-m-d'));
        $now = date_create(Carbon::now()->format('Y-m-d'));
        $diff = date_diff($original_date, $now);

        if ($diff->format("%a") <= 10 ) {
            return true;
        }

        return false;
    }

    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class, 'characteristics_products')->withPivot(['value']);
    }

    public function scopeIsAvailable($query)
    {
        return $query->where('available', true)->where('count', '>', 0);
    }


    public function scopeSearchFilter($query, $id, $brand, $category, $published, $article_number, $category_id, $name)
    {
        return $query->when($id ?? null, function ($query, $id) {
                $query->where('id', $id);
            })
//            ->whereHas('brand', function ($query) use ($brand) {
//                $query->when($brand ?? null, function ($q, $brand) {
//                    $q->where('name->ru', 'like', '%'.$brand.'%');
//                });
//            })
            ->whereHas('categories', function ($query) use ($category, $category_id) {
                $query->when($category ?? null, function ($query, $category) use ($category_id) {
                    $query->whereIn('id', $category_id);
                });
            })->when($published ?? null, function ($query, $published) {
                if ($published == 2) {
                    $query->where('published', false);
                } else {
                    $query->where('published', true);
                }
            })->when($name ?? null, function ($query, $name) {
                $query->where('name->ru', 'ilike', '%'.$name.'%');
            })->when($article_number ?? null, function ($query, $article_number) {
                $query->where('article_number', $article_number);
            })->notChilds();
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_product');
    }
}
