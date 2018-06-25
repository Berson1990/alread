<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 14/06/2018
 * Time: 10:57 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class PlacementQuestions extends Model
{
    protected $table = 'placement_questions';
    protected $primaryKey = 'placement_questions_id';
    protected $fillable = [
        'question',
        'answer1',
        'answer2',
        'answer3',
        'correct'
    ];

}