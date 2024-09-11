<?php

namespace App\Jobs\Dashboard\Product;

use App\Models\Product;
use App\Models\Screen;
use Carbon\Carbon;
use App\Api\ImageResize;

use App\Http\Requests\Dashboard\Product\Store as StoreRequest;
use Illuminate\Support\Facades\Log;


class Child
{

    protected $request;
    protected $image;
    protected $product;


    /**
     * Child constructor.
     * @param StoreRequest $request
     * @param Product $product
     */
    public function __construct(StoreRequest $request, Product $product)
    {
        $this->request = $request;
        $this->product = $product;
        $this->image = new ImageResize();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->request->colors as $color) {
            $color_id = $color['color_id'] == "null" ? null : $color['color_id'];
            $sizes = !empty($color['sizes']) ? $color['sizes'] : null;



            $child = Product::create([
                'color_id' => $color_id,
                'sizes' => $sizes,
                'article_number' => $color['article_number'],
                'child_id' => $this->product->id,
                'published' => $this->product->published,
                'available' => true
            ]);

            if(!empty($color['screens'])) {
                foreach ($color['screens'] as $screen) {
                    $folder = Carbon::now()->format('Y/m/d');
                    $path = $screen['image']->store("uploads/screens/{$folder}");

                    $image = Screen::create([
                        'path' => $path,
                        'path_thumb' => "uploads/screens/thumbs/{$folder}/" . basename($path),
                        'name' => basename($path),
                        'product_id' => $child->id,
                        'size' => filesize($path)
                    ]);

                    $this->image->resize($image->path, 322, 'screens');
                }
            }

        }
    }
}
