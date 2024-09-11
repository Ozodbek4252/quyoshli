<?php

namespace App\Http\Requests\Api\Favorites;

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
            'id' => 'required'
        ];
    }

    public function getID(): int
    {
        return $this->get('id');
    }
}
