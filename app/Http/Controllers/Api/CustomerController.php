<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Service\Customer\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private Customer $customer;
    private CustomerService $customerService;

    public function __construct(Customer $customer, CustomerService $customerService)
    {
        $this->customer = $customer;
        $this->customerService = $customerService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->customerService->getCreateService()->create($request);
    }

    public function show($customer_id): CustomerResource|JsonResponse
    {
        return $this->customerService->getShowService()->show($customer_id);
    }

    public function update(UpdateRequest $request, $customer_id): JsonResponse
    {
        return $this->customerService->getUpdateService()->update($customer_id, $request);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        return $this->customerService->getDeleteService()->delete($customer);
    }
}
