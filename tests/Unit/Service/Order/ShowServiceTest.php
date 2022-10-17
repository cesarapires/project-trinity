<?php

namespace Service\Order;

use App\Models\Order;
use App\Service\Order\ShowService;
use Mockery;
use Tests\TestCase;

class ShowServiceTest extends TestCase
{
    private $jsonFailedShow = '{"code":"not_found","message":"Order 4 not found!"}';
    private $order_id = 4;

    public function testShouldFailedShowOrder()
    {
        $mockOrderModel = Mockery::mock(Order::class);
        $mockOrderModel->shouldReceive('findOrFail')->andThrow(\Exception::class);

        $createService = new ShowService($mockOrderModel);
        $response = $createService->show($this->order_id);
        $this->assertEquals($this->jsonFailedShow, $response->getContent());
    }
}
