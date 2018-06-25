<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Users;
use App\Http\Models\Lesson;
use App\Http\Models\StudentQuestion;
use App\Http\Models\Answer;
use App\Http\Models\QuestionReport;
use App\Http\Models\TeacherAssgin;


class AdminControllers extends Controller
{
    //

    public function __construct()
    {
        $this->users = new Users();
        $this->lesson = new Lesson();
        $this->student_question = new StudentQuestion();
        $this->answer = new Answer();
        $this->question_report = new QuestionReport();
        $this->teacher_assgin = new TeacherAssgin();
    }

    public function login_page()
    {
        return view('applogin.applogin');

    }

    public function getAdminDashBoard()
    {
        return view('admindashboard.admindashboard');

    }

    public function LoginAdmin(Request $request)
    {
        $password = $request->input('password');
        $password = md5($password);
        $mail = $request->input('mail');
        $check = $this->users
            ->where('mail', '=', $mail)
            ->where('password', '=', $password)
            ->where('type', '=', 0)
            ->get();
        if (count($check) > 0) {


            return redirect('admindashboard');


        } else {

            return redirect('/')
                ->with('message', [
                    'type' => 'warrning',
                    'text' => 'كلمة السر او الجوال غير مطابقة'
                ]);
        }

    }

    public function Dashboard()
    {

        $student = $this->users->where('type', '1')->count();
        $teacher = $this->users->where('type', '2')->count();
        $lesson = $this->lesson->count();
        $answer = $this->answer->count();
        $question = $this->student_question->count();
        $questionreport = $this->question_report->count();
        $assgin = $this->teacher_assgin
//            ->join($this->users->getTable(), $this->teacher_assgin->getTable() . '.teacher_id', '=', $this->users->getTable() . '.user_id')
//            ->where('type', 2)
//            ->groupBy($this->teacher_assgin->getTable().'.teacher_id')
            ->count();


        return Response()->json([
            'student' => $student,
            'teacher' => $teacher,
            'lesson' => $lesson,
            'answer' => $answer,
            'question' => $question,
            'questionreport' => $questionreport,
            'teacher_assgin' => $assgin
        ]);


    }

}
