<?php

namespace App\Http\Requests\Address;

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
            'cep' => 'required|string|max:9',
            'address' => 'required|string|max:255',
            'complement' => 'sometimes|string|max:255',
            'number' => 'required|string|max:10',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'sometimes|string|max:2',
            'country' => 'sometimes|string|max:255',
            'ibge' => 'sometimes|string|max:7',
            'gia' => 'sometimes|string|max:255',
            'ddd' => 'sometimes|string|max:2',
            'siafi' => 'sometimes|string|max:4',
        ];
    }
}
