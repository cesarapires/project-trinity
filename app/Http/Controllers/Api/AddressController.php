<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Service\Address\AddressService;
use App\Http\Requests\Address\StoreRequest;
use App\Http\Requests\Address\UpdateRequest;

class AddressController extends Controller
{

    private Address $address;
    private AddressService $addressService;

    public function __construct(Address $address, AddressService $addressService)
    {
        $this->address = $address;
        $this->addressService = $addressService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $this->addressService->getCreateService()->create($request);
    }

    public function show($address_id): AddressResource|JsonResponse
    {
        return $this->addressService->getShowService()->show($address_id);
    }

    public function update($address_id, UpdateRequest $request): JsonResponse
    {
        return $this->addressService->getUpdateService()->update($address_id, $request);
    }

    public function destroy(Address $address): JsonResponse
    {
        return $this->addressService->getDeleteService()->delete($address);
    }
}
