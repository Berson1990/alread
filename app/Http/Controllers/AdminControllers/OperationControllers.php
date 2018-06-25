<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\Grade;
use App\Http\Models\Year;
use App\Http\Models\Subject;
use App\Http\Models\Users;
use App\Http\Models\TeacherAssgin;
use App\Http\Models\QuestionReport;
use App\Http\Models\StudentQuestion;
use DB;


class OperationControllers extends Controller
{
    //
    public function __construct()
    {
        $this->grade = new Grade();
        $this->year = new Year();
        $this->subject = new Subject();
        $this->users = new Users();
        $this->teacherassgin = new TeacherAssgin();
        $this->questoin_report = new QuestionReport();
        $this->setudent_question = new StudentQuestion();
    }

    public function AssginTeacherIndex()
    {
        return view('teacherassgign.teacherassgign');
    }

    public function ReportQuestionIndex()
    {
        return view('reportquestion.reportquestion');
    }

    public function StudentManagmentIndex()
    {
        return view('studentmanagment.studentmanagment');
    }

    public function TeacherManagmentIndex()
    {
        return view('teachermanagment.teachermanagment');
    }

    public function assginindex()
    {
        return view('assgined.assgined');
    }

    public function studentstat()
    {

        return view('sstat.sstat');
    }

    public function getTeacher()
    {

        return $this->users->where('type', '2')->orderBy('user_id', 'Desc')->get();
    }


    public function TeacherAssgin()
    {
        $input = Request()->all();
        return $this->teacherassgin->create($input);

    }

    public function Assgined()
    {
        return $this->teacherassgin
            ->leftjoin($this->users->getTable(), $this->teacherassgin->getTable() . '.teacher_id', '=', $this->users->getTable() . '.user_id')
            ->where($this->users->getTable() . '.type', 2)
            ->groupBy($this->teacherassgin->getTable() . '.teacher_id')
            ->get();
    }

    public function getAssgindata($id)
    {
        return $this->teacherassgin
            ->leftjoin($this->grade->getTable(), $this->teacherassgin->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->teacherassgin->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->leftjoin($this->subject->getTable(), $this->teacherassgin->getTable() . '.subject_id', '=', $this->subject->getTable() . '.subject_id')
            ->where($this->teacherassgin->getTable() . '.teacher_id', $id)
            ->get();

    }

    public function DeleteAssgin($id)
    {
        $this->teacherassgin->where('assgin_id', $id)->delete();

    }

    public function Report()
    {

        return $this->questoin_report
            ->select(
                'Student.name as StuedntName',
                'Teacher.name as TeacherName',
                $this->questoin_report->getTable() . '.*',
                $this->setudent_question->getTable() . '.*'
            )
            ->leftjoin('users as Student', $this->questoin_report->getTable() . '.student_id', '=', 'Student.user_id')
            ->leftjoin('users as Teacher', $this->questoin_report->getTable() . '.teacher_id', '=', 'Teacher.user_id')
            ->leftjoin($this->setudent_question->getTable(), $this->questoin_report->getTable() . '.question_id', $this->setudent_question->getTable() . '.quetison_id')
            ->get();

    }

    public function state($id, $state)
    {
        $this->users->where('user_id', $id)->update(['state' => $state]);

    }

    public function getStudent()
    {
        return $this->users->where('type', 1)->orderBy('user_id', 'Desc')->get();
    }

    public function StudentStatistic()
    {
        return $this->users
            ->select(
                DB::raw('Count(user_id) as studentCount'),
                $this->grade->getTable() . '.grade',
                $this->year->getTable() . '.year'
            )
            ->join($this->grade->getTable(), $this->users->getTable() . '.grade', $this->grade->getTable() . '.grade_id')
            ->join($this->year->getTable(), $this->users->getTable() . '.year', $this->year->getTable() . '.year_id')
            ->where($this->users->getTable() . '.type', 1)
            ->groupBy($this->users->getTable() . '.grade', $this->users->getTable() . '.year')
            ->orderBy($this->grade->getTable() . '.grade_id', 'asc', $this->year->getTable() . '.year_id', 'asc')
            ->get();
    }


}
