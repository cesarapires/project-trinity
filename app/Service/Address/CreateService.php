<?php

namespace App\Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Requests\Address\StoreRequest;
use App\Http\Resources\ApiResource;
use App\Models\Address;
use App\Models\Address as AddressModel;
use Illuminate\Http\JsonResponse;

class CreateService
{
    private AddressModel $address;

    public function __construct(AddressModel $address)
    {
        $this->address = $address;
    }


    public function create(StoreRequest $address): JsonResponse
    {
        try{
            $this->address->create($address->all());
            $apiResponse = $this->setBodyAddressCreated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyAddressNotCreated();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyAddressCreated(): ApiResource
    {
        return new ApiResource(
            'success_created',
            __('messages.address.success_created'),
            200
        );
    }

    private function setBodyAddressNotCreated(): ApiResource
    {
        return new ApiResource(
            'failed_created',
            __('messages.address.failed_created'),
            417
        );
    }
}
