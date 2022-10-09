<?php

namespace Service\Customer;

use App\Http\Requests\Customer\StoreRequest;
use App\Models\Customer;
use App\Service\Customer\CreateService;
use Mockery;
use Tests\TestCase;

class CreateServiceTest extends TestCase
{
    private $jsonSuccessCreated = '{"code":"success_created","message":"The customer was created successfully!"}';
    private $jsonFailedCreated = '{"code":"failed_created","message":"Could not create a new customer!"}';

    public function testShouldSuccessCreateCustomer()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('create');

        $createService = new CreateService($mockCustomerModel);

        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonSuccessCreated, $response->getContent());
    }

    public function testShouldFailedCreateCustomer()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('create')->andThrow(\Exception::class);

        $createService = new CreateService($mockCustomerModel);
        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonFailedCreated, $response->getContent());
    }
}
