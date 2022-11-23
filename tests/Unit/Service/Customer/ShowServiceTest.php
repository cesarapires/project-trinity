<?php

namespace Service\Customer;

use App\Models\Customer;
use App\Service\Customer\Show;
use Mockery;
use Tests\TestCase;

class ShowServiceTest extends TestCase
{
    private $jsonFailedShow = '{"code":"not_found","message":"Customer 4 not found!"}';
    private $customer_id = 4;

    public function testShouldFailedShowCustomer()
    {
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('findOrFail')->andThrow(\Exception::class);

        $createService = new Show($mockCustomerModel);
        $response = $createService->show($this->customer_id);
        $this->assertEquals($this->jsonFailedShow, $response->getContent());
    }
}
