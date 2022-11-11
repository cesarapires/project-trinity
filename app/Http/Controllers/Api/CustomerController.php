<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Service\Customer\Customer as CustomerService;
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

    public function index()
    {
        return $this->customerService->getAll()->getAll();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->customerService->getCreate()->create($request);
    }

    public function show($customer_id): CustomerResource|JsonResponse
    {
        return $this->customerService->getShow()->show($customer_id);
    }

    public function update(UpdateRequest $request, $customer_id): JsonResponse
    {
        return $this->customerService->getUpdate()->update($customer_id, $request);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        return $this->customerService->getDelete()->delete($customer);
    }
}
