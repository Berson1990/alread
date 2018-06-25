<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $table = 'leason';
    protected $primaryKey = 'lesson_id';
    protected $fillable = ['teacher_id', 'subject_id', 'lesson_name', 'video_url', 'week_id', 'rate', 'grade_id', 'year_id'];

    public function studentlessons()
    {
        return $this->hasMany('App\Http\Models\StudentLessons', 'lesson_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Http\Models\Users', 'student_id');
    }

    public function weak()
    {
        return $this->belongsTo('App\Http\Models\Weak', 'week_id');

    }

    public function subject()
    {
        return $this->belongsTo('App\Http\Models\Subject', 'subject_id');

    }

    public function teachers()
    {
        return $this->belongsTo('App\Http\Models\Users', 'teacher_id');
    }


}
