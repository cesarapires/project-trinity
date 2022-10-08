<?php

namespace Service\Address;

use App\Exceptions\ApiMessages;
use App\Http\Requests\Address\StoreRequest;
use App\Models\Address;
use App\Service\Address\CreateService;
use App\Service\Address\DeleteService;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;
use Mockery\MockInterface;

class DeleteServiceTest extends TestCase
{
    private $jsonSuccessDeleted = '{"code":"success_deleted","message":"The address has been deleted successfully!"}';
    private $jsonFailedDeleted = '{"code":"failed_deleted","message":"Could not delete a address!"}';

    public function testShouldSuccessDeleteAddress()
    {
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('delete');

        $createService = new DeleteService($mockAddressModel);

        $response = $createService->delete($mockAddressModel);
        $this->assertEquals($this->jsonSuccessDeleted, $response->getContent());
    }

    public function testShouldFailedDeleteAddress()
    {
        $mockAddressModel = Mockery::mock(Address::class);
        $mockAddressModel->shouldReceive('delete')->andThrow(\Exception::class);

        $createService = new DeleteService($mockAddressModel);
        $response = $createService->delete($mockAddressModel);
        $this->assertEquals($this->jsonFailedDeleted, $response->getContent());
    }
}
