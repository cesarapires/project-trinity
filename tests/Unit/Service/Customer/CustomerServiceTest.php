<?php

namespace Service\Customer;

use App\Service\Customer\Create;
use App\Service\Customer\Customer;
use App\Service\Customer\Delete;
use App\Service\Customer\GetAll;
use App\Service\Customer\Show;
use App\Service\Customer\Update;
use PHPUnit\Framework\TestCase;
use Mockery;

class CustomerServiceTest extends TestCase
{

    public function setUp(): void
    {
        $showService = Mockery::mock(Show::class);
        $createService = Mockery::mock(Create::class);
        $updateService = Mockery::mock(Update::class);
        $deleteService = Mockery::mock(Delete::class);
        $getAllService = Mockery::mock(GetAll::class);


        $this->address = New Customer(
            $showService,
            $createService,
            $updateService,
            $deleteService,
            $getAllService
        );
    }

    public function testGetCreateService()
    {
        $this->assertInstanceOf(Create::class, $this->address->getCreate());
    }

    public function testGetDeleteService()
    {
        $this->assertInstanceOf(Delete::class, $this->address->getDelete());
    }

    public function testGetShowService()
    {
        $this->assertInstanceOf(Show::class, $this->address->getShow());
    }

    public function testGetUpdateService()
    {
        $this->assertInstanceOf(Update::class, $this->address->getUpdate());
    }
}
