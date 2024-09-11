<?php

namespace App\Jobs\Dashboard\Product;

use App\Models\Product;
use App\Models\Screen;
use Carbon\Carbon;

use App\Api\ImageResize;
use App\Http\Requests\Dashboard\Product\Update as UpdateRequest;


class ChildUpdate
{

    protected $product;
    protected $request;
    protected $image;

    /**
     * ChildUpdate constructor.
     * @param UpdateRequest $request
     * @param Product $product
     */
    public function __construct(UpdateRequest $request, Product $product)
    {
        $this->request = $request;
        $this->product = $product;
        $this->image = new ImageResize();
    }

    /**
     *
     */
    public function handle()
    {
        foreach ($this->request->colors as $color) {
            $id = $color['id'] == "null" ? null : $color['id'];
            $color_id = $color['color_id'] == "null" ? null : $color['color_id'];
            $sizes = !empty($color['sizes']) ? $color['sizes'] : null;

            if ($id == null) {
                $child = Product::create([
                    'color_id' => $color_id,
                    'sizes' => $sizes,
                    'article_number' => $color['article_number'],
                    'child_id' => $this->product->id,
                    //'published' => $this->product->published,
                    //'available' => true
                ]);

                if (!empty($color['screens'])) {
                    $this->uploadScreen($color['screens'], $child->id);
                }

            } else {
                $child = Product::find($id)->update([
                    'color_id' => $color_id,
                    'sizes' => $sizes,
                    'article_number' => $color['article_number'],
                    'child_id' => $this->product->id,
                    //'published' => $this->product->published,
                    //'available' => true
                ]);

                if (!empty($color['screens'])) {
                    $this->uploadScreen($color['screens'], $id);
                }
            }

        }
    }

    /**
     * @param $screens
     * @param $child_id
     */
    private function uploadScreen($screens, $child_id)
    {
        if (!empty($screens)) {
            foreach ($screens as $screen) {
                if ($screen['id'] == 'undefined' || $screen['id'] == 'null' || $screen['id'] = null) {
                    $folder = Carbon::now()->format('Y/m/d');
                    if ($screen['image']) {
                        $path = $screen['image']->store("uploads/screens/{$folder}");

                        $image = Screen::create([
                            'path' => $path,
                            'path_thumb' => "uploads/screens/thumbs/{$folder}/" . basename($path),
                            'name' => basename($path),
                            'product_id' => $child_id,
                            'size' => filesize($path)
                        ]);

                        $this->image->resize($image->path, 322, 'screens');
                    }
                }
            }
        }
    }
}
