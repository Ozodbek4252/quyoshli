<?php

namespace App\Http\Requests\Site\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreditRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'phone' => str_replace(['+', '(', ')', '-', ' '], '', $this->phone),
        ]);
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
            'phone' => [
                'required',
                'string',
                'regex:/(998)(90|91|92|93|94|95|96|97|98|99|33|88)[0-9]{7}/',
            ],
            'code' => 'required|numeric|min:6'
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
