<?php

namespace App\Jobs\Dashboard\Compilation;

use App\Http\Requests\Dashboard\Compilation\Store as StoreRequest;
use App\Models\Compilation;


class Store
{

    protected $request;

    /**
     * Store constructor.
     * @param StoreRequest $request
     */
    public function __construct(StoreRequest $request)
    {
        $this->request =  $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $compilation = Compilation::create([
            'title' => $this->request->getTitle(),
            'published' => $this->request->getPublished(),
            'position' => 1,
            'category_id' => $this->request->getCategory()
        ]);

        $map = array_map(function ($product) {
            return $product['id'];
        }, $this->request->products);

        $compilation->products()->attach($map);
    }
}
