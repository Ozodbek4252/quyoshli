<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;


class Password extends FormRequest
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
            'phone' => [
                'required',
                'string',
                'regex:/(998)(90|91|92|93|94|95|96|97|98|99|33|88)[0-9]{7}/',
            ],

            'password' => 'required'
        ];
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return (int) str_replace(['+', '(', ')', '-', ' '], '', $this->get('phone'));
    }

    public function getRemember(): bool
    {
        if ($this->get('remember')) {
            return true;
        }

        return false;
    }
}
