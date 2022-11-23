<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_order' => 'required|date',
            'status' => 'required|string|max:1',
            'subtotal_products' => 'required|numeric',
            'discount' => 'required|numeric',
            'addition' => 'required|numeric',
            'total' => 'required|numeric',
        ];
    }
}
