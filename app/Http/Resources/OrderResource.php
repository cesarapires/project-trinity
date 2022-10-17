<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'date_order' => $this->date_order,
                'status' => $this->status,
                'subtotal_products' => $this->subtotal_products,
                'discount' => $this->discount,
                'addition' => $this->addition,
                'total' => $this->total,
            ]
        ];
    }
}
