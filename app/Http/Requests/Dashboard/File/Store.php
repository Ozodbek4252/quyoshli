<?php

namespace App\Http\Requests\Dashboard\File;

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
        return [
            'file' => 'required|mimes:jpg,png,jpeg'
        ];
    }
}
