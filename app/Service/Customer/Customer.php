<?php

namespace App\Service\Customer;


class Customer
{
    private Show $show;
    private Create $create;
    private Update $update;
    private Delete $delete;
    private GetAll $getAll;

    /**
     * @param Show $show
     * @param Create $create
     * @param Update $update
     * @param Delete $delete
     * @param GetAll $getAll
     */
    public function __construct(Show $show, Create $create, Update $update, Delete $delete, GetAll $getAll)
    {
        $this->show = $show;
        $this->create = $create;
        $this->update = $update;
        $this->delete = $delete;
        $this->getAll = $getAll;
    }

    public function getAll(): GetAll
    {
        return $this->getAll;
    }

    public function getShow(): Show
    {
        return $this->show;
    }

    public function getCreate(): Create
    {
        return $this->create;
    }

    public function getUpdate(): Update
    {
        return $this->update;
    }

    public function getDelete(): Delete
    {
        return $this->delete;
    }



}
