<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/06/2018
 * Time: 11:43 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class PlacementPayment extends Model
{
    protected $table = 'placement_payment';
    protected $primaryKey = 'placement_payment_id';
    protected $fillable = [
        'placement_id',
        'user_id',
        'payment'
    ];

}