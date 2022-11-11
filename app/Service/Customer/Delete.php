<?php

namespace App\Service\Customer;

use App\Http\Resources\ApiResource;
use App\Models\Customer as CustomerModel;
use Illuminate\Http\JsonResponse;

class Delete
{
    private CustomerModel $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }

    public function delete(CustomerModel $customer): JsonResponse
    {
        try{
            $customer->delete();
            $apiResponse = $this->setBodyCustomerDeleted();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception) {
            $apiResponse = $this->setBodyCustomerNotDeleted();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyCustomerDeleted(): ApiResource
    {
        return new ApiResource(
            'success_deleted',
            __('messages.customer.success_deleted'),
            200
        );
    }

    private function setBodyCustomerNotDeleted(): ApiResource
    {
        return new ApiResource(
            'failed_deleted',
            __('messages.customer.failed_deleted'),
            417
        );
    }
}
