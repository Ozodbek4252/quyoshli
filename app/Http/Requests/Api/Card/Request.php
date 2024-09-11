<?php

namespace App\Http\Requests\Api\Card;

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
            'products' => 'array|required',
            'products.*.id' => 'required',
            'products.*.count' => 'required',
            'products.*.size' => 'required',
            'products.*.color_id' => 'required',
        ];
    }


    /**
     * @return array|null
     */
    public function getProducts()
    {
        return $this->get('products');
    }
}
