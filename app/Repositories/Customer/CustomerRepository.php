<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Base\BaseRepository;

class CustomerRepository extends BaseRepository implements ICustomerRepository{

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}
