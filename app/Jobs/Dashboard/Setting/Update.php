<?php

namespace App\Jobs\Dashboard\Setting;

use App\Http\Requests\Dashboard\Setting\Update as Request;
use App\Models\Setting;
use Illuminate\Support\Arr;

class Update
{
    protected $attr;
    protected $setting;

    /**
     * Update constructor.
     * @param Setting $setting
     * @param array $attr
     */
    public function __construct(Setting $setting, array $attr = [])
    {
        $this->attr = Arr::only($attr, ['title', 'address', 'email', 'phone', 'socials', 'keywords', 'description', 'landmark', 'on_credit', 'permissions', 'links', 'buy_one']);
        $this->setting = $setting;
    }

    /**
     * @param Setting $setting
     * @param Request $request
     * @return Update
     */
    public static function fromRequest(Setting $setting, Request $request){
        return new static($setting, [
            'title' => $request->getTitle(),
            'address' => $request->getAddress(),
            'keywords' => $request->getKeywords(),
            'description' => $request->getDescription(),
            'email' => $request->getEmail(),
            'phone' => $request->getPhone(),
            'socials' => $request->getSocials(),
            'landmark' => $request->getLandmark(),
        ]);
    }

    /**
     *
     */
    public function handle()
    {
        $this->setting->update($this->attr);
    }
}
