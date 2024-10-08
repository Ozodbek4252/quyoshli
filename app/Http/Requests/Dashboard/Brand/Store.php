<?php

namespace App\Http\Requests\Dashboard\Brand;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'array',
            'name.*' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg'
        ];
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }

}
