<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function getCustomers(): Collection
    {
        return Customer::all();
    }

    public function create(array $data): Customer
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number']
        ]);
    }
}
