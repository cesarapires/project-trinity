<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'name' => $this->name,
                'cpf' => $this->cpf,
                'rg' => $this->rg,
                'cellphone' => $this->cellphone,
                'telephone' => $this->telephone,
            ],
        ];
    }
}
