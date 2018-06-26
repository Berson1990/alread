<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Lesson;
use App\Http\Models\StudentLessons;
use App\Http\Models\Users;
use App\Http\Models\Weak;
use App\Http\Models\Subject;
use App\Http\Models\Test;
use App\Http\Models\TestQuestions;

use DB;


class LessonController extends Controller
{
    //

    public function __construct()
    {
        $this->lesson = new Lesson();
        $this->studentLesson = new StudentLessons();
        $this->users = new Users();
        $this->weak = new Weak();
        $this->test = new Test();
        $this->test_question = new TestQuestions();
        $this->subject = new Subject();
    }

    public function GetAllSubject($grade_id, $year_id)
    {

        $output = $this->subject
            ->where('grade_id', '=', $grade_id)
            ->where('year_id', '=', $year_id)
            ->get();
        return $output;
    }

    public function GetTimeline($subject_id, $grade_id, $year_id, $student_id)
    {

        $check = $this->users
            ->where('user_id', $student_id)
            ->where('state', '=', 1)
            ->get();

        if (!empty($check)) {

            $output = $this->weak->with(['lesson' => function ($query) use ($subject_id, $grade_id, $year_id, $student_id) {
                $query->with(['studentlessons' => function ($query_2) use ($student_id) {

                    $query_2->where('student_id', '=', $student_id);

                }, 'teachers', 'subject'])
                    ->where($this->lesson->getTable() . '.subject_id', $subject_id)
                    ->where($this->lesson->getTable() . '.grade_id', $grade_id)
                    ->where($this->lesson->getTable() . '.year_id', $year_id);
            }, 'test' => function ($query2) use ($subject_id, $grade_id, $year_id, $student_id) {
                $query2
                    ->with(['TestQuestion', 'StudentTests' => function ($query_3) use ($student_id) {
                        $query_3->where('student_id', '=', $student_id);
                    }])
                    ->where($this->test->getTable() . '.subject_id', $subject_id)
                    ->where($this->test->getTable() . '.grade_id', $grade_id)
                    ->where($this->test->getTable() . '.year_id', $year_id);

            }])
                ->get();

            return Response()->json($output);
        } else {
            return Response()->json(['error' => 'عفوا يجب الاشتراك او تجديد الاشتراك حتى تستطيع استخدام التطبيق']);

        }
    }

    public function Watchvideo()
    {
        $input = Request()->all();
        global $output;
        if (!empty($input['lesson_id'])) {

            $lesson = $this->studentLesson
                ->where('lesson_id', $input['lesson_id'])
                ->get();
            if (count($lesson) > 0) {
                return '0';
            } else {
                $output = $this->studentLesson->create($input);
            }
        } else if (!empty($input['test_id'])) {

            $test = $this->studentLesson
                ->where('test_id', $input['test_id'])
                ->get();

            if (count($test) > 0) {

                return '0';
            } else {

                $output = $this->studentLesson->create($input);
            }
        }


        return $output;
    }

    public function OpentTest()
    {

        $input = Request()->all();
        $output = $this->studentLesson->create($input);
        return $output;
    }

    public function rateLesson($lesson_id, $rate, $student_id)
    {
        $output = $this->studentLesson
            ->where('lesson_id', $lesson_id)
            ->where('student_id', $student_id)
            ->update(['rate' => $rate]);

//        update real rate on lesson in table lesson
        $this->Rate($lesson_id);

        return ['state' => '202'];

    }


    private function Rate($lesson_id)
    {

        $dailyrate = $this->studentLesson
            ->select(
                DB::raw('count(rate)as count_rate'),
                DB::raw('sum(rate)as sum_rate')
            )
            ->where('lesson_id', $lesson_id)
            ->get();
        global $count_rate;
        global $sum_rate;
        foreach ($dailyrate as $studentLessonrate) {
            $count_rate = $studentLessonrate->count_rate;
            $sum_rate = $studentLessonrate->sum_rate;

        }
        $final_rate = $sum_rate / $count_rate;
        $this->lesson->find($lesson_id)->update(['rate' => $final_rate]);
    }

    public function GetTest($weak_id, $subject_id, $teacher_id)
    {

        $output = $this->test->with('TestQuestion')
            ->where($this->test->getTable() . '.week_id', $weak_id)
            ->where($this->test->getTable() . '.teacher_id', $teacher_id)
            ->where($this->test->getTable() . '.subject_id', $subject_id)
            ->get();
        return $output;
    }

    public function GetTestQuestions($weak_id, $subject_id, $teacher_id)
    {

        $output = $this->test_question
            ->select($this->test_question->getTable() . '.*')
            ->join($this->test->getTable(), $this->test_question->getTable() . '.test_id', $this->test->getTable() . '.test_id')
            ->where($this->test->getTable() . '.week_id', $weak_id)
            ->where($this->test->getTable() . '.teacher_id', $teacher_id)
            ->where($this->test->getTable() . '.subject_id', $subject_id)
            ->get();
        return $output;
    }


    public function CreateNewTest()
    {

        $input = Request()->all();
        $output = $this->test->create($input);
        $test_id = $output->test_id;
        for ($i = 0; $i < count($input['quetsion']); $i++) {
            $input['quetsion'][$i]['test_id'] = $test_id;
            $this->test_question->create($input['quetsion'][$i]);
        }


        return $this->test->with('TestQuestion')->where('test_id', $test_id)->get();
//        return ['state' => '202'];
    }


    public function GetTestResaut()
    {
        global $correct_answer;
        global $wrong_answer;
        $correct_answer = array();
        $wrong_answer = array();
        $input = Request()->all();
        for ($i = 0; $i < count($input); $i++) {
            if (!empty($input[$i]['answer'])) {
                if ($input[$i]['correct'] == $input[$i]['answer']) {
                    array_push($correct_answer, $input[$i]['answer']);
                } else {
                    array_push($wrong_answer, $input[$i]['correct']);
                }
            } else {
                return ['error' => 'هناك سؤال لم يتم الاجابه عنه'];
            }
        }
        $total_question = sizeof($input);
        $correct_answer = sizeof($correct_answer);

        $final_result = $correct_answer * $total_question / 100 * 100;

        return ['final_result' => $final_result];
    }


    public function getAllLessonsInWeek($teacher_id, $subject_id, $year_id, $grade_id, $week_id)
    {

        $output = $this->lesson
            ->leftjoin($this->weak->getTable(), $this->lesson->getTable() . '.week_id', $this->weak->getTable() . '.week_id')
            ->where($this->lesson->getTable() . '.week_id', $week_id)
            ->where($this->lesson->getTable() . '.teacher_id', $teacher_id)
            ->where($this->lesson->getTable() . '.subject_id', $subject_id)
            ->where($this->lesson->getTable() . '.year_id', $year_id)
            ->where($this->lesson->getTable() . '.grade_id', $grade_id)
            ->get();
        return $output;
    }

// deprecated
    public function getLessonVideo($weak_id, $subject_id, $teacher_id)
    {
        $output = $this->lesson
            ->where($this->lesson->getTable() . '.weak_id', $weak_id)
            ->where($this->lesson->getTable() . '.teacher_id', $teacher_id)
            ->where($this->lesson->getTable() . '.subject_id', $subject_id)
            ->get();
        return $output;


    }
}
