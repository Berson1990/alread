<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/03/2018
 * Time: 03:30 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class CountactUs extends Model
{

    protected $table = 'contactus';
    protected $fillable = ['phone_whatsapp', 'email' ,'website','address'];
    protected $primaryKey = 'id';
}