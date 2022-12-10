<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Service\Customer\Create;
use App\Service\Customer\Delete;
use App\Service\Customer\Update;
use Mockery;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    private $customer_id = 1;

    public function testUpdate()
    {
        $updateRequest = [
            "name" => "Francisco Mário Lopes",
            "birthdate" => "1963-01-17",
            "cpf" => "003.883.371-92",
            "rg" => "22.595.155-1",
            "cellphone" => "(51) 2756-3676",
            "telephone" => "(51) 98746-6584",
        ];
        $response = $this->call('PUT', '/api/v1/customers/'.$this->customer_id, $updateRequest);

        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->customer_id]);
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('update');
        $mockCustomerModel->shouldReceive('findOrFail')->andReturn($mockCustomerModel);

        $updateService = new Update($mockCustomerModel);

        $messageExpect = $updateService->update($this->customer_id, $mockUpdateRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testShow()
    {
        $response = $this->call('GET', '/api/v1/customers/'.$this->customer_id);
        $expets = [
            "data" => [
                "id" => $this->customer_id,
                "name" => "Francisco Mário Lopes",
                "birthdate" => "1963-01-17",
                "cpf" => "003.883.371-92",
                "rg" => "22.595.155-1",
                "cellphone" => "(51) 2756-3676",
                "telephone" => "(51) 98746-6584",
            ],
        ];

        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('findOrFail');
        $response = json_decode($response->content(), true);
        unset($response['data']['addresses']);
        $mockCustomerModel->shouldReceive('findOrFail')->andReturn($expets);

        $this->assertEquals($expets, $response);

    }

    public function testStore()
    {
        $createRequest = [
            "name" => "Francisco Mário Lopes",
            "birthdate" => "1963-01-17",
            "cpf" => "003.883.371-92",
            "rg" => "22.595.155-1",
            "cellphone" => "(51) 2756-3676",
            "telephone" => "(51) 98746-6584",
        ];
        $response = $this->call('POST', '/api/v1/customers', $createRequest);

        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('create');

        $createService = new Create($mockCustomerModel);

        $messageExpect = $createService->create($mockStoreRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testGetAll()
    {
        $response = $this->call('GET', '/api/v1/customers');

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->call('DELETE', '/api/v1/customers/'.$this->customer_id);

        $mockCustomerModel = Mockery::mock(Customer::class);
        $mockCustomerModel->shouldReceive('delete');

        $createService = new Delete($mockCustomerModel);

        $messageExpect = $createService->delete($mockCustomerModel);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }
}
