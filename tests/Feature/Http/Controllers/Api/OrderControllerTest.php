<?php

namespace Http\Controllers\Api;

use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Service\Order\CreateService;
use App\Service\Order\DeleteService;
use App\Service\Order\UpdateService;
use Mockery;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    private $order_id = 1;

    public function testUpdate()
    {
        $updateRequest = [
            "date_order" => "2022-10-16",
            "status" => "O",
            "subtotal_products" => 75.60,
            "discount" => 5.60,
            "addition" => 0,
            "total" => 70.0,
        ];
        $response = $this->call('PUT', '/api/v1/orders/'.$this->order_id, $updateRequest);

        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->order_id]);
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('update');
        $mockOrderModel->shouldReceive('findOrFail')->andReturn($mockOrderModel);

        $updateService = new UpdateService($mockOrderModel);

        $messageExpect = $updateService->update($this->order_id, $mockUpdateRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testShow()
    {
        $response = $this->call('GET', '/api/v1/orders/'.$this->order_id);

        $expets = new OrderResource(Order::find($this->order_id));

        $this->assertEquals($expets->response()->getContent(), $response->getContent());

    }

    public function testStore()
    {
        $createRequest = [
            "date_order" => "2022-10-16",
            "status" => "O",
            "subtotal_products" => 75.60,
            "discount" => 5.60,
            "addition" => 0,
            "total" => 70.0,
        ];
        $response = $this->call('POST', '/api/v1/orders', $createRequest);

        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('create');

        $createService = new CreateService($mockOrderModel);

        $messageExpect = $createService->create($mockStoreRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testDestroy()
    {
        $response = $this->call('DELETE', '/api/v1/orders/'.$this->order_id);

        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('delete');

        $createService = new DeleteService($mockOrderModel);

        $messageExpect = $createService->delete($mockOrderModel);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }
}
