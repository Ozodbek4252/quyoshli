<?php

namespace App\Http\Requests\Api\Filter;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories' => 'nullable|array',

            'brands' => 'nullable|array',
            'brands.*' => 'required',

            'sizes' => 'nullable',
            //'sizes.*' => 'required',

            'colors' => 'nullable|array',
            'colors.*' => 'required',

            'price_from' => 'nullable|numeric',
            'price_before' => 'nullable|numeric'
        ];
    }

    /**
     * @return array|null
     */
    public function getCategories()
    {
        return $this->get('categories');
    }


    /**
     * @return array|null
     */
    public function getBrand()
    {
        return $this->get('brands');
    }


    public function getSizes()
    {
        return $this->get('sizes');
    }

    /**
     * @return array|null
     */
    public function getColors()
    {
        return $this->get('colors');
    }

    /**
     * @return int|null
     */
    public function getPriceFrom()
    {
        return $this->get('price_from');
    }

    /**
     * @return int|null
     */
    public function getPriceBefore()
    {
        return $this->get('price_before');
    }
}
