<?php

namespace App\Jobs\Dashboard\Product;

use App\Models\Product;
use Illuminate\Support\Arr;

use App\Http\Requests\Dashboard\Product\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'poster', 'poster_thumb', 'body', 'price', 'price_discount', 'price_credit', 'currency', 'slug', 'published', 'brand_id', 'short_body', 'article_number', 'leader_of_sales', 'popular', 'count', 'available', 'descriptions', 'keywords', 'title_seo']);
    }


    /**
     * @param Request $request
     * @return Store
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'name' => $request->getName(),
            //'category_id' => $request->getCategoryID(),
            'brand_id' => $request->getBrandID(),

            'currency' => $request->currency,

            'price' => $request->getPrice(),
            'price_discount' => $request->getPriceDiscount(),
            'price_credit' => $request->getPriceCredit(),

            'poster' => $request->getPoster(),
            'poster_thumb' => $request->getPosterThumb(),

            'body' => $request->getBody(),
            'short_body' => $request->short_body,

            'slug' => $request->getSlug(),
            'published' => $request->getPublished(),
            'popular' => $request->getPopular(),
            'leader_of_sales' => $request->getLeaderOfSales(),

            'article_number' => $request->article_number,
            'count' => $request->count,
            'available' => $request->getAvailable(),
            'keywords' => $request->keywords,
            'descriptions' => $request->descriptions,
            'title_seo' => $request->title_seo,
        ]);
    }


    /**
     * @return mixed
     */
    public function handle()
    {
        $product = Product::create($this->attr);

        return $product;
    }
}
