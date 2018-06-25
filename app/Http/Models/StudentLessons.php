<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLessons extends Model
{
    //
    protected $fillable = ['lesson_id', 'watch', 'student_id', 'rate','test_id','sol'];
    protected $primaryKey = 'student_lessons_id';
    protected $table = 'studentlessons';

    public function Test()
    {
        return $this->belongsTo('App\Http\Models\Test','test_id');
    }

}
