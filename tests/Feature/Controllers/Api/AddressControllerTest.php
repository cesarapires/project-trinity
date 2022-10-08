<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Api\AddressController;
use App\Http\Requests\Address\StoreRequest;
use App\Http\Requests\Address\UpdateRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Service\Address\CreateService;
use App\Service\Address\DeleteService;
use App\Service\Address\UpdateService;
use Mockery;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    private $address_id = 1;

    public function testUpdate()
    {
        $updateRequest = [
            "cep" => "37200-200",
            "address" => "Bernadino Macieira",
            "number" => "144",
            "district" => "Centro",
            "city" => "Lavras",
        ];
        $response = $this->call('PUT', '/api/v1/addresses/'.$this->address_id, $updateRequest);

        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->address_id]);
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('update');
        $mockAddressModel->shouldReceive('findOrFail')->andReturn($mockAddressModel);

        $updateService = new UpdateService($mockAddressModel);

        $messageExpect = $updateService->update($this->address_id, $mockUpdateRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testShow()
    {
        $response = $this->call('GET', '/api/v1/addresses/'.$this->address_id);

        $expets = new AddressResource(Address::find($this->address_id));

        $this->assertEquals($expets->response()->getContent(), $response->getContent());

    }

    public function testStore()
    {
        $createRequest = [
            "cep" => "37200-200",
            "address" => "Bernadino Macieira",
            "number" => "144",
            "district" => "Centro",
            "city" => "Lavras",
        ];
        $response = $this->call('POST', '/api/v1/addresses', $createRequest);

        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('create');

        $createService = new CreateService($mockAddressModel);

        $messageExpect = $createService->create($mockStoreRequest);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }

    public function testDestroy()
    {
        $response = $this->call('DELETE', '/api/v1/addresses/'.$this->address_id);

        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('delete');

        $createService = new DeleteService($mockAddressModel);

        $messageExpect = $createService->delete($mockAddressModel);

        $this->assertEquals($messageExpect->getContent(), $response->getContent());
    }
}
