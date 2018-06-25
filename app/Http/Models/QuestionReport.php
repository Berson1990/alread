<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 22/02/2018
 * Time: 04:26 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class QuestionReport extends Model
{
    protected $fillable = ['teacher_id', 'student_id','report'];
    protected $primaryKey = 'report_id';
    protected $table = 'questionreport';

}