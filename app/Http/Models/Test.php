<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = ['subject_id', 'teacher_id','week_id','year_id','grade_id'];
    protected $table = 'test';
    protected $primaryKey = 'test_id';

    public function TestQuestion()
    {

        return $this->hasMany('App\Http\Models\TestQuestions', 'test_id');
    }
    public function StudentTests()
    {
        return $this->hasMany('App\Http\Models\StudentLessons', 'test_id');
    }
}
