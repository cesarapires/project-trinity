<?php

namespace App\Http\Requests\Customer;

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
            'name' => 'sometimes|string|max:255',
            'birthdate' => 'sometimes|date',
            'cpf' => 'sometimes|string|max:14',
            'rg' => 'sometimes|string|max:14',
            'cellphone' => 'sometimes|string|max:16',
            'telephone' => 'sometimes|string|max:16',
        ];
    }
}
