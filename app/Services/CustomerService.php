<?php

namespace App\Services;

use App\Http\Controllers\CustomerController;
use App\Http\Resources\Customer\CustomerCollection;
use App\Models\Customer;

class CustomerService
{
    public function getCustomers()
    {
        $customers = Customer::all();

        return CustomerCollection::make($customers);
    }

    public function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number']
        ]);
    }
}
