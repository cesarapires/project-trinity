<?php

namespace Service\Order;

use App\Http\Requests\Order\StoreRequest;
use App\Models\Order;
use App\Service\Order\CreateService;
use Mockery;
use Tests\TestCase;

class CreateServiceTest extends TestCase
{
    private $jsonSuccessCreated = '{"code":"success_created","message":"The order was created successfully!"}';
    private $jsonFailedCreated = '{"code":"failed_created","message":"Could not create a new order!"}';

    public function testShouldSuccessCreateOrder()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('create');

        $createService = new CreateService($mockOrderModel);

        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonSuccessCreated, $response->getContent());
    }

    public function testShouldFailedCreateOrder()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('create')->andThrow(\Exception::class);

        $createService = new CreateService($mockOrderModel);
        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonFailedCreated, $response->getContent());
    }
}
