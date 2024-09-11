<?php


namespace App\Helpers;


use App\Models\Category;
use App\Models\Compilation;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class MainPage
{
    protected $agent;
    protected $lang;

    /**
     * MainPage constructor.
     */
    public function __construct()
    {
        $this->agent = new Agent();
        $this->lang = app()->getLocale();
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getMainProducts($type)
    {
        $newProducts = Compilation::published();

        switch ($type) {
            case 'new':
                $newProducts = $newProducts->newProducts();
                break;
            case 'popular':
                $newProducts = $newProducts->popularProducts();
                break;
            case 'lider':
                $newProducts = $newProducts->liderProducts();
                break;
            default:
                $newProducts = $newProducts->newProducts();
                break;
        }

        $newProducts = $newProducts->published()->first()->products()->published()->with('categories:id,name,parent_id,slug', 'categories.parent.parent', 'children:id,child_id', 'children')->isAvailable()->get(['id', 'name', 'price', 'price_discount', 'poster_thumb', 'slug', 'leader_of_sales', 'currency', 'available', 'count']);

        $newProducts->map(function ($product) {
            $product->categories->map(function ($category) {
                if ($category->parent) {
                    if ($category->parent->parent) {
                        $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
                    } else {
                        $category->link = route('category.show', [$category->parent->slug, $category->slug]);
                    }
                } else {
                    $category->link = route('category.view', $category->slug);
                }
            });

            $product->price = $product->getPrice();
            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
        });

        return $newProducts;
    }

    /**
     * @return mixed
     */
    public function getPopularCategories()
    {
        $popularCategories = Category::latest('id')
            ->latest('id')
            ->where('popular', true)
            ->get();

        $popularCategories->map(function ($category) {
            if ($category->parent) {
                if ($category->parent->parent) {
                    $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
                } else {
                    $category->link = route('category.show', [$category->parent->slug, $category->slug]);
                }
            } else {
                $category->link = route('category.view', $category->slug);
            }
        });

        return $popularCategories;
    }

    /**
     * @param $lang
     * @return array
     */
    public function getSliders($lang)
    {
        if ($this->agent->isMobile()) {
            if ($this->agent->isTablet()) {
                $sliders = Slider::where('language', $lang)
                    ->where('type', 'desktop')
                    ->where('placement', 'top')
                    ->orderBy('position', 'asc')
                    ->published()
                    ->get();

                $middleSliders = Slider::where('language', $lang)
                    ->where('type', 'desktop')
                    ->where('placement', 'middle')
                    ->orderBy('position', 'asc')
                    ->published()
                    ->get();
            } else {
                $sliders = Slider::where('language', $lang)
                    ->where('type', 'mobile')
                    ->where('placement', 'top')
                    ->orderBy('position', 'asc')
                    ->published()
                    ->get();

                $middleSliders = Slider::where('language', $lang)
                    ->where('type', 'mobile')
                    ->where('placement', 'middle')
                    ->orderBy('position', 'asc')
                    ->published()
                    ->get();
            }

        } else {
            $sliders = Slider::where('language', $lang)
                ->where('type', 'desktop')
                ->where('placement', 'top')
                ->orderBy('position', 'asc')
                ->published()
                ->get();

            $middleSliders = Slider::where('language', $lang)
                ->where('type', 'desktop')
                ->where('placement', 'middle')
                ->orderBy('position', 'asc')
                ->published()
                ->get();
        }

        return [$sliders, $middleSliders];
    }

    /**
     * @param $lang
     * @return array
     */
    public function getPosts($lang)
    {
        $posts = Post::latest('id')
            ->where('language', $lang)
            ->where('topped', false)
            ->whereIn('type', ['news','sales'])
            ->limit(3)
            ->get();

        $posts->map(function ($post) {
            $post->date = $post->getDatePublic();
            $post->content = Str::limit($post->content, 150);
        });

        $toppedPost = Post::where('topped', true)
            ->where('language', $lang)
            ->select('id', 'name', 'language', 'created_at', 'image', 'slug', 'type', 'content')
            ->first();

        $toppedPost->date = $toppedPost->getDatePublic();

        return [$posts, $toppedPost];
    }
}
