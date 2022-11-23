<?php

namespace App\Service\Customer;

use App\Models\Customer as CustomerModel;
use Illuminate\Http\JsonResponse;

class GetAll
{
    private CustomerModel $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }

    public function getAll()
    {
        return $this->customer->all();
    }

}
