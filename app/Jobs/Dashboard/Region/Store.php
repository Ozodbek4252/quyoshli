<?php

namespace App\Jobs\Dashboard\Region;

use App\Models\Region;
use Illuminate\Support\Arr;
use App\Http\Requests\Dashboard\Region\Store as Request;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['name', 'cash']);
    }

    /**
     * @param Request $request
     * @param $path
     * @return Store
     */
    public static function fromRequest(Request $request)
    {
        return new static([
            'name' => $request->getName(),
            'cash' => $request->getCash()
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        Region::create($this->attr);
    }
}
