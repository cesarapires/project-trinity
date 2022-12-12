<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     description="Order model",
 *     type="object",
 *     title="Order model"
 * )
 */
class Order extends Model
{
    use HasFactory;

    /**
     * The unique identifier of a order.
     *
     * @var int
     *
     * @OA\Property(format="int64", example=1)
     */
    private $id;

    /**
     * The date of order.
     *
     * @var string
     *
     * @OA\Property(format="date", example="2002-12-08")
     */
    private $date_order;

    /**
     * The status of order.
     *
     * @var string
     *
     * @OA\Property(example="O",maxLength=14)
     */
    private $status;

    /**
     * The status of order.
     *
     * @var float
     *
     * @OA\Property(example="14.56",maxLength=14)
     */
    private $subtotal_products;

    /**
     * The discount of order.
     *
     * @var float
     *
     * @OA\Property(example="1",maxLength=14)
     */
    private $discount;

    /**
     * The addition of order.
     *
     * @var float
     *
     * @OA\Property(example="5.46",maxLength=14)
     */
    private $addition;

    /**
     * The total of order.
     *
     * @var float
     *
     * @OA\Property(example="19.00",maxLength=14)
     */
    private $total;

    protected $fillable = [
        'date_order',
        'status',
        'subtotal_products',
        'discount',
        'addition',
        'total',
    ];
}
