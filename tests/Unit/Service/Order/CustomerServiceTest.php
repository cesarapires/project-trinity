<?php

namespace Service\Order;

use App\Service\Order\CreateService;
use App\Service\Order\OrderService;
use App\Service\Order\DeleteService;
use App\Service\Order\ShowService;
use App\Service\Order\UpdateService;
use PHPUnit\Framework\TestCase;
use Mockery;

class OrderServiceTest extends TestCase
{

    public function setUp(): void
    {
        $showService = Mockery::mock(ShowService::class);
        $createService = Mockery::mock(CreateService::class);
        $updateService = Mockery::mock(UpdateService::class);
        $deleteService = Mockery::mock(DeleteService::class);


        $this->address = New OrderService(
            $showService,
            $createService,
            $updateService,
            $deleteService
        );
    }

    public function testGetCreateService()
    {
        $this->assertInstanceOf(CreateService::class, $this->address->getCreateService());
    }

    public function testGetDeleteService()
    {
        $this->assertInstanceOf(DeleteService::class, $this->address->getDeleteService());
    }

    public function testGetShowService()
    {
        $this->assertInstanceOf(ShowService::class, $this->address->getShowService());
    }

    public function testGetUpdateService()
    {
        $this->assertInstanceOf(UpdateService::class, $this->address->getUpdateService());
    }
}
