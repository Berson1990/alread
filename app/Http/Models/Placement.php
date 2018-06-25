<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/06/2018
 * Time: 11:00 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $table = 'placement';
    protected $primaryKey = 'placement_id';
    protected $fillable=  [
        'placement',
        'correct_quetisons_from',
        'correct_quetisons_to',
        'correct_final_exam_from',
        'correct_final_exam_to',
        'placement_duration'
    ];


}