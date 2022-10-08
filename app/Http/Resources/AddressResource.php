<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'cep' => $this->cep,
                'address' => $this->address,
                'complement' => $this->complement,
                'number' => $this->number,
                'district' => $this->district,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'ibge' => $this->ibge,
                'gia' => $this->gia,
                'ddd' => $this->ddd,
                'siafi' => $this->siafi,
            ],
        ];
    }
}
