<?php

namespace App\Http\Controllers\Dashboard\Compilation;

use App\Http\Controllers\Controller as ExController;
use App\Models\Category;
use App\Models\Compilation;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\Dashboard\Compilation\Store as StoreRequest;
use App\Http\Requests\Dashboard\Compilation\Update as UpdateRequest;

use App\Jobs\Dashboard\Compilation\Store as StoreJob;
use App\Jobs\Dashboard\Compilation\Update as UpdateJob;

class Controller extends ExController
{

    protected $products;
    protected $compilation;
    protected $categories;

    /**
     * Controller constructor.
     * @param Product $product
     * @param Compilation $compilation
     * @param Category $category
     */
    public function __construct(Product $product, Compilation $compilation, Category $category)
    {
        $this->products = $product;
        $this->compilation = $compilation;
        $this->categories = $category;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'compilations');
        $compilations = Compilation::orderBy('position', 'asc')->get();
        return view('dashboard.compilations.index', compact('compilations'));
    }

//    public function store(StoreRequest $request)
//    {
//        if ($request->isMethod('get')) {
//            $this->authorize('create', 'compilations');
//
////            $this->authorize('content-manager');
//            $categories = $this->categories->where('parent_id', null)->get();
//            return view('dashboard.compilations.store', compact('categories'));
//        }
//
//        $this->dispatchSync(new StoreJob($request));
//
//        $this->success(trans('admin.messages.created'));
//        return response()->json([
//            'status' => true
//        ]);
//    }

    /**
     * @param Compilation $compilation
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Compilation $compilation, UpdateRequest $request)
    {
        if ($request->isMethod('get')) {
//            $this->authorize('content-manager');

            $compilation->loadMissing(['products:id,name,poster']);

            $this->authorize('update', 'compilations');

            foreach ($compilation->products as $product) {
                $product->poster = '/'. $product->poster;
                $product->name = $product->name['ru'];
            }


            $categories = $this->categories->where('parent_id', false)->get();


            return view('dashboard.compilations.update', compact('compilation', 'categories'));
        }

        $this->dispatchSync(new UpdateJob($request, $compilation));

        $this->info(trans('admin.messages.updated'));
        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->name;

        $product = $this->products->published()->where('name->ru', 'like', $query . '%')->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'poster' => '/' . $product->poster,
                'name' => $product->name['ru']
            ];
        });

        return response()->json([
            'status' => true,
            'products' => $product
        ]);
    }


    /**
     * @param Compilation $compilation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Compilation $compilation)
    {
        $this->authorize('delete', 'compilations');
        $compilation->delete();
        $this->info(trans('admin.messages.updated'));
        return redirect()->back();
    }
}
