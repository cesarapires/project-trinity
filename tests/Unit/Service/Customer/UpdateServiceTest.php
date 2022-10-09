<?php

namespace Service\Customer;

use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customer;
use App\Service\Customer\UpdateService;
use Mockery;
use Tests\TestCase;

class UpdateServiceTest extends TestCase
{
    private $jsonSuccessUpdated = '{"code":"success_updated","message":"The customer has been updated successfully!"}';
    private $jsonFailedUpdated = '{"code":"failed_updated","message":"Customer 4 not found!"}';
    private $customer_id = 4;

    public function testShouldSuccessUpdateCustomer()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->customer_id]);
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('update');
        $mockCustomerModel->shouldReceive('findOrFail')->andReturn($mockCustomerModel);

        $updateService = new UpdateService($mockCustomerModel);

        $response = $updateService->update($this->customer_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonSuccessUpdated, $response->getContent());
    }

    public function testShouldFailedUpdateCustomer()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturnTrue();
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('update')->andThrow(\Exception::class);

        $updateService = new UpdateService($mockCustomerModel);
        $response = $updateService->update($this->customer_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonFailedUpdated, $response->getContent());
    }
}
