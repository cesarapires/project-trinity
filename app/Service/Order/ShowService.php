<?php

namespace App\Service\Order;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ApiResource;
use App\Models\Order as OrderModel;
use Illuminate\Http\JsonResponse;

class ShowService
{
    private OrderModel $order;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;
    }


    public function show($order_id): OrderResource|JsonResponse
    {
        try{
            $this->order = $this->order->findOrFail($order_id);
            return new OrderResource($this->order);
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyOrderNotFound($order_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyOrderNotFound($order_id): ApiResource
    {
        return new ApiResource(
            'not_found',
            __('messages.order.not_found', ['orderId' => $order_id]),
            404
        );
    }
}
