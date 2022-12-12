<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;
use App\Service\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private Order $order;
    private OrderService $orderService;

    /**
     * @param Order $order
     * @param OrderService $orderService
     */
    public function __construct(Order $order, OrderService $orderService)
    {
        $this->order = $order;
        $this->orderService = $orderService;
    }

    /**
     * @OA\Post(
     *     tags={"Order"},
     *     path="/api/v1/orders",
     *     description="Store new order",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded", 
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="date_order",
     *                      ref="#/components/schemas/Order/properties/date_order",
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      ref="#/components/schemas/Order/properties/status",
     *                  ),
     *                  @OA\Property(
     *                      property="subtotal_products",          
     *                      ref="#/components/schemas/Order/properties/subtotal_products",
     *                  ),
     *                  @OA\Property(
     *                      property="discount",
     *                      ref="#/components/schemas/Order/properties/discount",
     *                  ),
     *                  @OA\Property(
     *                      property="addition",
     *                      ref="#/components/schemas/Order/properties/addition",
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      ref="#/components/schemas/Order/properties/total",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The order was created successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_created"),
     *            @OA\Property(property="message", type="string", example="The order was created successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not create a new order!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_created"),
     *            @OA\Property(property="message", type="string", example="Could not create a new order!")
     *         ),
     *     )
     * )
     */
    public function store(StoreRequest $request)
    {
        return $this->orderService->getCreateService()->create($request);
    }

    /**
     * @OA\Get(
     *     tags={"Order"},
     *     path="/api/v1/orders/{order_id}",
     *     description="Get the order",
     *     @OA\Parameter(
     *         name="order_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Order/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success: Found Order.",
     *         @OA\JsonContent(ref="#/components/schemas/Order"),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Error: Not Found",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="not_found"),
     *            @OA\Property(property="message", type="string", example="Order {order_id} not found!")
     *         ),
     *     )
     * )
     */
    public function show($order_id)
    {
        return $this->orderService->getShowService()->show($order_id);
    }

    /**
     * @OA\Put(
     *     tags={"Order"},
     *     path="/api/v1/orders",
     *     description="Update order",
     *     tags={"Order"},
     *     path="/api/v1/orders/{order_id}",
     *     @OA\Parameter(
     *         name="order_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Order/properties/id")
     *     ),
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded", 
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="date_order",
     *                      ref="#/components/schemas/Order/properties/date_order",
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      ref="#/components/schemas/Order/properties/status",
     *                  ),
     *                  @OA\Property(
     *                      property="subtotal_products",          
     *                      ref="#/components/schemas/Order/properties/subtotal_products",
     *                  ),
     *                  @OA\Property(
     *                      property="discount",
     *                      ref="#/components/schemas/Order/properties/discount",
     *                  ),
     *                  @OA\Property(
     *                      property="addition",
     *                      ref="#/components/schemas/Order/properties/addition",
     *                  ),
     *                  @OA\Property(
     *                      property="total",
     *                      ref="#/components/schemas/Order/properties/total",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The order has been updated successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_updated"),
     *            @OA\Property(property="message", type="string", example="The order has been updated successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="417",
     *         description="Could not update a order!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_updated"),
     *            @OA\Property(property="message", type="string", example="Could not update a order!")
     *         ),
     *     )
     * )
     */
    public function update(UpdateRequest $request, $order_id)
    {
        return $this->orderService->getUpdateService()->update($order_id, $request);
    }
    
    /**
     * @OA\Delete(
     *     tags={"Order"},
     *     path="/api/v1/orders/{order_id}",
     *     description="Delete the order",
     *     @OA\Parameter(
     *         name="order_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(ref="#/components/schemas/Order/properties/id")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="The order has been deleted successfully!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="success_deleted"),
     *            @OA\Property(property="message", type="string", example="The order has been deleted successfully!")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Could not delete a order!",
     *         @OA\JsonContent(
     *            @OA\Property(property="code", type="string", example="failed_deleted"),
     *            @OA\Property(property="message", type="string", example="Could not delete a order!")
     *         ),
     *     )
     * )
     */
    public function destroy(Order $order_id)
    {
        return $this->orderService->getDeleteService()->delete($order_id);
    }
}
