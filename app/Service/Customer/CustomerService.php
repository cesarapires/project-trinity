<?php

namespace App\Service\Customer;


class CustomerService
{
    private ShowService $showService;
    private CreateService $createService;
    private UpdateService $updateService;
    private DeleteService $deleteService;

    public function __construct(ShowService $showService, CreateService $createService, UpdateService $updateService, DeleteService $deleteService)
    {
        $this->showService = $showService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
    }

    public function getShowService(): ShowService
    {
        return $this->showService;
    }

    public function getCreateService(): CreateService
    {
        return $this->createService;
    }

    public function getUpdateService(): UpdateService
    {
        return $this->updateService;
    }

    public function getDeleteService(): DeleteService
    {
        return $this->deleteService;
    }



}
