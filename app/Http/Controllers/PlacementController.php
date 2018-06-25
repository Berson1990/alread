<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Placement;
use App\Http\Models\PlacementExam;
use App\Http\Models\PlacementQuestions;
use App\Http\Models\Explanations;
use App\Http\Models\PlacementPayment;
use App\Http\Models\Users;

class PlacementController extends Controller
{
    //
    public function __construct()
    {
        $this->placement = new Placement();
        $this->placement_exam = new PlacementExam();
        $this->placement_questions = new PlacementQuestions();
        $this->explantions = new Explanations();
        $this->placement_payment = new PlacementPayment();
        $this->users = new Users();
    }

    public function GetPlacementQuestions()
    {
        return $this->placement_questions->all();
    }

    public function GetExplanations($id, $user_id)
    {

        $check = $this->placement_payment->where('placement_id', $id)->where('user_id', $user_id)->where('payment', 1)->get();
        if (count($check) > 0) {
            $output = $this->explantions->where('placement_id', $id)->get();
        } else {
            $output = ['state' => 'برجاء سداد رسوم المستوى'];
        }

        return $output;
    }

    public function GetPlacementExam($id)
    {
        return $this->placement_exam->where('placement_id', $id)->get();
    }

    /* set paymennt */
    public function SetPayment()
    {

        $input = Request()->all();
        return $this->placement_payment->create($input);

    }

    /* get Palcemnent */
    public function GetPlacement()
    {
        $input = Request()->all();

        $getPlacement = $this->placement
            ->where('correct_quetisons_from', '<=', $input['correct_answer'])
            ->where('correct_quetisons_to', '>=', $input['correct_answer'])
            ->take(1)
            ->get();

        return $getPlacement;


    }

    public function ExamResult($placment_id, $user_id)
    {
        $input = Request()->all();

        $checkexamp = $this->placement
            ->where('placement_id', $placment_id)
            ->where('correct_final_exam_from', '<=', $input['correct_answer'])
            ->where('correct_final_exam_to', '>=', $input['correct_answer'])
            ->get();
        if (count($checkexamp) > 0) {

            if ($placment_id == 8) {

                global $token;
                $getNotification = $this->users->select('token_id')->where('user_id', $user_id)->get();
                foreach ($getNotification as $Token_id) {
                    $token = $Token_id->token_id;
                }
                $Token = $token;
                $Title = 'مبارك النجاح ..سوف يتم ارسال لك شهادة من المعهد التدربيى';
                $this->pushAndroid($Token, $Title);
                return [
                    'result' => 'ناجح',
                    "placement_id" => $placment_id
                ];

            } else {
                return [
                    'result' => 'ناجح',
                    "placement_id" => $placment_id + 1
                ];
            }

        } else {

            return ['result' => 'اعد المحاولة'];
        }


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
