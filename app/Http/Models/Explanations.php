<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/06/2018
 * Time: 11:12 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Explanations extends Model
{
    protected $table = 'explanations';
    protected $primaryKey = 'explanations_id';
    protected $fillable = ['placement_id','explanations'];

}