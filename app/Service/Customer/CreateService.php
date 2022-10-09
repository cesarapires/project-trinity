<?php

namespace App\Service\Customer;

use App\Http\Requests\Customer\StoreRequest;
use App\Http\Resources\ApiResource;
use App\Models\Customer as CustomerModel;
use Illuminate\Http\JsonResponse;

class CreateService
{
    private CustomerModel $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }


    public function create(StoreRequest $customer): JsonResponse
    {
        try{
            $this->customer->create($customer->all());
            $apiResponse = $this->setBodyCustomerCreated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyCustomerNotCreated();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyCustomerCreated(): ApiResource
    {
        return new ApiResource(
            'success_created',
            __('messages.customer.success_created'),
            200
        );
    }

    private function setBodyCustomerNotCreated(): ApiResource
    {
        return new ApiResource(
            'failed_created',
            __('messages.customer.failed_created'),
            417
        );
    }
}
