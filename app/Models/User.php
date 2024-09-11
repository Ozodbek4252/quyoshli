<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'integer',
        'verify_code' => 'integer',
        'step' => 'integer',
        'ip' => 'string',
        'role_id' => 'integer',
        'gander' => 'boolean',
        'language' => 'string',
        'category_id' => 'integer',
        'avatar' => 'string',
        'notification' => 'boolean',
        'verified' => 'boolean',
    ];

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return (string) $this->first_name;
    }

    /**
     * @return bool
     */
    public function isRegistered(): bool
    {
        return $this->step == 3 ? true : false;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return (string) $this->last_name;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return (int) $this->phone;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return (string) $this->ip;
    }
//
//    /**
//     * @return bool
//     */
//    public function isAdmin(): bool
//    {
//        return $this->role_id == 1;
//    }

    /**
     * @return bool
     */
    public function isClient(): bool
    {
        return $this->role_id == Role::CLIENT;
    }

    /**
     * @return bool
     */
    public function isVerify(): bool
    {
        return $this->verify_code;
    }

    /**
     * @return bool
     */
    public function isNotVerify(): bool
    {
        return ! $this->isVerify();
    }

    /**
     * @param int $code
     * @return bool
     */
    public function isVerifyCode(int $code): bool
    {
        return $this->verify_code == $code;
    }

    /**
     * @param string $code
     * @return bool
     */
    public function isNotVerifyCode(string $code): bool
    {
        return ! $this->isVerifyCode($code);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'id', 'user_id')->withDefault([
            'city' => '',
            'region' => '',
            'address' => '',
            'house' => '',
            'apartment' => '',
            'floor' => '',
            'entrance' => ''
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function basket()
    {
        return $this->hasMany(Basket::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_users');
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return (string) $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSteped($query)
    {
        return $query->where('step', 3);
    }

    /**
     * @param $query
     * @param $phone
     * @return mixed
     */
    public function scopeFindByPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withPivot('role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @param $query
     * @param $date_from
     * @param $date_to
     * @param $sort_type
     * @return mixed
     */
    public function scopeFilterByDate($query, $date_from, $date_to, $sort_type)
    {
        if (!is_null($date_from)) {
            $date_from = Carbon::parse($date_from)->format('Y-m-d 00:00:01');

            if ($date_to) {
                $date_to = Carbon::parse($date_to)->format('Y-m-d 23:59:59');
            } else {
                $date_to = Carbon::now()->format('Y-m-d 23:59:59');
            }

            $query->whereBetween($sort_type, [$date_from, $date_to]);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $search_id
     * @param $search_phone
     * @param $search_ip
     * @return mixed
     */
    public function scopeSearch($query, $search_id, $search_phone, $search_ip)
    {
        if (!is_null($search_id))
            $query->where('id', 'ilike', '%' . $search_id . '%');
        elseif (!is_null($search_phone))
            $query->where('phone', 'ilike', '%' . $search_phone . '%');
        elseif (!is_null($search_ip))
            $query->where('ip', 'ilike', '%' . $search_ip . '%');

        return $query;
    }
}
