<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Services\CustomerService;
use App\Traits\PaginationTrait;

class CustomerController extends Controller
{
    use PaginationTrait;
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerService->getCustomers();

        $paginatedCustomers = $this->paginateCollection($customers);

        return CustomerCollection::make($paginatedCustomers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->create($request->validated());

        return new CustomerResource($customer);
    }
}
