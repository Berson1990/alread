<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//    $value = session('key');
//});

Route::get('teacherDashBoard', 'TeacherControllers\UploadLessonsController@TeacherDashBoard');


Route::get('/', 'TeacherControllers\UploadLessonsController@LoginPage');
/*login page start*/
//Route::get('/', 'AdminControllers\AdminControllers@login_page');
Route::post('adminapplogin', 'AdminControllers\AdminControllers@LoginAdmin');
/*end*/
/*dashboard*/

Route::get('dashboarddetails', 'AdminControllers\AdminControllers@Dashboard');
Route::get('admindashboard', 'AdminControllers\AdminControllers@getAdminDashBoard');

/*dashboard end*/

/*grade start*/
Route::get('grade', 'AdminControllers\GradeControllers@index');
Route::get('allgrade', 'AdminControllers\GradeControllers@getall');
Route::post('creategrade', 'AdminControllers\GradeControllers@store');
Route::put('updategrade/{id}', 'AdminControllers\GradeControllers@update');
Route::delete('deletegrade/{id}', 'AdminControllers\GradeControllers@delete');
/*grade end*/

/*year Start */

Route::get('year', 'AdminControllers\YearControllers@index');
Route::get('alltear', 'AdminControllers\YearControllers@getall');
Route::post('createyear', 'AdminControllers\YearControllers@store');
Route::put('updateyear/{id}', 'AdminControllers\YearControllers@update');
Route::delete('deleteyear/{id}', 'AdminControllers\YearControllers@delete');
/*year end*/

/*week Start */
Route::get('week', 'AdminControllers\WeekControllers@index');
Route::get('allweek', 'AdminControllers\WeekControllers@getall');
Route::post('createweek', 'AdminControllers\WeekControllers@store');
Route::put('updateweek/{id}', 'AdminControllers\WeekControllers@update');
Route::delete('deleteweek/{id}', 'AdminControllers\WeekControllers@delete');
/*week end*/
/*subject Start */
Route::get('subject', 'AdminControllers\SubjectControllers@index');
Route::get('allsubjectadmin', 'AdminControllers\SubjectControllers@getall');
Route::get('allsubjectadminwhenassgin/{year_id}/{grade_id}', 'AdminControllers\SubjectControllers@GetSubjectWhenAssgin');
Route::post('createsubject', 'AdminControllers\SubjectControllers@store');
Route::put('updatesubject/{id}', 'AdminControllers\SubjectControllers@update');
Route::delete('deletesubject/{id}', 'AdminControllers\SubjectControllers@delete');
/*subject end*/
/*bankaccount Start */
Route::get('bankaccountpage', 'AdminControllers\BankAccountControllers@index');
Route::get('albankaccount', 'AdminControllers\BankAccountControllers@getall');
Route::post('createbankaccount', 'AdminControllers\BankAccountControllers@store');
Route::put('updatebankaccount/{id}', 'AdminControllers\BankAccountControllers@update');
Route::delete('deletebankaccount/{id}', 'AdminControllers\BankAccountControllers@delete');
/*bankaccount end*/

/*about */
Route::get('aboutus', 'AdminControllers\AbouutPolicyControllers@index');

Route::get('getabout', 'AdminControllers\AbouutPolicyControllers@getAbout');

Route::put('updateabout/{id}', 'AdminControllers\AbouutPolicyControllers@update');

/*about end*/
/*contact*/
Route::get('contactus', 'AdminControllers\ContactUsControllers@index');

Route::get('gatcontact', 'AdminControllers\ContactUsControllers@getContacr');

Route::put('updatecobtact/{id}', 'AdminControllers\ContactUsControllers@update');

/*contact end*/
/* assgin teacher*/
Route::get('teacherassgin', 'AdminControllers\OperationControllers@AssginTeacherIndex');
Route::get('reportquestion', 'AdminControllers\OperationControllers@ReportQuestionIndex');
Route::get('studentmangmnet', 'AdminControllers\OperationControllers@StudentManagmentIndex');
Route::get('teachermanagment', 'AdminControllers\OperationControllers@TeacherManagmentIndex');
Route::get('changestate/{id}/{state}', 'AdminControllers\OperationControllers@state');
Route::get('student', 'AdminControllers\OperationControllers@getStudent');
Route::get('getReport', 'AdminControllers\OperationControllers@Report');
Route::get('getallteaches', 'AdminControllers\OperationControllers@getTeacher');
Route::get('getassgin/{id}', 'AdminControllers\OperationControllers@getAssgindata');
Route::get('teacher_assgined', 'AdminControllers\OperationControllers@Assgined');
Route::get('studentstat', 'AdminControllers\OperationControllers@StudentStatistic');
Route::get('studentstatistic', 'AdminControllers\OperationControllers@studentstat');
Route::get('assgined', 'AdminControllers\OperationControllers@assginindex');

Route::post('assgin', 'AdminControllers\OperationControllers@TeacherAssgin');
Route::delete('deleteassgin/{id}', 'AdminControllers\OperationControllers@DeleteAssgin');

/*placement Controller*/
Route::get('placement', 'AdminControllers\PlacementAdminController@PlacemmentIndex');
Route::get('getplacement', 'AdminControllers\PlacementAdminController@GetPlacement');
Route::post('createplacement', 'AdminControllers\PlacementAdminController@CreatePlacement');
Route::put('eidtplacement/{id}', 'AdminControllers\PlacementAdminController@UpdatePlacement');
Route::delete('deleteplacement/{id}', 'AdminControllers\PlacementAdminController@DeletePlacement');
/*detetmine*/
Route::get('placement_determine', 'AdminControllers\PlacementAdminController@Placement_Determine_index');
Route::get('getquestions', 'AdminControllers\PlacementAdminController@GetAllQuestions');
Route::post('createquetions', 'AdminControllers\PlacementAdminController@CreateQuestion');
Route::put('updatequestion/{id}', 'AdminControllers\PlacementAdminController@UpdateQuestions');
Route::delete('deletequestion/{id}', 'AdminControllers\PlacementAdminController@DeleteQuestions');
/*end*/
/*detetmine*/
Route::get('placement_final_exam/{id}', 'AdminControllers\PlacementAdminController@Placement_final_exam_index');
Route::get('getfinalexamquestions/{id}', 'AdminControllers\PlacementAdminController@GetAllExamQuestions');
Route::post('createfinalexamquetions', 'AdminControllers\PlacementAdminController@CreateFinalExamQuestion');
Route::put('updatefinalexamquestion/{id}', 'AdminControllers\PlacementAdminController@UpdateFinalExamQuestions');
Route::delete('deletefinalexamquestion/{id}', 'AdminControllers\PlacementAdminController@DeleteFinalExamQuestions');
/*end*/
/*placement payment*/
Route::get('getplacementpayment', 'AdminControllers\PlacementAdminController@placement_payment_index');
Route::get('allplacement_payment', 'AdminControllers\PlacementAdminController@GetAllPlacementPayment');
/*end*/
/*end*/


/* assgin teacher end*/

Route::get('upload', 'TeacherControllers\UploadLessonsController@index');
Route::get('logout', 'TeacherControllers\UploadLessonsController@LogOut');
Route::get('allyear', 'TeacherControllers\UploadLessonsController@getYear');
Route::get('allweek', 'TeacherControllers\UploadLessonsController@getWeek');
Route::get('allsubject', 'TeacherControllers\UploadLessonsController@getsubject');
Route::get('mytest', 'TeacherControllers\UploadLessonsController@IndexTest');
Route::get('getmytest/{id}', 'TeacherControllers\UploadLessonsController@GetMyTest');
Route::get('deletmytest/{id}', 'TeacherControllers\UploadLessonsController@DeletMyTest');
Route::put('updatetest/{id}', 'TeacherControllers\UploadLessonsController@UpdateMyTest');
Route::post('addnewquestiontest', 'TeacherControllers\UploadLessonsController@AddNewQuestionToMyTest');
Route::get('deletequestion/{id}', 'TeacherControllers\UploadLessonsController@DeleteQuestionFromMyTest');
Route::get('getmylesson/{teacher_id}', 'TeacherControllers\UploadLessonsController@getmylesson');
Route::get('deletelesson/{lesson_id}', 'TeacherControllers\UploadLessonsController@DeleteLession');
Route::post('uploadNewFile', 'TeacherControllers\UploadLessonsController@UpladeVideo');
Route::post('teacherLogin', 'TeacherControllers\UploadLessonsController@Login');
Route::post('createtest', 'TeacherControllers\UploadLessonsController@CreateNewTest');
Route::get('allsubjectforteach/{year_id}/{grade_id}/{teacher_id}', 'TeacherControllers\UploadLessonsController@GetSubjectWhenAssgin');



