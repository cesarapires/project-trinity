<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     description="Address model",
 *     type="object",
 *     title="Address model"
 * )
 */
class Address extends Model
{
    use HasFactory;

    /**
     * The unique identifier of a address.
     *
     * @var int
     *
     * @OA\Property(format="int64", example=1)
     */
    private $id;

    /**
     * The Zip address code.
     *
     * @var string
     *
     * @OA\Property(example="75352-805", maxLength=9)
     */
    private $cep;

    /**
     * The address.
     *
     * @var string
     *
     * @OA\Property(example="Darlene Land", maxLength=256)
     */
    private $address;

    /**
     * The complement of address (Apartament, Condomain name)
     *
     * @var string
     *
     * @OA\Property(example="Expedita dicta sit.", maxLength=256)
     */
    private $complement;

    /**
     * The number of address
     *
     * @var string
     *
     * @OA\Property(example="256", maxLength=6)
     */  
    private $number;

    /**
     * The name of district
     *
     * @var string
     *
     * @OA\Property(example="Sunsari", maxLength=256)
     */  
    private $district;

    /**
     * The name of city
     *
     * @var string
     *
     * @OA\Property(example="East Rodrickfort", maxLength=256)
     */ 
    private $city;

    /**
     * The name of state
     *
     * @var string
     *
     * @OA\Property(example="SD", maxLength=256)
     */   
    private $state;

    /**
     * The name of country
     *
     * @var string
     *
     * @OA\Property(example="Cote d'Ivoire", maxLength=256)
     */  
    private $country;

    /**
     * The municipality code is composed of 7 numeric digits, with 
     * the first two representing the Federal Union. Inform the 
     * code 9999999 and the name of the municipality “EXTERIOR” 
     * for operations involving locations abroad.
     *
     * @var string
     * 
     * @OA\Property(example="826059", maxLength=256)
     */  
    private $ibge;

    /**
     * The GIA, ICMS Information and Calculation Guide, is the instrument
     * by which the taxpayer registered and obliged to book tax books must 
     * declare, within the regulatory period, the economic-fiscal information,
     * according to the tax calculation regime to which he is subject. 
     * or according to the operations or installments carried out in the period.
     *
     * @var string

     * @OA\Property(example="null", maxLength=256)
     */  
    private $gia;

    /**
     * DDD stands for Direct Distance Dial. It is an automatic telephone connection
     * system between different national urban areas. The DDD is a code consisting 
     * of 2 digits that identify the main cities in the country and must be added to 
     * the telephone number, along with the operator code.
     *
     * @var string
     * 
     * @OA\Property(example="35", maxLength=256)
     */  
    private $ddd;

    /**
     * The Integrated System of Financial Administration of the Federal Government 
     * presents itself as a computerized system for processing and controlling the 
     * budgetary, financial and patrimonial execution of the agencies of the direct 
     * and indirect federal Public Administration.
     * 
     * @var string
     * 
     * @OA\Property(example="252", maxLength=256)
     */
    private $siafi;

    protected $fillable = [
        'id',
        'cep',
        'address',
        'complement',
        'number',
        'district',
        'city',
        'state',
        'country',
        'ibge',
        'gia',
        'ddd',
        'siafi',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
