<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'birthdate',
        'cpf',
        'rg',
        'cellphone',
        'telephone',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id', 'id');
    }
}
