<?php

namespace Service\Customer;

use App\Service\Customer\CreateService;
use App\Service\Customer\CustomerService;
use App\Service\Customer\DeleteService;
use App\Service\Customer\ShowService;
use App\Service\Customer\UpdateService;
use PHPUnit\Framework\TestCase;
use Mockery;

class CustomerServiceTest extends TestCase
{

    public function setUp(): void
    {
        $showService = Mockery::mock(ShowService::class);
        $createService = Mockery::mock(CreateService::class);
        $updateService = Mockery::mock(UpdateService::class);
        $delteService = Mockery::mock(DeleteService::class);


        $this->address = New CustomerService(
            $showService,
            $createService,
            $updateService,
            $delteService
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
