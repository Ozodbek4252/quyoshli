<?php

namespace App\Http\Requests\Site\Profile;


use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
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
}
