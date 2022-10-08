<?php

namespace App\Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Requests\Address\UpdateRequest;
use App\Http\Resources\ApiResource;
use App\Models\Address;
use App\Models\Address as AddressModel;
use Illuminate\Http\JsonResponse;

class UpdateService
{
    private AddressModel $address;

    public function __construct(AddressModel $address)
    {
        $this->address = $address;
    }

    public function update($address_id, UpdateRequest $addressRequest): JsonResponse
    {
        try{
            $this->address = $this->address->findOrFail($address_id);
            $this->address->update($addressRequest->all());
            $apiResponse = $this->setBodyAddressUpdated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyAddressNotUpdated($address_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyAddressUpdated(): ApiResource
    {
        return new ApiResource(
            'success_updated',
            __('messages.address.success_updated'),
            200
        );
    }

    private function setBodyAddressNotUpdated($address_id): ApiResource
    {
        return new ApiResource(
        'failed_updated',
            __('messages.address.not_found', ['addressId' => $address_id]),
            404
        );
    }


}
