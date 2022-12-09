<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'cpf' => $this->cpf,
                'rg' => $this->rg,
                'birthdate' => $this->birthdate,
                'cellphone' => $this->cellphone,
                'telephone' => $this->telephone,
                'addresses' => $this->addresses,
            ],
        ];
    }
}
