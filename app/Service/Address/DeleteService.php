<?php

namespace App\Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Resources\ApiResource;
use App\Models\Address;
use App\Models\Address as AddressModel;
use Illuminate\Http\JsonResponse;

class DeleteService
{
    private AddressModel $address;

    public function __construct(AddressModel $address)
    {
        $this->address = $address;
    }

    public function delete(AddressModel $address): JsonResponse
    {
        try{
            $address->delete();
            $apiResponse = $this->setBodyAddressDeleted();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception) {
            $apiResponse = $this->setBodyAddressNotDeleted();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyAddressDeleted(): ApiResource
    {
        return new ApiResource(
            'success_deleted',
            __('messages.address.success_deleted'),
            200
        );
    }

    private function setBodyAddressNotDeleted(): ApiResource
    {
        return new ApiResource(
            'failed_deleted',
            __('messages.address.failed_deleted'),
            417
        );
    }
}
