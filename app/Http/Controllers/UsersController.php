<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Users;
use App\Http\Models\Grade;
use App\Http\Models\Year;
use App\Http\Models\TeacherAssgin;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->users = new Users();
        $this->grade = new Grade();
        $this->year = new Year();
        $this->teacher_assgin = new TeacherAssgin();
        $this->baseurl = 'http://muthaber-admin.muthaberapp.com/';
        $this->realbath = '/var/www/alreadapp/html/public/';
    }

    public function CreateNewUser()
    {
        $input = Request()->all();
        if ($input['type'] == 1) {
            $input['state'] = 0;
        }
        $rules = array('email' => 'unique:users,email',
            'phone' => 'unique:users,phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return ['error' => 'هذه العضويه مسجلة لدينا'];

        } else {


            if ($input["image"] == "") {


                $input['password'] = md5($input['password']);
                $input['password_confirm'] = md5($input['password_confirm']);
                $output = $this->users->create($input);
                $user_id = $output->user_id;


            } else {

                $input['password'] = md5($input['password']);
                $input['password_confirm'] = md5($input['password_confirm']);
                $image = $input["image"];
                $jpg_name = "photo-" . time() . ".jpg";
                $path = $this->realbath . "/users_profile/" . $jpg_name;
                $input["image"] = $this->baseurl . "users_profile/" . $jpg_name;
                $img = substr($image, strpos($image, ",") + 1);//take string after ,
                $imgdata = base64_decode($img);
                $success = file_put_contents($path, $imgdata);
                $output = $this->users->create($input);
                $user_id = $output->user_id;
            }

            $output = $this->users
                ->leftjoin($this->grade->getTable(), $this->users->getTable() . '.grade', '=', $this->grade->getTable() . '.grade_id')
                ->leftjoin($this->year->getTable(), $this->users->getTable() . '.year', '=', $this->year->getTable() . '.year_id')
                ->where('user_id', $user_id)
                ->get();
            $output = $output['0'];
            return Response()->json($output);

        }

    }

    public function Login()
    {
        $input = Request()->all();

        $password = md5($input['password']);
        $phone = $input['phone'];
        $check = $this->users
            ->where('phone', '=', $phone)
            ->where('password', '=', $password)
            ->get();

        if (count($check) > 0) {

            $teacher_id = $check['0']['user_id'];

            if ($check['0']['type'] == 2) {

                $check_assgin = $this->teacher_assgin->where('teacher_id', '=', $teacher_id)->get();
                if (count($check_assgin) > 0) {
//                teacher
                    $output = $this->users
                        ->leftjoin($this->teacher_assgin->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacher_assgin->getTable() . '.teacher_id')
                        ->where('phone', '=', $phone)
                        ->get();
//                    $output = $output['0'];
                } else {
                    return ['error' => 'لم يتم تسجيلك خلال البرنامج الدراسى'];
                }

            } else {
//                student
                $output = $this->users
                    ->leftjoin($this->grade->getTable(), $this->users->getTable() . '.grade', '=', $this->grade->getTable() . '.grade_id')
                    ->leftjoin($this->year->getTable(), $this->users->getTable() . '.year', '=', $this->year->getTable() . '.year_id')
                    ->where('phone', '=', $phone)
                    ->get();
            }


            $this->users->where('phone', $input['phone'])->update(['token_id' => $input['token_id']]);

            return Response()->json($output[0]);

        } else {

            return ['error' => 'الجوال او كلمة السر غير صحيحة'];

        }
    }

    public function UpdateUser($user_id)
    {

        $input = Request()->all();
        if (empty($input["image"])) {

            $input['password'] = md5($input['password']);
            $input['password_confirm'] = md5($input['password_confirm']);
            $this->users->find($user_id)->update([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'password' => $input['password'],
                'password_confirm' => $input['password_confirm'],
                'mail' => $input['mail'],
                'type' => $input['type'],
                'grade' => $input['grade'],
                'year' => $input['year'],
            ]);
            if ($input['type'] == 1) {
                $output = $this->users
                    ->leftjoin($this->grade->getTable(), $this->users->getTable() . '.grade', '=', $this->grade->getTable() . '.grade_id')
                    ->leftjoin($this->year->getTable(), $this->users->getTable() . '.year', '=', $this->year->getTable() . '.year_id')
                    ->where('user_id', '=', $user_id)
                    ->get();
                $output = $output[0];
            } else {
                $output = $this->users
                    ->leftjoin($this->teacher_assgin->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacher_assgin->getTable() . '.teacher_id')
                    ->where('user_id', '=', $user_id)
                    ->get();
                $output = $output[0];

            }

        } else {

            $input['password'] = md5($input['password']);
            $input['password_confirm'] = md5($input['password_confirm']);


            $image = $input["image"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/users_profile/" . $jpg_name;
            $input["image"] = $this->baseurl . "users_profile/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);

            $output = $this->users->find($user_id)->update([
                'name' => $input['name'],
                'phone' => $input['phone'],
                'password' => $input['password'],
                'password_confirm' => $input['password_confirm'],
                'mail' => $input['mail'],
                'type' => $input['type'],
                'grade' => $input['grade'],
                'year' => $input['year'],
                'image' => $input['image'],
            ]);

            if ($input['type'] == 1) {
                $output = $this->users
                    ->leftjoin($this->grade->getTable(), $this->users->getTable() . '.grade', '=', $this->grade->getTable() . '.grade_id')
                    ->leftjoin($this->year->getTable(), $this->users->getTable() . '.year', '=', $this->year->getTable() . '.year_id')
                    ->where('user_id', '=', $user_id)
                    ->get();
                $output = $output[0];
            } else {
                $output = $this->users
                    ->leftjoin($this->teacher_assgin->getTable(), $this->users->getTable() . '.user_id', '=', $this->teacher_assgin->getTable() . '.teacher_id')
                    ->where('user_id', '=', $user_id)
                    ->get();
                $output = $output[0];

            }


        }
        return Response()->json($output);


    }

    public function getGrade()
    {

        return $this->grade->all();
    }

    public function getYear($year_id)
    {
        return $this->year
            ->where('grade_id', '=', $year_id)
            ->get();

    }


    public function ForgetPassword()
    {

        $input = Request()->all();
        $email = $input['mail'];
        $output = $this->users->where('mail', '=', $email)->get();
        global $name;
        foreach ($output as $userinfo) {

            $name = $userinfo->name;
        }

        if (Count($output) > 0) {
            $newpassword = $this->NewPassword();

            $this->users->where('mail', $email)->update([
                "password" => md5($newpassword)
            ]);


            $url = "http://www.zadalsharq.com/ar5ss/public/api/alreadSendmail";
            $postlength = array(
                'mail' => $email,
                'name' => $name,
                'newPassword' => $newpassword
            );
            $ch = curl_init($url);
            # Setup request to send json via POST.
            $payload = json_encode($postlength);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            # Return response instead of printing.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            # Send request.
            echo $result = curl_exec($ch);
            curl_close($ch);


            $output = ['Success' => 'تم ارسال كلمة المرور الجديدة الى بريدك الالكترونى'];
        } else {
            $output = ['Error' => 'هذا البريد الالكترونى غير مسجل لدينا'];
        }

        return $output;

    }

    public function AlreadSendmail()
    {
        $input = Request()->all();
        $email = $input['mail'];
        $name = $input['name'];
        $newpassword = $input['newPassword'];
        $subject = "New Password";
        $to = $email;
        $txt = "Dear" . ' ' . $name . "There is a New Password" . ' :' . $newpassword;
        $headers = "From: info@Ar5ss.com" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        echo mail($to, $subject, $txt, $headers);
    }


    private function NewPassword()
    {

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;

    }


}
