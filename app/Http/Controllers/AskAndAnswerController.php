<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\StudentQuestion;
use App\Http\Models\Answer;
use App\Http\Models\Year;
use App\Http\Models\Grade;
use App\Http\Models\Subject;
use App\Http\Models\TeacherAssgin;
use App\Http\Models\Users;
use App\Http\Models\QuestionReport;
use DB;


class AskAndAnswerController extends Controller
{

    public function __construct()
    {
        $this->studentQuestion = new StudentQuestion();
        $this->answer = new Answer();
        $this->teacher_assgin = new TeacherAssgin();
        $this->year = new Year();
        $this->grade = new Grade();
        $this->subject = new Subject();
        $this->users = new Users();
        $this->report = new QuestionReport();
        $this->baseurl = 'http://muthaber-admin.muthaberapp.com/';
        $this->realbath = '/var/www/alreadapp/html/public/';
    }

    public function TestAudio()
    {
        $input = Request()->all();
        $Voice = $input["audio_url"];
        $voice_name = "voice-" . time() . ".mp3";
        $path = $this->realbath . "/question_audio/" . $voice_name;
        $input["audio_url"] = $this->baseurl . "question_audio/" . $voice_name;
        $voc = substr($Voice, strpos($voice_name, ",") + 1);//take string after ,
        $voicedata = base64_decode($Voice);
        $success = file_put_contents($path, $voicedata);

        return 'http://muthaber-admin.muthaberapp.com/' . $path;
    }

///*test function*/

//    /*defaul function*/
    public function CreateNewQuestion()
    {


        $input = Request()->all();

        $check = $this->users
            ->where('user_id', $input['student_id'])
            ->where('state', '=', 1)
            ->get();
        if (count($check) > 0) {


//        insert vocie
            if (!empty($input["audio_url"])) {
                $Voice = $input["audio_url"];
                $voice_name = "voice-" . time() . ".3gp";
                $path = $this->realbath . "/question_audio/" . $voice_name;
                $input["audio_url"] = $this->baseurl . "question_audio/" . $voice_name;
                $voc = substr($Voice, strpos($voice_name, ",") + 1);//take string after ,
                $voicedata = base64_decode($Voice);
                $success = file_put_contents($path, $voicedata);
            } else if (empty($input['audio_url'])) {

                $input['audio_url'] = '';
            }

// end
            if (!empty($input["image_url"])) {
                $image = $input["image_url"];
                $jpg_name = "photo-" . time() . ".jpg";
                $path = $this->realbath . "/question_image/" . $jpg_name;
                $input["image_url"] = $this->baseurl . "question_image/" . $jpg_name;
                $img = substr($image, strpos($image, ",") + 1);//take string after ,
                $imgdata = base64_decode($img);
                $success = file_put_contents($path, $imgdata);
            }
            $output = $this->studentQuestion->create($input);


            $Token_id = $this->users
                ->select(
                    $this->teacher_assgin->getTable() . '.*',
                    $this->users->getTable() . '.token_id',
                    $this->grade->getTable() . '.*',
                    $this->year->getTable() . '.*',
                    $this->subject->getTable() . '.*'
                )
                ->Leftjoin($this->teacher_assgin->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacher_assgin->getTable() . '.teacher_id')
                ->Leftjoin($this->grade->getTable(), $this->teacher_assgin->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
                ->Leftjoin($this->year->getTable(), $this->teacher_assgin->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
                ->Leftjoin($this->subject->getTable(), $this->teacher_assgin->getTable() . '.subject_id', '=', $this->subject->getTable() . '.subject_id')
                ->where($this->teacher_assgin->getTable() . '.year_id', '=', $input['year_id'])
                ->where($this->teacher_assgin->getTable() . '.grade_id', '=', $input['grade_id'])
                ->where($this->teacher_assgin->getTable() . '.subject_id', '=', $input['subject_id'])
                ->get();

            foreach ($Token_id as $TeachesToken) {
                $Token = $TeachesToken->token_id;
                $Title = " قام احد الطلاب فى المرحلة ";
                $Title .= $TeachesToken->grade;
                $Title .= 'فى السنة ';
                $Title .= $TeachesToken->year;
                $Title .= ' بطرح سؤال جديد فى مادة ';
                $Title .= $TeachesToken->name;
                $dvice_type = $TeachesToken->divce_type;


                $this->pushAndroid($Token, $Title);


            }

            return Response()->json(['state' => '202']);
        } else {
            return Response()->json(['error' => 'عفوا يجب الاشتراك او تجديد الاشتراك حتى تستطيع استخدام التطبيق']);
        }

    }


    public function CreateAnswerFile()
    {

        $input = Request()->all();
        $request = new Request();
//        insert vocie
        if (!empty($input["audio_url"])) {

            $image = $request->file('audio_url');

            $input['video_url'] = $this->baseurl . "/answer_audio/" . time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = $this->realbath . "/answer_audio/";

            $image->move($destinationPath, $input['video_url']);


        } else if (empty($input['audio_url'])) {

            $input['audio_url'] = '';
        }

// end
        if (!empty($input["image_url"])) {
            $image = $input["image_url"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/answer_image/" . $jpg_name;
            $input["image_url"] = $this->baseurl . "answer_image/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);

        }

        $output = $this->answer->create($input);

        $quetison_id = $output->quetison_id;


        $this->studentQuestion->where('quetison_id', '=', $quetison_id)->update(['answerd' => 1]);


        $Token = $this->users
            ->leftjoin($this->studentQuestion->getTable(), $this->users->getTable() . '.user_id', '=', $this->studentQuestion->getTable() . '.student_id')
            ->where($this->studentQuestion->getTable() . '.quetison_id', '=', $output->question_id)
            ->get();

        foreach ($Token as $token_id) {

            $user_token = $token_id->token_id;
            $dvice_type = $token_id->dvice_type;
            $Title = 'قام احد المدرسين بالاجابه عن سؤالك ';

            $this->pushAndroid($user_token, $Title);


        }
        return Response()->json(['state' => '202']);


    }

    public function CreateAnswer()
    {

        $input = Request()->all();
//        insert vocie
        if (!empty($input['audio_url'])) {
            $Voice = $input["audio_url"];
            $voice_name = "voice-" . time() . ".3gp";
            $path = $this->realbath . "/answer_audio/" . $voice_name;
            $input["audio_url"] = $this->baseurl . "answer_audio/" . $voice_name;
            $voc = substr($Voice, strpos($voice_name, ",") + 1);//take string after ,
            $voicedata = base64_decode($Voice);
            $success = file_put_contents($path, $voicedata);
        } else if (empty($input['audio_url'])) {
            $input['audio_url'] = '';
        }

// end
        if (!empty($input["image_url"])) {
            $image = $input["image_url"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/answer_image/" . $jpg_name;
            $input["image_url"] = $this->baseurl . "answer_image/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);

        }

        $output = $this->answer->create($input);

        StudentQuestion::where('quetison_id', $input['question_id'])->update(['answerd' => 1]);


        $Token = $this->users
            ->leftjoin($this->studentQuestion->getTable(), $this->users->getTable() . '.user_id', '=', $this->studentQuestion->getTable() . '.student_id')
            ->where($this->studentQuestion->getTable() . '.quetison_id', '=', $output->question_id)
            ->get();

        foreach ($Token as $token_id) {

            $user_token = $token_id->token_id;
            $dvice_type = $token_id->dvice_type;
            $Title = 'قام احد المدرسين بالاجابه عن سؤالك ';

            $this->pushAndroid($user_token, $Title);


        }
        return Response()->json(['state' => 'تم الاجابه على السؤال']);


    }


    public function MyQustion($student_id)
    {

        $output = $this->studentQuestion->where('student_id', '=', $student_id)->get();

        return Response()->json($output);

    }

    public function MyTeacherQustion($grade_id, $subject_id, $year_id)
    {

        $output = $this->studentQuestion
//            ->with('Student')
            ->leftjoin($this->users->getTable(), $this->studentQuestion->getTable() . '.student_id', '=', $this->users->getTable() . '.user_id')
            ->where($this->studentQuestion->getTable() . '.subject_id', '=', $subject_id)
            ->where($this->studentQuestion->getTable() . '.grade_id', '=', $grade_id)
            ->where($this->studentQuestion->getTable() . '.year_id', '=', $year_id)
            ->where($this->studentQuestion->getTable() . '.answerd', '!=', 1)
            ->orderBy($this->studentQuestion->getTable() . '.quetison_id', 'DESC')
            ->get();

        return Response()->json($output);

    }


    public function getQuestins($quetison_id)
    {

        $output = $this->studentQuestion
//            ->with('Student')
            ->leftjoin($this->users->getTable(), $this->studentQuestion->getTable() . '.student_id', '=', $this->users->getTable() . '.user_id')
            ->where($this->studentQuestion->getTable() . '.quetison_id', '=', $quetison_id)
            ->where($this->studentQuestion->getTable() . '.answerd', '!=', 1)
            ->orderBy($this->studentQuestion->getTable() . '.quetison_id', 'DESC')
            ->get();

        return Response()->json($output);

    }

    public function GetAnswer($question_id)
    {

        $output = $this->answer
            ->select($this->answer->getTable() . '.*', $this->studentQuestion->getTable() . '.answerd')
            ->leftjoin($this->studentQuestion->getTable(), $this->answer->getTable() . '.question_id', $this->studentQuestion->getTable() . '.quetison_id')
            ->where('question_id', $question_id)
            ->orderby($this->answer->getTable(), 'DESC')
            ->get();
        return Response()->json($output);

    }

    public function RateQustion($question_id)
    {
        $input = Request()->all();
        $input = $this->answer->where('question_id', $question_id)->update(['rate' => $input['rate']]);
        return ['state' => '202'];
    }

    public function getYear($grade_id, $teacher_id)
    {
        $output = $this->teacher_assgin
            ->leftjoin($this->year->getTable(), $this->teacher_assgin->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->where($this->teacher_assgin->getTable() . '.grade_id', '=', $grade_id)
            ->where($this->teacher_assgin->getTable() . '.teacher_id', '=', $teacher_id)
            ->groupBy($this->year->getTable() . '.year_id')
            ->get();
        return $output;
    }

    public function getTeacherSubject($year_id, $teacher_id)
    {

        $output = $this->teacher_assgin
            ->leftjoin($this->subject->getTable(), $this->teacher_assgin->getTable() . '.subject_id', '=', $this->subject->getTable() . '.subject_id')
            ->where($this->teacher_assgin->getTable() . '.year_id', '=', $year_id)
            ->where($this->teacher_assgin->getTable() . '.teacher_id', '=', $teacher_id)
            ->get();
        return $output;
    }

    public function ReportQueestion()
    {

        $input = Request()->all();
        $output = $this->report->create($input);
        return ['state' => '202'];
    }


    function pushAndroid($Token, $Title)
    {

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $Token;
        $serverKey = 'AAAAfVoWvlg:APA91bEtgLVvVvAY-EYCRNi7KZUO5Rvq5Bg4sRVjtIbAoD4H0-WOKjtHtQv8h1ylzN94bpfaVkXcEByPYrmrscNvfR66A6AiO-KNyvZSuIieuYTBkgTCpbUBpUf22ddIBQ2O5cyWOD-3';
        $title = $Title;
        $body = $title;
        $notification = array('title' => $title, 'text' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_exec($ch);
//        if ($response === FALSE) {
//            die('FCM Send Error: ' . curl_error($ch));
//        } else {
//            echo $response;
//        }

        curl_close($ch);

    }


}
