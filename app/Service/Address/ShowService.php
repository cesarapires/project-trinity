<?php

namespace App\Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Resources\AddressResource;
use App\Http\Resources\ApiResource;
use App\Models\Address;
use App\Models\Address as AddressModel;
use Illuminate\Http\JsonResponse;

class ShowService
{
    private AddressModel $address;

    public function __construct(AddressModel $address)
    {
        $this->address = $address;
    }


    public function show($address_id): AddressResource|JsonResponse
    {
        try{
            $this->address = $this->address->findOrFail($address_id);
            return new AddressResource($this->address);
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyAddressNotFound($address_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyAddressNotFound($address_id): ApiResource
    {
        return new ApiResource(
            'not_found',
            __('messages.address.not_found', ['addressId' => $address_id]),
            404
        );
    }
}
