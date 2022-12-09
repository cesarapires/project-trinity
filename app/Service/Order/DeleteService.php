<?php

namespace App\Service\Order;

use App\Http\Resources\ApiResource;
use App\Models\Order as OrderModel;
use Illuminate\Http\JsonResponse;

class DeleteService
{
    private OrderModel $order;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;
    }

    public function delete(OrderModel $order): JsonResponse
    {
        try{
            $order->delete();
            $apiResponse = $this->setBodyOrderDeleted();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception) {
            $apiResponse = $this->setBodyOrderNotDeleted();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyOrderDeleted(): ApiResource
    {
        return new ApiResource(
            'success_deleted',
            __('messages.order.success_deleted'),
            200
        );
    }

    private function setBodyOrderNotDeleted(): ApiResource
    {
        return new ApiResource(
            'failed_deleted',
            __('messages.order.failed_deleted'),
            417
        );
    }
}
