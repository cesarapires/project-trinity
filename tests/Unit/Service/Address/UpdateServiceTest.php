<?php

namespace Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Requests\Address\StoreRequest;
use App\Http\Requests\Address\UpdateRequest;
use App\Models\Address;
use App\Service\Address\CreateService;
use App\Service\Address\UpdateService;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;

class UpdateServiceTest extends TestCase
{
    private $jsonSuccessUpdated = '{"code":"success_updated","message":"The address has been updated successfully!"}';
    private $jsonFailedUpdated = '{"code":"failed_updated","message":"Address 4 not found!"}';
    private $address_id = 4;

    public function testShouldSuccessUpdateAddress()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturn(['id' => $this->address_id]);
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('update');
        $mockAddressModel->shouldReceive('findOrFail')->andReturn($mockAddressModel);

        $updateService = new UpdateService($mockAddressModel);

        $response = $updateService->update($this->address_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonSuccessUpdated, $response->getContent());
    }

    public function testShouldFailedUpdateAddress()
    {
        $mockUpdateRequest = Mockery::mock(UpdateRequest::class);
        $mockUpdateRequest->shouldReceive('all')->andReturnTrue();
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('update')->andThrow(\Exception::class);

        $updateService = new UpdateService($mockAddressModel);
        $response = $updateService->update($this->address_id, $mockUpdateRequest);
        $this->assertEquals($this->jsonFailedUpdated, $response->getContent());
    }
}
