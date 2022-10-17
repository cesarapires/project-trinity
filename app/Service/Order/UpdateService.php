<?php

namespace App\Service\Order;

use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\ApiResource;
use App\Models\Order as OrderModel;
use Illuminate\Http\JsonResponse;

class UpdateService
{
    private OrderModel $order;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;
    }

    public function update($order_id, UpdateRequest $orderRequest): JsonResponse
    {
        try{
            $this->order = $this->order->findOrFail($order_id);
            $this->order->update($orderRequest->all());
            $apiResponse = $this->setBodyOrderUpdated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyOrderNotUpdated($order_id);
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyOrderUpdated(): ApiResource
    {
        return new ApiResource(
            'success_updated',
            __('messages.order.success_updated'),
            200
        );
    }

    private function setBodyOrderNotUpdated($order_id): ApiResource
    {
        return new ApiResource(
        'failed_updated',
            __('messages.order.not_found', ['orderId' => $order_id]),
            404
        );
    }


}
