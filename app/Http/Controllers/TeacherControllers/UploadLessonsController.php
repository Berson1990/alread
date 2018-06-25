<?php

namespace App\Http\Controllers\TeacherControllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Models\Users;
use App\Http\Models\TeacherAssgin;
use App\Http\Models\Lesson;
use App\Http\Models\Grade;
use App\Http\Models\Year;
use App\Http\Models\Weak;
use App\Http\Models\Subject;
use App\Http\Models\Test;
use App\Http\Models\TestQuestions;
use Youtube;

class UploadLessonsController extends Controller
{


    public function __construct()
    {
        $this->users = new Users();
        $this->teacherAssgins = new TeacherAssgin();
        $this->grade = new Grade();
        $this->year = new Year();
        $this->weak = new Weak();
        $this->lesson = new Lesson();
        $this->subject = new Subject();
        $this->test = new Test();
        $this->testquestions = new TestQuestions();
        $this->baseurl = 'http://teacher.muthaberapp.com';
        $this->realbath = '/var/www/teacheradmin/html/public';
    }


    public function index()
    {
        return view('uploadefile.uploadefile');
    }

    public function TeacherDashBoard()
    {
//        dd(session()->has('teachersput'));
//        if (session()->has('teachersput')) {
        $teachersput = session()->get('teachersput');
        return view('teacherdashboard.teacherdashboard')->with('teachersput', $teachersput);
//        } else {
//            return redirect('/');
//        }
    }

    public function LoginPage()
    {


        return view('login.login');


    }


    public function Login(Request $request)
    {

        $password = $request->input('password');
        $password = md5($password);
        $phone = $request->input('phone');
        $check = $this->users
            ->join($this->teacherAssgins->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacherAssgins->getTable() . '.teacher_id')
            ->where('phone', '=', $phone)
            ->where('password', '=', $password)
            ->get();
//        return $check;
        if (sizeof($check) > 0) {

            $output = $this->users
                ->select('name', 'user_id', 'grade_id', 'teacher_id')
                ->join($this->teacherAssgins->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacherAssgins->getTable() . '.teacher_id')
                ->where('phone', '=', $phone)
//                ->groupBy('user_id')
                ->get();

            $request->session()->put('teachersput', $check[0]);
//            dd($request->session()->get('teachersput'));
//            return redirect('teacherDashBoard');
            return redirect('mytest');
//                ->with('teachersput', $teachersput);

        } else {

            return redirect('/')
                ->with('message', [
                    'type' => 'warrning',
                    'text' => 'كلمة السر او الجوال غير مطابقة'
                ]);
        }

    }

    public function LogOut()
    {
        session()->flush();
        return redirect('/');
    }

    public function getYear()
    {


        $year = $this->year->all();
        return Response()->json($year);
    }

    public function getWeek()
    {
        $week = $this->weak->all();
        return Response()->json($week);
    }

    public function getsubject()
    {

        $subject = $this->subject->all();
        return Response()->json($subject);
    }

    public function UpladeVideo(Request $request)
    {
        $input = Request()->all();

        $image = $request->file('video_url');

        $input['video_url'] = $this->baseurl . "/lesson_video/" . time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = $this->realbath . "/lesson_video/";

        $image->move($destinationPath, $input['video_url']);

        $output = $this->lesson->create($input);


        return redirect('teacherDashBoard');

    }

    public function getmylesson($teacher_id)
    {

        $output = $this->lesson
            ->leftjoin($this->year->getTable(), $this->lesson->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->leftjoin($this->weak->getTable(), $this->lesson->getTable() . '.week_id', '=', $this->weak->getTable() . '.week_id')
            ->leftjoin($this->subject->getTable(), $this->lesson->getTable() . '.subject_id', '=', $this->subject->getTable() . '.subject_id')
            ->leftjoin($this->grade->getTable(), $this->lesson->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->where($this->lesson->getTable() . '.teacher_id', '=', $teacher_id)
            ->groupBy($this->lesson->getTable() . '.lesson_id')
            ->get();
        return $output;

    }

    public function DeleteLession($lesson_id)
    {

        $output = $this->lesson->where('lesson_id', $lesson_id)->delete();

    }

//    Test Part
    public function IndexTest()
    {
        return view('mytestpage.mytestpage');
    }

    public function GetMyTest($id)
    {
        return $this->test
            ->with('TestQuestion')
            ->leftjoin($this->users->getTable(), $this->test->getTable() . '.teacher_id', $this->users->getTable() . '.user_id')
            ->leftjoin($this->subject->getTable(), $this->test->getTable() . '.subject_id', $this->subject->getTable() . '.subject_id')
            ->leftjoin($this->grade->getTable(), $this->test->getTable() . '.grade_id', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->weak->getTable(), $this->test->getTable() . '.week_id', $this->weak->getTable() . '.week_id')
            ->leftjoin($this->year->getTable(), $this->test->getTable() . '.year_id', $this->year->getTable() . '.year_id')
            ->where($this->test->getTable() . '.teacher_id', $id)
            ->groupBy($this->test->getTable() . '.test_id')
            ->get();

    }


    public function GetSubjectWhenAssgin($year_id, $grade_id, $teacher_id)
    {
        $output = $this->teacherAssgins
            ->select(
                $this->subject->getTable() . '.*',
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->leftjoin($this->subject->getTable(), $this->teacherAssgins->getTable() . '.subject_id', '=', $this->subject->getTable() . '.subject_id')
            ->leftjoin($this->grade->getTable(), $this->subject->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->subject->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->where($this->teacherAssgins->getTable() . '.year_id', $year_id)
            ->where($this->teacherAssgins->getTable() . '.grade_id', $grade_id)
            ->where($this->teacherAssgins->getTable() . '.teacher_id', $teacher_id)
//            ->groupBy($this->teacherAssgins->getTable().'.subject_id')
            ->get();
        return $output;
    }

    public function CreateNewTest()
    {

        $input = Request()->all();
        $output = $this->test->create($input['main']);
        $test_id = $output->test_id;
        for ($i = 0; $i < count($input['qustions']); $i++) {
            $correct = $input['qustions'][$i]['correct']['correct'];
            $this->testquestions->create([
                "questaion" => $input['qustions'][$i]['quetsion'],
                "answer_1" => $input['qustions'][$i]['answer1'],
                "answer_2" => $input['qustions'][$i]['answer2'],
                "answer_3" => $input['qustions'][$i]['answer3'],
                "correct" => $correct,
                "test_id" => $test_id
            ]);
        }

        $output = $this->test
            ->leftjoin($this->grade->getTable(), $this->test->getTable() . '.grade_id', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->test->getTable() . '.year_id', $this->year->getTable() . '.year_id')
            ->leftjoin($this->weak->getTable(), $this->test->getTable() . '.week_id', $this->weak->getTable() . '.week_id')
            ->leftjoin($this->subject->getTable(), $this->test->getTable() . '.subject_id', $this->subject->getTable() . '.subject_id')
            ->with('TestQuestion')
            ->where('test_id', $test_id)
            ->get();
        return $output[0];
    }

    public function DeletMyTest($id)
    {
        $this->test->where('test_id', $id)->delete();
        $this->testquestions->where('test_id', $id)->delete();

    }

    public function UpdateMyTest($id)
    {
        $input = Request()->all();
        $this->test->find($id)->update($input);
    }

    public function AddNewQuestionToMyTest()
    {
        $input = Request()->all();
        $input['correct'] = $input['correct']['correct'];
        return $this->testquestions->create($input);

    }

    public function DeleteQuestionFromMyTest($id)
    {
        $this->testquestions->find($id)->delete();

    }


}
