<?php

namespace Service\Order;

use App\Models\Order;
use App\Service\Order\DeleteService;
use Tests\TestCase;
use Mockery;

class DeleteServiceTest extends TestCase
{
    private $jsonSuccessDeleted = '{"code":"success_deleted","message":"The order has been deleted successfully!"}';
    private $jsonFailedDeleted = '{"code":"failed_deleted","message":"Could not delete a order!"}';

    public function testShouldSuccessDeleteOrder()
    {
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('delete');

        $createService = new DeleteService($mockOrderModel);

        $response = $createService->delete($mockOrderModel);
        $this->assertEquals($this->jsonSuccessDeleted, $response->getContent());
    }

    public function testShouldFailedDeleteOrder()
    {
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('delete')->andThrow(\Exception::class);

        $createService = new DeleteService($mockOrderModel);
        $response = $createService->delete($mockOrderModel);
        $this->assertEquals($this->jsonFailedDeleted, $response->getContent());
    }
}
