<?php

namespace App\Jobs\Site\Checkout;

use App\Models\Address;

class AddressStoreJob
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $phone_other = $this->request->address['other_phone'] ? str_replace(['+', '(', ')', ' ', '-'], '', $this->request->address['other_phone']) : null;
        return Address::create([
            'user_id' => auth()->user()->id,
            'first_name' => !empty(auth()->user()->first_name) ? auth()->user()->first_name : 'NoName',
            'phone_other' => $phone_other,
            'phone' => auth()->user()->phone,
            'city_id' => $this->request->address['city_id'],
            'street' => $this->request->address['address'],
        ]);
    }
}
