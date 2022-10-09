<?php

namespace App\Http\Requests\Customer;

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
            'name' => 'required|string|max:255',
            'cpf' => 'sometimes|string|max:14',
            'rg' => 'sometimes|string|max:14',
            'cellphone' => 'sometimes|string|max:16',
            'telephone' => 'sometimes|string|max:16',
        ];
    }
}