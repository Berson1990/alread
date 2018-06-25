<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuestion extends Model
{
    //
    protected $fillable = ['student_id', 'subject_id', 'grade_id', 'year_id', 'question', 'image_url', 'audio_url','answerd'];
    protected $table = 'studentquestion';
    protected $primaryKey = 'quetison_id';

    public function Student()
    {
        return $this->belongsTo('App\Http\Modles\Users', 'student_id'); // user_id
    }
}
