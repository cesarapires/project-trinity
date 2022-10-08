<?php

namespace App\Http\Requests\Address;

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
            'cep' => 'sometimes|string|max:9',
            'address' => 'sometimes|string|max:255',
            'complement' => 'sometimes|string|max:255',
            'number' => 'sometimes|string|max:10',
            'district' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:2',
            'country' => 'sometimes|string|max:255',
            'ibge' => 'sometimes|string|max:7',
            'gia' => 'sometimes|string|max:255',
            'ddd' => 'sometimes|string|max:2',
            'siafi' => 'sometimes|string|max:4',
        ];
    }
}
