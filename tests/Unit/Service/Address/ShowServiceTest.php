<?php

namespace Service\Address;

use App\Models\Address;
use App\Service\Address\ShowService;
use Mockery;
use Tests\TestCase;

class ShowServiceTest extends TestCase
{
    private $jsonFailedShow = '{"code":"not_found","message":"Address 4 not found!"}';
    private $address_id = 4;

    public function testShouldFailedShowAddress()
    {
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('findOrFail')->andThrow(\Exception::class);

        $createService = new ShowService($mockAddressModel);
        $response = $createService->show($this->address_id);
        $this->assertEquals($this->jsonFailedShow, $response->getContent());
    }
}
