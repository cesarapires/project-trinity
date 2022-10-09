<?php

namespace Service\Customer;

use App\Models\Customer;
use App\Service\Customer\DeleteService;
use Tests\TestCase;
use Mockery;

class DeleteServiceTest extends TestCase
{
    private $jsonSuccessDeleted = '{"code":"success_deleted","message":"The customer has been deleted successfully!"}';
    private $jsonFailedDeleted = '{"code":"failed_deleted","message":"Could not delete a customer!"}';

    public function testShouldSuccessDeleteCustomer()
    {
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('delete');

        $createService = new DeleteService($mockCustomerModel);

        $response = $createService->delete($mockCustomerModel);
        $this->assertEquals($this->jsonSuccessDeleted, $response->getContent());
    }

    public function testShouldFailedDeleteCustomer()
    {
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('delete')->andThrow(\Exception::class);

        $createService = new DeleteService($mockCustomerModel);
        $response = $createService->delete($mockCustomerModel);
        $this->assertEquals($this->jsonFailedDeleted, $response->getContent());
    }
}
