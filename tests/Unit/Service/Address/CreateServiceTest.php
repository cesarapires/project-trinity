<?php

namespace Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Requests\Address\StoreRequest;
use App\Models\Address;
use App\Service\Address\CreateService;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;

class CreateServiceTest extends TestCase
{
    private $jsonSuccessCreated = '{"code":"success_created","message":"The address was created successfully!"}';
    private $jsonFailedCreated = '{"code":"failed_created","message":"Could not create a new address!"}';

    public function testShouldSuccessCreateAddress()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('create');

        $createService = new CreateService($mockAddressModel);

        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonSuccessCreated, $response->getContent());
    }

    public function testShouldFailedCreateAddress()
    {
        $mockStoreRequest = Mockery::mock(StoreRequest::class);
        $mockStoreRequest->shouldReceive('all')->andReturnTrue();
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('create')->andThrow(\Exception::class);

        $createService = new CreateService($mockAddressModel);
        $response = $createService->create($mockStoreRequest);
        $this->assertEquals($this->jsonFailedCreated, $response->getContent());
    }
}
