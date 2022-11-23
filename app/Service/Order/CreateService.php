<?php

namespace App\Service\Order;

use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\ApiResource;
use App\Models\Order;
use App\Models\Order as OrderModel;
use Illuminate\Http\JsonResponse;

class CreateService
{
    private OrderModel $order;

    public function __construct(OrderModel $order)
    {
        $this->order = $order;
    }


    public function create(StoreRequest $order): JsonResponse
    {
        try{
            $this->order->create($order->all());
            $apiResponse = $this->setBodyOrderCreated();
            return $apiResponse->responseApiMessage();
        } catch (\Exception $exception){
            $apiResponse = $this->setBodyOrderNotCreated();
            return $apiResponse->responseApiMessage();
        }
    }

    private function setBodyOrderCreated(): ApiResource
    {
        return new ApiResource(
            'success_created',
            __('messages.order.success_created'),
            200
        );
    }

    private function setBodyOrderNotCreated(): ApiResource
    {
        return new ApiResource(
            'failed_created',
            __('messages.order.failed_created'),
            417
        );
    }
}
