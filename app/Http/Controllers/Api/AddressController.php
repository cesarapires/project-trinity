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

    /**
     * @OA\Post(
     *     tags={"Address"},
     *     path="/api/v1/addresses",
     *     description="Store new address",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded", 
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="cep",
     *                      ref="#/components/schemas/Address/properties/cep",
     *                  ),
     *                  @OA\Property(
     *                      property="address",
     *                      ref="#/components/schemas/Address/properties/address",
     *                  ),
     *                  @OA\Property(
     *                      property="complement",          
     *                      ref="#/components/schemas/Address/properties/complement",
     *                  ),
     *                  @OA\Property(
     *                      property="number",
     *                      ref="#/components/schemas/Address/properties/number",
     *                  ),
     *                  @OA\Property(
     *                      property="district",
     *                      ref="#/components/schemas/Address/properties/district",
     *                  ),
     *                  @OA\Property(
     *                      property="city",
     *                      ref="#/components/schemas/Address/properties/city",
     *                  ),
     *                  @OA\Property(
     *                      property="state",
     *                      ref="#/components/schemas/Address/properties/state",
     *                  ),
     *                  @OA\Property(
     *                      property="ibge",
     *                      ref="#/components/schemas/Address/properties/ibge",
     *                  ),
     *                  @OA\Property(
     *                      property="gia",
     *                      ref="#/components/schemas/Address/properties/gia",
     *                  ),
     *                  @OA\Property(
     *                      property="ddd",
     *                      ref="#/components/schemas/Address/properties/ddd",
     *                  ),
     *                  @OA\Property(
     *                      property="siafi",
     *                      ref="#/components/schemas/Address/properties/siafi",
     *                  ),          
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The address was created successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_created"),
     *            @OA\Property(property="message", type="string", example="The address was created successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not create a new address!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_created"),
     *            @OA\Property(property="message", type="string", example="Could not create a new address!")
     *         ),
     *     )
     * )
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return $this->addressService->getCreateService()->create($request);
    }

    /**
     * @OA\Get(
     *     tags={"Address"},
     *     path="/api/v1/addresses/{address_id}",
     *     description="Get the address",
     *     @OA\Parameter(
     *         name="address_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Address/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success: Found Address.",
     *         @OA\JsonContent(ref="#/components/schemas/Address"),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Error: Not Found",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="not_found"),
     *            @OA\Property(property="message", type="string", example="Address {address_id} not found!")
     *         ),
     *     )
     * )
     */
    public function show($address_id): AddressResource|JsonResponse
    {
        return $this->addressService->getShowService()->show($address_id);
    }
    /**
     * @OA\Put(
     *     tags={"Address"},
     *     description="Update customer",
     *     path="/api/v1/addresses/{addres_id}",
     *     @OA\Parameter(
     *         name="addres_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Customer/properties/id")
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded", 
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="cep",
     *                      ref="#/components/schemas/Address/properties/cep",
     *                  ),
     *                  @OA\Property(
     *                      property="address",
     *                      ref="#/components/schemas/Address/properties/address",
     *                  ),
     *                  @OA\Property(
     *                      property="complement",          
     *                      ref="#/components/schemas/Address/properties/complement",
     *                  ),
     *                  @OA\Property(
     *                      property="number",
     *                      ref="#/components/schemas/Address/properties/number",
     *                  ),
     *                  @OA\Property(
     *                      property="district",
     *                      ref="#/components/schemas/Address/properties/district",
     *                  ),
     *                  @OA\Property(
     *                      property="city",
     *                      ref="#/components/schemas/Address/properties/city",
     *                  ),
     *                  @OA\Property(
     *                      property="state",
     *                      ref="#/components/schemas/Address/properties/state",
     *                  ),
     *                  @OA\Property(
     *                      property="ibge",
     *                      ref="#/components/schemas/Address/properties/ibge",
     *                  ),
     *                  @OA\Property(
     *                      property="gia",
     *                      ref="#/components/schemas/Address/properties/gia",
     *                  ),
     *                  @OA\Property(
     *                      property="ddd",
     *                      ref="#/components/schemas/Address/properties/ddd",
     *                  ),
     *                  @OA\Property(
     *                      property="siafi",
     *                      ref="#/components/schemas/Address/properties/siafi",
     *                  ),          
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The address has been updated successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_updated"),
     *            @OA\Property(property="message", type="string", example="The address has been updated successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not update a address!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_updated"),
     *            @OA\Property(property="message", type="string", example="Could not update a address!")
     *         ),
     *     )
     * )
     */
    public function update($address_id, UpdateRequest $request): JsonResponse
    {
        return $this->addressService->getUpdateService()->update($address_id, $request);
    }

    /**
     * @OA\Delete(
     *     tags={"Address"},
     *     path="/api/v1/addresses/{address_id}",
     *     description="Delete the address",
     *     @OA\Parameter(
     *         name="address_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Address/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The address has been deleted successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_deleted"),
     *            @OA\Property(property="message", type="string", example="The address has been deleted successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Could not delete a address!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_deleted"),
     *            @OA\Property(property="message", type="string", example="Could not delete a address!")
     *         ),
     *     )
     * )
     */
    public function destroy(Address $address): JsonResponse
    {
        return $this->addressService->getDeleteService()->delete($address);
    }
}
