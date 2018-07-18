<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('activate', 'UsersController@Activate');
Route::get('getactivatecode/{phone}', 'UsersController@GetActivateForTest');
Route::get('getGrade', 'UsersController@getGrade');
Route::get('getYear/{grade_id}', 'UsersController@getYear');
Route::get('getmyquestion/{student_id}', 'AskAndAnswerController@MyQustion');
Route::get('getteacherquetison/{grade_id}/{subject_id}/{year_id}', 'AskAndAnswerController@MyTeacherQustion');
Route::get('get_questions/{question_id}', 'AskAndAnswerController@getQuestins');
Route::get('getanserquestion/{question_id}', 'AskAndAnswerController@GetAnswer');
Route::get('getyearsforteacher/{grade_id}/{teacher_id}', 'AskAndAnswerController@getYear');
Route::get('getsubjectsforteacher/{year_id}/{teacher_id}', 'AskAndAnswerController@getTeacherSubject');
Route::get('getsubject/{grade_id}/{year_id}', 'LessonController@GetAllSubject');
Route::get('getallsubject/{grade_id}/{year_id}', 'LessonController@GetAllSubject');
Route::get('gettimeline/{subject_id}/{grade_id}/{year_id}/{student_id}', 'LessonController@GetTimeline');
Route::get('gettest/{weak_id}/{subject_id}/{teacher_id}', 'LessonController@GetTest');
Route::get('gettestquestions/{weak_id}/{subject_id}/{teacher_id}', 'LessonController@GetTestQuestions');
Route::get('getteachersubject/{teacher_id}', 'GetTeachersSubject@Teachers');
Route::get('getteacherweek/{teacher_id}/{subject_id}/{grade_id}/{year_id}', 'Teachers@getWeaksforTeacher');
Route::get('contactus', 'Teachers@Contactus');
Route::get('bankaccount', 'Teachers@BankAccount');
Route::get('aboutandpolicy', 'Teachers@aboutandpolicy');
Route::get('getleessoninweek/{teacher_id}/{subject_id}/{grade_id}/{year_id}/{week_id}', 'LessonController@getAllLessonsInWeek');
Route::post('gettestresult', 'LessonController@GetTestResaut');
//Route::get('getvido/{student_id}/{}', 'LessonController@getLessonVideo');

Route::post('register', 'UsersController@CreateNewUser');
Route::post('login', 'UsersController@Login');
Route::post('forgetpassword', 'UsersController@ForgetPassword');
Route::post('sendmail', 'UsersController@sendmail');
Route::post('ask', 'AskAndAnswerController@CreateNewQuestion');
Route::post('testaudio', 'AskAndAnswerController@TestAudio');
Route::post('askfile', 'AskAndAnswerController@CreateNewQuestionWithfile');
Route::post('answer', 'AskAndAnswerController@CreateAnswer');
Route::post('answerfile', 'AskAndAnswerController@CreateAnswerFile');
Route::post('createReport', 'AskAndAnswerController@ReportQueestion');
Route::post('watch', 'LessonController@Watchvideo');
Route::post('opentest', 'LessonController@OpentTest');
Route::post('createtest', 'LessonController@CreateNewTest');


Route::put('updateuser/{user_id}', 'UsersController@UpdateUser');
Route::put('rateanswer/{question_id}', 'AskAndAnswerController@RateQustion');
Route::get('ratethislesson/{lesson_id}/{rate}/{student_id}', 'LessonController@rateLesson');


/*placement*/

Route::get('getplacementquestions', 'PlacementController@GetPlacementQuestions');
Route::get('getexplan/{id}/{user_id}', 'PlacementController@GetExplanations');
Route::get('getplacementexam/{id}', 'PlacementController@GetPlacementExam');
Route::post('createplacementpayment', 'PlacementController@SetPayment');
Route::post('getyourplacement', 'PlacementController@GetPlacement');
Route::post('examresult/{placement_id}/{user_id}', 'PlacementController@ExamResult');

/*end*/




