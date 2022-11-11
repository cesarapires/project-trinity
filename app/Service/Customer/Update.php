<?php

namespace App\Service\Customer;

use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\ApiResource;
use App\Models\Customer as CustomerModel;
use Illuminate\Http\JsonResponse;

class Update
{
    private CustomerModel $customer;

    public function __construct(CustomerModel $customer)
    {
        $this->customer = $customer;
    }

    public function update($customer_id, UpdateRequest $customerRequest): JsonResponse
    {
        try{
            $this->customer = $this->customer->findOrFail($customer_id);
            $this->customer->update($customerRequest->all());
            $apiResponse = $this->setBodyCustomerUpdated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyCustomerNotUpdated($customer_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyCustomerUpdated(): ApiResource
    {
        return new ApiResource(
            'success_updated',
            __('messages.customer.success_updated'),
            200
        );
    }

    private function setBodyCustomerNotUpdated($customer_id): ApiResource
    {
        return new ApiResource(
        'failed_updated',
            __('messages.customer.not_found', ['customerId' => $customer_id]),
            404
        );
    }


}
