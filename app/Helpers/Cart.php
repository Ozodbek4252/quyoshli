<?php


namespace App\Helpers;

use App\Models\Cart as Model;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class Cart
{

    /**
     * @return array
     */
    public function getProducts()
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))
                ->with('product:id,child_id', 'product.product:id,name,price,price_discount,poster_thumb,slug,leader_of_sales,currency,article_number,count,available')
                ->whereHas('product', function ($query) {
                    $query->whereHas('product', function ($query) {
                        return $query->isAvailable();
                    });
                })
                ->get();
        } else if (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)
                ->with('product:id,child_id', 'product.product:id,name,price,price_discount,poster_thumb,slug,leader_of_sales,currency,article_number,count,available')
                ->whereHas('product', function ($query) {
                    $query->whereHas('product', function ($query) {
                        return $query->isAvailable();
                    });
                })
                ->get();
        } else {
            $cart = collect([]);
        }

        $cart->map(function ($cart) {
            if (!empty($cart->product) && !empty($cart->product->product)) {
                $cart->price = $cart->product->product->getPrice();
                $cart->price_discount = $cart->product->product->price_discount == null ? null : $cart->product->product->getDiscountPrice();
            } else {
                $cart->price = 0;
                $cart->price_discount = 0;
            }

        });

        $prices = $cart->map(function ($cart) {
            $price = 0;
            $price_discount = 0;

            $price_current = 0;

            $price += $cart->price * $cart->count;
            $price_discount += $cart->price_discount * $cart->count;

            $price_current = $cart->price_discount ? $cart->price_discount * $cart->count : $cart->price * $cart->count;

            return $price_current;
        });

        $prices = array_sum($prices->toArray());

        return [$prices, $cart];
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))->where('product_id', $request->product_id)->where('size', $request->getSize())->first();
            if (!empty($cart)) {
                $cart->update([
                    'count' => $cart->count + $request->count
                ]);
            } else {
                Model::create([
                    'product_id' => $request->product_id,
                    'count' => $request->count,
                    'size' => $request->getSize(),
                    'token' => $request->cookie('cart_token')
                ]);
            }

            $count = Model::findByToken($request->cookie('cart_token'))->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $request->product_id)->where('size', $request->getSize())->first();

            if (!empty($cart)) {
                $cart->update([
                    'count' => $cart->count +  $request->count
                ]);
            } else {
                Model::create([
                    'product_id' => $request->product_id,
                    'count' => $request->count,
                    'size' => $request->getSize(),
                    'user_id' => auth()->user()->id
                ]);
            }

            $count = auth()->user()->cart()->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        }

        return $count;
    }

    /**
     * @param $product
     * @return mixed
     */
    public function delete($product)
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))->where('product_id', $product)->first();
            if (!empty($cart))
                $cart->delete();

            $count = Model::findByToken(Cookie::get('cart_token'))->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        } else if (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $product)->first();
            if (!empty($cart))
                $cart->delete();

            $count = auth()->user()->cart()->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        }

        return $count;
    }

    /**
     *
     */
    public function removeAll()
    {
        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken(Cookie::get('cart_token'))->delete();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->delete();
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function update($request)
    {
        $product = Product::find($request->product_id);
        $max_count = $product->product->count;

        if (Cookie::has('cart_token')) {
            $cart = Model::findByToken($request->cookie('cart_token'))->where('product_id', $request->product_id)->where('size', $request->getSize())->first();
            if (!empty($cart)) {
                $cart->update([
                    'count' => $request->count
                ]);
            } else {
                $cart = Model::create([
                    'product_id' => $request->product_id,
                    'count' => $request->count,
                    'size' => $request->getSize(),
                    'token' => $request->cookie('cart_token')
                ]);
            }

            $count = Model::findByToken($request->cookie('cart_token'))->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        } elseif (auth()->check()) {
            $cart = Model::findByUser(auth()->user()->id)->where('product_id', $request->product_id)->where('size', $request->getSize())->first();

            if (!empty($cart)) {
                $cart->update([
                    'count' => $request->count
                ]);
            } else {
                $cart = Model::create([
                    'product_id' => $request->product_id,
                    'count' => $request->count,
                    'size' => $request->getSize(),
                    'user_id' => auth()->user()->id
                ]);
            }

            $count = auth()->user()->cart()->whereHas('product', function ($query) {
                $query->whereHas('product');
            })->count();
        }


//        $price = 0;
//        $price_discount = 0;
//        $price_current = 0;
//
//        $price += $cart->product->product->getPrice();
//        $price_discount += $cart->product->product->getDiscountPrice();
//
//        $price_current = $cart->product->product->price_discount ? $price_discount : $price;
        list($price) = $this->getProducts();

        return [$price, $count, $max_count];
    }

    public function getBasketCount()
    {
        if (Cookie::has('cart_token')) {
            $count = Model::findByToken(Cookie::get('cart_token'))->whereHas('product', function ($query) {
                $query->whereHas('product', function ($query) {
                    return $query->isAvailable();
                });
            })->count();
        } elseif (auth()->check()) {
            $count = auth()->user()->cart()->whereHas('product', function ($query) {
                $query->whereHas('product', function ($query) {
                    return $query->isAvailable();
                });
            })->count();
        }

        return $count;
    }


    /**
     * @param $user_id
     */
    public function AddToCartUpdate($user_id)
    {
        $token = Cookie::get('cart_token');

        $carts = Model::findByToken($token)->get()->map(function ($cart) {
            return $cart->product_id;
        });

        $cart_user = Model::findByUser($user_id)->get()->map(function ($cart) {
            return $cart->product_id;
        });

        $product_id = array_diff($carts->toArray(), $cart_user->toArray());

        Model::whereIn('product_id', $product_id)->findByToken($token)->update([
            'token' => null,
            'user_id' => $user_id
        ]);

        Cookie::queue(Cookie::forget('cart_token'));

    }
}
