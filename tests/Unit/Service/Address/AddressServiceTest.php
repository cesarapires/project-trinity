<?php

namespace Service\Address;

use App\Service\Address\AddressService;
use App\Service\Address\CreateService;
use App\Service\Address\DeleteService;
use App\Service\Address\ShowService;
use App\Service\Address\UpdateService;
use PHPUnit\Framework\TestCase;
use Mockery;

class AddressServiceTest extends TestCase
{

    public function setUp(): void
    {
        $showService = Mockery::mock(ShowService::class);
        $createService = Mockery::mock(CreateService::class);
        $updateService = Mockery::mock(UpdateService::class);
        $delteService = Mockery::mock(DeleteService::class);


        $this->address = New AddressService(
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
