<?php

namespace App\Http\Requests\Dashboard\Region;

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
            'name'   => 'required|array',
            'name.*' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }

    public function getCash()
    {
        if ($this->get('cash')) {
            return true;
        }

        return false;
    }

}
