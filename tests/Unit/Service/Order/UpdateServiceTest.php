<?php

namespace Service\Order;

use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;
use App\Service\Order\UpdateService;
use Mockery;
use Tests\TestCase;

class UpdateServiceTest extends TestCase
{
    private $jsonSuccessUpdated = '{"code":"success_updated","message":"The order has been updated successfully!"}';
    private $jsonFailedUpdated = '{"code":"failed_updated","message":"Order 4 not found!"}';
    private $order_id = 4;

    public function testShouldSuccessUpdateOrder()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->order_id]);
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('update');
        $mockOrderModel->shouldReceive('findOrFail')->andReturn($mockOrderModel);

        $updateService = new UpdateService($mockOrderModel);

        $response = $updateService->update($this->order_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonSuccessUpdated, $response->getContent());
    }

    public function testShouldFailedUpdateOrder()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturnTrue();
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('update')->andThrow(\Exception::class);

        $updateService = new UpdateService($mockOrderModel);
        $response = $updateService->update($this->order_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonFailedUpdated, $response->getContent());
    }
}
