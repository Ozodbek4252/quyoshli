<?php

namespace App\Http\Requests\Api\Order;

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
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'phone' => 'required|min:9|max:9',
            'first_name' => 'required',

            'type_delivery' => 'required',
//            'shipment_date' => 'nullable',

//            'city' => 'nullable',
//            'region' => 'nullable',
//            'street' => 'nullable',
//            'floor' => 'nullable',
//            'apartment' => 'nullable',
//            'entrance' => 'nullable',

            'payment_type' => 'required',
            'comment' => 'nullable',
//            'branch_id' => 'nullable',

            'products' => 'array|required',
            'products.*.id' => 'required',
            'products.*.count' => 'required',
            'products.*.size' => 'required',
            'products.*.color_id' => 'required',
        ];
    }

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();

        if ($this->isMethod('post')) {

            $validator->sometimes('branch_id', 'required', function($input) {
                return $input->type_delivery == 2;
            });

            $validator->sometimes('shipment_date', 'required', function($input) {
                return $input->type_delivery == 2;
            });

            $validator->sometimes('city', 'required', function($input) {
                return $input->type_delivery == 1;
            });

            $validator->sometimes('region', 'required', function($input) {
                return $input->type_delivery == 1;
            });

            $validator->sometimes('street', 'required', function($input) {
                return $input->type_delivery == 1;
            });
        }

        return $validator;
    }



    /**
     * @return int
     */
    public function getPhone(): int
    {
        return (int ) 998 . $this->get('phone');
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return (string) $this->get('first_name');
    }

    /**
     * @return mixed|null
     */
    public function getBranchID()
    {
        if ($this->get('branch_id')) {
            return $this->get('branch_id');
        }

        return null;
    }


    /**
     * @return int
     */
    public function getTypeDelivery(): int
    {
        return (int) $this->get('type_delivery');
    }

    /**
     * @return mixed|null
     */
    public function getShipmentDate()
    {
        if ($this->get('shipment_date')) {
            return  $this->get('shipment_date');
        }

        return null;
    }


    /**
     * @return string|null
     */
    public function getCity()
    {
        if ($this->get('city')) {
            return (string) $this->get('city');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        if ($this->get('region')) {
            return (string) $this->get('region');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getStreet()
    {
        if ($this->get('street')) {
            return (string) $this->get('street');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getFloor()
    {
        if ($this->get('floor')) {
            return (string) $this->get('floor');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getApartment()
    {
        if ($this->get('apartment')) {
            return (string) $this->get('apartment');
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getEntrance()
    {
        if ($this->get('entrance')) {
            return (string) $this->get('entrance');
        }

        return null;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return (string) $this->get('payment_type');
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return (string) $this->get('comment');
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->get('products');
    }
}
