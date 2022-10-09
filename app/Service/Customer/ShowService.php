<?php

namespace App\Service\Customer;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\ApiResource;
use App\Models\Customer as CustomerModel;
use Illuminate\Http\JsonResponse;

class ShowService
{
    private CustomerModel $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }


    public function show($customer_id): CustomerResource|JsonResponse
    {
        try{
            $this->customer = $this->customer->findOrFail($customer_id);
            return new CustomerResource($this->customer);
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyCustomerNotFound($customer_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyCustomerNotFound($customer_id): ApiResource
    {
        return new ApiResource(
            'not_found',
            __('messages.customer.not_found', ['customerId' => $customer_id]),
            404
        );
    }
}
