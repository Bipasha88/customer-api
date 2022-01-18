<?php

namespace App\Services\Customer;

interface ICustomerService{
    public function getCustomers();
    public function getCustomerById($id);
}
