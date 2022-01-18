<?php

namespace App\Http\Controllers;

use App\Services\Customer\ICustomerService;
use Illuminate\Http\Request;

class CustomersController
{
    private $customerService;

    public function  __construct(ICustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getCustomers();
        return response()->json($customers);
    }

    public function show($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        return response()->json($customer);
    }
}
