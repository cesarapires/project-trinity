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

    public function store(StoreRequest $request)
    {
        return $this->orderService->getCreateService()->create($request);
    }

    public function show($order_id)
    {
        return $this->orderService->getShowService()->show($order_id);
    }

    public function update(UpdateRequest $request, $order_id)
    {
        return $this->orderService->getUpdateService()->update($order_id, $request);
    }

    public function destroy(Order $order_id)
    {
        return $this->orderService->getDeleteService()->delete($order_id);
    }
}
