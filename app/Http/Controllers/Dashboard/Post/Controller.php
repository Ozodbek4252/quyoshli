<?php

namespace App\Http\Controllers\Dashboard\Post;

use App\Http\Controllers\Controller as ExController;
use App\Models\Post;

use App\Http\Requests\Dashboard\Post\Update as UpdateRequest;
use App\Http\Requests\Dashboard\Post\Store as StoreRequest;

use App\Jobs\Dashboard\Post\Store as StoreJob;
use App\Jobs\Dashboard\Post\Update as UpdateJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Controller extends ExController
{
    protected $posts;

    /**
     * Controller constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->posts = $post;
    }

    /**
     * @param $lang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index($lang)
    {
        $this->authorize('view', 'posts');
        $posts = $this->posts->latest('id')
            ->where('language', $lang)
            ->paginate(20);
        return view('dashboard.posts.index', compact('posts', 'lang'));
    }

    /**
     * @param UpdateRequest $request
     * @param $lang
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $lang, Post $post)
    {
        if ($request->isMethod('get')) {
            $this->authorize('update', 'posts');
            return view('dashboard.posts.update', compact('lang','post'));
        }

//        return $request->all();

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/posts');
        } else {
            $path = $post->getImage();
        }

//        if ($request->has('topped')) {
//            DB::table('posts')
//                ->where('topped', true)
//                ->where('language', $lang)
//                ->update([
//                    'topped' => false
//                ]);
//        }

        $this->dispatchNow(UpdateJob::fromRequest($post, $request, $path));
        $this->info(trans('admin.messages.updated'));
        return redirect()->route('dashboard.posts', $lang);
    }

    /**
     * @param StoreRequest $request
     * @param $lang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request, $lang)
    {
        if ($request->isMethod('get')) {
            $this->authorize('create', 'posts');
            return view('dashboard.posts.store', compact('lang'));
        }


        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('uploads/posts');
        }

        if ($request->has('topped')) {
            DB::table('posts')
                ->where('topped', true)
                ->where('language', $lang)
                ->update([
                    'topped' => false
                ]);
        }

        $this->dispatchNow(StoreJob::fromRequest($request, $path));
        $this->info(trans('admin.messages.created'));
        return redirect()->route('dashboard.posts', $lang);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Post $post)
    {
        $this->authorize('delete', 'posts');
        if (is_file($post->image)) {
            unlink($post->image);
        }

        $post->delete();
        $this->info(trans('admin.messages.deleted'));
        return redirect()->back();
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $folder = Carbon::now()->format('Y/m/d');
            $path = $request->file('file')->store("uploads/posts/{$folder}");

            return response()->json([
                'image' => $path
            ]);
        }

        return response()->json([
            'status' => false
        ], 403);
    }
}
