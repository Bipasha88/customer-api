<?php

namespace App\Services\Customer;

use App\Repositories\Customer\ICustomerRepository;

class CustomerServices implements ICustomerService
{

    private $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers(){
        return $this->customerRepository->all();
    }

    public function getCustomerById($id){
        return $this->customerRepository->getById($id);
    }
}
