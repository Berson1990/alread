<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/06/2018
 * Time: 11:14 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class PlacementExam extends Model
{
    protected $table = 'placement_exam';
    protected $primaryKey = 'placement_exam_id';
    protected $fillable = [
        'placement_id',
        'question',
        'answer1',
        'answer2',
        'answer3',
        'correct'
    ];

}