<?php

namespace App\Http\Requests\Api\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     *
     */
    public function prepareForValidation()
    {
        $this->merge([
            'phone' => str_replace(['+', '(', ')', '-', ' '], '', $this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => trans('vue.login.confirmed'),
            'password.min' => trans('vue.login.min')
        ];
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return (int) str_replace(['+', '(', ')', '-', ' '], '', $this->get('phone'));
    }

}

