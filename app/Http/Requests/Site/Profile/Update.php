<?php

namespace App\Http\Requests\Site\Profile;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required'
        ];
    }
}
