<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Service\Customer\Customer as CustomerService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(title="Project Trinity", version="0.1")
 */
class CustomerController extends Controller
{
    private Customer $customer;
    private CustomerService $customerService;

    public function __construct(Customer $customer, CustomerService $customerService)
    {
        $this->customer = $customer;
        $this->customerService = $customerService;
    }

    /**
     * @OA\Get(
     *     tags={"Customer"},
     *     path="/api/v1/customers",
     *     description="Get all customers",
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     )
     * )
     */
    public function index()
    {
        return $this->customerService->getAll()->getAll();
    }

    /**
     * @OA\Post(
     *     tags={"Customer"},
     *     path="/api/v1/customers",
     *     description="Store new customer",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded", 
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      ref="#/components/schemas/Customer/properties/name",
     *                  ),
     *                  @OA\Property(
     *                      property="birthdate",
     *                      ref="#/components/schemas/Customer/properties/birthdate",
     *                  ),
     *                  @OA\Property(
     *                      property="cpf",          
     *                      ref="#/components/schemas/Customer/properties/cpf",
     *                  ),
     *                  @OA\Property(
     *                      property="rg",
     *                      ref="#/components/schemas/Customer/properties/rg",
     *                  ),
     *                  @OA\Property(
     *                      property="cellphone",
     *                      ref="#/components/schemas/Customer/properties/cellphone",
     *                  ),
     *                  @OA\Property(
     *                      property="telephone",
     *                      ref="#/components/schemas/Customer/properties/telephone",
     *                  ),
     *                  
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The customer was created successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_created"),
     *            @OA\Property(property="message", type="string", example="The customer was created successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not create a new customer!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_created"),
     *            @OA\Property(property="message", type="string", example="Could not create a new customer!")
     *         ),
     *     )
     * )
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return $this->customerService->getCreate()->create($request);
    }

    /**
     * @OA\Get(
     *     tags={"Customer"},
     *     path="/api/v1/customers/{customer_id}",
     *     description="Get the customer",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Customer/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success: Found Customer.",
     *         @OA\JsonContent(ref="#/components/schemas/Customer"),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Error: Not Found",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="not_found"),
     *            @OA\Property(property="message", type="string", example="Customer {customer_id} not found!")
     *         ),
     *     )
     * )
     */
    public function show($customer_id): CustomerResource|JsonResponse
    {
        return $this->customerService->getShow()->show($customer_id);
    }


        /**
     * @OA\Put(
     *     tags={"Customer"},
     *     path="/api/v1/customers",
     *     description="Update customer",
     *     tags={"Customer"},
     *     path="/api/v1/customers/{customer_id}",
     *     @OA\Parameter(
     *         name="customer_id",
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
     *                      property="name",
     *                      ref="#/components/schemas/Customer/properties/name",
     *                  ),
     *                  @OA\Property(
     *                      property="birthdate",
     *                      ref="#/components/schemas/Customer/properties/birthdate",
     *                  ),
     *                  @OA\Property(
     *                      property="cpf",          
     *                      ref="#/components/schemas/Customer/properties/cpf",
     *                  ),
     *                  @OA\Property(
     *                      property="rg",
     *                      ref="#/components/schemas/Customer/properties/rg",
     *                  ),
     *                  @OA\Property(
     *                      property="cellphone",
     *                      ref="#/components/schemas/Customer/properties/cellphone",
     *                  ),
     *                  @OA\Property(
     *                      property="telephone",
     *                      ref="#/components/schemas/Customer/properties/telephone",
     *                  ),
     *                  
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The customer has been updated successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_updated"),
     *            @OA\Property(property="message", type="string", example="The customer has been updated successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not update a customer!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_updated"),
     *            @OA\Property(property="message", type="string", example="Could not update a customer!")
     *         ),
     *     )
     * )
     */
    public function update(UpdateRequest $request, $customer_id): JsonResponse
    {
        return $this->customerService->getUpdate()->update($customer_id, $request);
    }

    /**
     * @OA\Delete(
     *     tags={"Customer"},
     *     path="/api/v1/customers/{customer_id}",
     *     description="Delete the customer",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Customer/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The customer has been deleted successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_deleted"),
     *            @OA\Property(property="message", type="string", example="The customer has been deleted successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Could not delete a customer!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_deleted"),
     *            @OA\Property(property="message", type="string", example="Could not delete a customer!")
     *         ),
     *     )
     * )
     */
    public function destroy(Customer $customer): JsonResponse
    {
        return $this->customerService->getDelete()->delete($customer);
    }
}
