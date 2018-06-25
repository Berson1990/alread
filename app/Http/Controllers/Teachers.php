<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\TeacherAssgin;
use App\Http\Models\Subject;
use App\Http\Models\Users;
use App\Http\Models\Test;
use App\Http\Models\Lesson;
use App\Http\Models\Year;
use App\Http\Models\Grade;
use App\Http\Models\Weak;
use DB;


class Teachers extends Controller
{
    //
    public function __construct()
    {
        $this->teacher_assgin = new TeacherAssgin();
        $this->subject = new Subject();
        $this->users = new Users();
        $this->test = new Test();
        $this->year = new Year();
        $this->grade = new Grade();
        $this->weak = new Weak();
        $this->lesson = new Lesson();
    }

    public function GetTeachersSubject($teacher_id)
    {
        $output = $this->teacher_assgin
            ->where('teacher_id', $teacher_id)
            ->get();
        return $output;
    }

    public function GetALlTests($teacher_id)
    {
        $output = $this->test->where('teacher_id', $teacher_id)->get();
        return $output;

    }

    public function getAllLesson($teacher_id)
    {
        $output = $this->lesson->where('teacher_id', $teacher_id)->get();
        return $output;

    }

    public function getWeaksforTeacher($teacher_id, $subject_id, $grade_id, $year_id)
    {
        $output = $this->lesson
            ->leftjoin($this->weak->getTable(), $this->lesson->getTable() . '.week_id', $this->weak->getTable() . '.week_id')
            ->where($this->lesson->getTable() . '.year_id', $year_id)
            ->where($this->lesson->getTable() . '.grade_id', $grade_id)
            ->where($this->lesson->getTable() . '.subject_id', $subject_id)
            ->where($this->lesson->getTable() . '.teacher_id', $teacher_id)
            ->get();
        return $output;


    }

    public function Contactus(){
        return $output = DB::select('select * from contactus');
    }
    public function BankAccount(){
        return $output = DB::select('select * from bankaccount');
    }
   public function aboutandpolicy(){
        return $output = DB::select('select * from aboutpolicy');
    }


}
