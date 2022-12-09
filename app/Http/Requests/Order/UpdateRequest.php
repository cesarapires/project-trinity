<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'date_order' => 'sometimes|date',
            'status' => 'sometimes|string|max:1',
            'subtotal_products' => 'sometimes|numeric',
            'discount' => 'sometimes|numeric',
            'addition' => 'sometimes|numeric',
            'total' => 'sometimes|numeric',
        ];
    }
}
