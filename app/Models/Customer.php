<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     description="Customer model",
 *     type="object",
 *     title="Customer model"
 * )
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * The unique identifier of a customer.
     *
     * @var int
     *
     * @OA\Property(format="int64", example=1)
     */
    private $id = 'id';

    /**
     * The name of customer.
     *
     * @var string
     *
     * @OA\Property(example="Alisha Muller",maxLength=256)
     */
    private $name = 'name';

    /**
     * The birthdate of customer.
     *
     * @var string
     *
     * @OA\Property(format="date", example="2002-12-08")
     */
    private $birthdate = 'birthdate';

    /**
     * The cpf of customer.
     *
     * @var string
     *
     * @OA\Property(example="943.902.719-38",maxLength=14)
     */
    private $cpf = 'cpf';

    /**
     * The rg of customer.
     *
     * @var string
     *
     * @OA\Property(example="07.485.422-4",maxLength=14)
     */
    private $rg = 'rg';

    /**
     * The cellphone of customer.
     *
     * @var string
     *
     * @OA\Property(example="(28) 96560-8354",maxLength=16)
     */
    private $cellphone = 'cellphone';

    /**
     * The telephone of customer.
     *
     * @var string
     *
     * @OA\Property(example="(28) 96560-8354",maxLength=16)
     */
    private $telephone = 'telephone';

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
