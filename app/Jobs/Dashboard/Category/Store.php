<?php

namespace App\Jobs\Dashboard\Category;

use App\Http\Requests\Dashboard\Category\Request;
use App\Models\Category;

class Store
{
    /**
     * @var $request
     */
    protected $request;

    /**
     * Store constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Category
     */
    public function handle()
    {
        $request = $this->request;

        $category = new Category;

        $category->name = $request->getName();
        $category->slug = $request->getSlug();
        $category->position = $request->getPosition();
        $category->image = $request->getImage();
        $category->parent_id = $request->getParentId();
        $category->published = $request->getPublished();
        $category->credit = $request->getCredit();
        $category->keywords = $request->keywords;
        $category->title_seo = $request->title_seo;

        $category->save();

        $category->brands()->sync($request->brands, false);

        return $category;
    }
}
