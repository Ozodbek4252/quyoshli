<?php


namespace App\Queries;

use App\Models\Category as Model;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category
{
    /**
     * @return mixed
     */
    public function getCurrentCategories()
    {
        return Model::orderBy('position', 'asc')
            ->whereNull('parent_id')
            ->get();
    }

    /**
     * @param $category
     * @return array
     */
    public function getCategoriesAndCategoryId($category)
    {
        $categories = $category->parents()->select('id', 'name', 'parent_id', 'slug', 'published')
            ->with('parent:id,name,slug,parent_id,published', 'parent.parent:id,name,slug,parent_id,published')
            ->get();

        $categories->map(function ($category) {
            $category->link = route('category.showParent', [$category->parent->parent->slug, $category->parent->slug, $category->slug]);
            return $category;
        });

        $category_id = $categories->map(function ($category) {
            return $category->id;
        });

        $category_id = array_merge($category_id->toArray(), [$category->id]);

        return [$categories, $category_id];
    }

    public function getCategoriesAndCategoryMainId($category)
    {
        $categories = $category->parents->map(function ($category) {
            $category->link = route('category.show', [$category->parent->slug, $category->slug]);

            return $category;
        });

        $category_id = $category->parents->map(function ($category) {

            $categories = [];

            if ($category->parents) {
                $categories[] = $category->parents->map(function ($parent) {
                    return $parent->id;
                });
            }

            $categories[] = $category->id;

            return $categories;
        })->flatten(2);

        $category_id = array_merge($category_id->toArray(), [$category->id]);

        return [$categories, $category_id];
    }

    /**
     * @param $category_id
     * @return mixed
     */
    public function getProductsFromCategoryId($category_id)
    {
        $products = Product::select('id', 'name', 'poster_thumb', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'currency', 'available', 'count')
            ->when($category_id ?? [], function ($query, $category_id) {
                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->whereIn('id', $category_id);
                });
            })
            ->with('children:id,child_id')
            ->whereHas('children')
            ->orderBy('id', 'desc')
            ->published()
            ->paginate(12);

        $products->map(function ($product) {
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

        //        $products->categories->map(function ($category) {
        //           $category->link = 'test.com';
        //           return $category;
        //        });

        return $products;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getCharacteristics($category)
    {
        $characteristics = $category->characteristics()->where('filter', true)->with(['values' => function ($value) {
            return $value->select('value');
        }])->whereHas('values', function ($query) {
            $query->whereNull('deleted_at');
        })->get();

        $characteristics = $characteristics->map(function ($char) {
            $group = $char->values->groupBy('value');
            $values = [];

            foreach ($group as $key => $value) {
                if ($key != 'null') {
                    $values[] = $key;
                }
            }

            $char->attributes = $values;

            return $char;
        });

        $characteristics->makeHidden('values');

        return $characteristics;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getCategoryProducts($category)
    {
        $products = $category->products()
            ->select('id', 'name', 'poster_thumb', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'currency')
            ->with('categories:id,name', 'children:id,child_id')
            ->whereHas('childrens')
            ->orderBy('products.id', 'desc')
            ->published()
            ->paginate(12);

        $products->map(function ($product) {
            $product->price = $product->getPrice();
            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
        });

        return $products;
    }

    /**
     * @param $category_id
     * @param Request $request
     * @return array
     */
    public function getFilterProducts($category_id, Request $request)
    {
        $products = Product::select('id', 'name', 'poster_thumb', 'price', 'price_discount', 'popular', 'slug', 'leader_of_sales', 'currency', 'available', 'count')
            ->when($category_id ?? [], function ($query, $category_id) {
                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->whereIn('id', $category_id);
                });
            })
            ->with('categories:id,name', 'children:id,child_id')
            ->whereHas('childrens')
            ->published();

        if (count($request->filter) > 0) {
            $attributes = collect($request->filter)->map(function ($filter) {
                return $filter;
            })->groupBy('id');

            $attributes = $attributes->map(function ($attr) {
                $attribute = $attr->map(function ($attr) {
                    $row = [];
                    $row[] = $attr['attribute'];
                    return $row;
                })->flatten(1);

                $id = $attr->map(function ($attr) {
                    $row = [];
                    $row[] = $attr['id'];
                    return $row;
                })->flatten(1)->first();

                return [
                    'id' => $id,
                    'attributes' => $attribute
                ];
            });

            foreach ($attributes as $attr) {
                $products = $products->whereHas('characteristics', function ($query) use ($attr) {
                    $query->where('characteristics_products.characteristic_id', $attr['id'])->whereIn('characteristics_products.value', $attr['attributes']);
                });
            }
        }

        switch ($request->order_by) {
            case 'all':
                $products = $products->orderBy('name->ru', 'asc');
                break;
            case 'new':
                $products = $products->orderBy('id', 'desc');
                break;
            case 'cheap':
                $products = $products->orderByRaw('COALESCE(price_discount, price) ASC');
                break;
            case 'expensive':
                $products = $products->orderByRaw('COALESCE(price_discount, price) DESC');
                break;
            default:
                $products = $products->orderBy('id', 'desc');
                break;
        }

        $paginate = $request->paginate ? (int) $request->paginate : 12;

        $page = $request->get('page');
        $page = $page == 1 ? 0 : (int)$paginate * (int)$page - (int)$paginate;


        $count = $products->count();

        $products = $products->skip($page)->take($paginate)->get();

        $products->map(function ($product) {
            $product->price = $product->getPrice();
            $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();
        });

        return [$count, $products];
    }
}
