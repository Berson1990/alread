@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection
<?php
//$_SESSION["user_id"] = Session::get('teachersput.user_id');
//print_r($_SESSION);


//$user_id = Session::get('teachersput.user_id');
//setcookie('user_id', $user_id, time() + (86400 * 30), "/");
//echo $user_id;
?>
@section('content')
    <script type="text/javascript">
        teachersput = <?php echo json_encode(Session::get('teachersput'));?>
    </script>



    <div class="container-fluid">
        <div class="sp-50"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">ادخل درس جديد</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{url('uploadNewFile')}}"
                              enctype="multipart/form-data" dir="rtl">
                            {{ csrf_field() }}
                            {{--{{Session::get('teachersput')}}--}}
                            <input type="hidden" id="teacher_id" name="teacher_id" value="">
                            <input type="hidden" id="grade_id" name="grade_id" value="">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">السنة الدراسية:</label>
                                <div class="col-sm-10">
                                    <select id="year" name="year_id" class="form-control" onchange="getsubject()"
                                            required>
                                        <option value="0"></option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">الاسبوع:</label>
                                <div class="col-sm-10">
                                    <select id="week" name="week_id" class="form-control" required>
                                        <option value="0"></option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">المادة:</label>
                                <div class="col-sm-10">
                                    <select id="subject" name="subject_id" class="form-control" required>
                                        <option value="0"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">اسم الدرس</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lesson_name" id="lesson_name" class="form-control"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">الدرس </label>
                                <div class="col-sm-10">
                                    <input type="file" id="video_url" name="video_url">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-default" type="submit">ادخل الدرس</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sp-50"></div>
            <div class="row">
                <table id="teacherTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>اسم الدرس</th>
                        <th>الدرس</th>
                        <th>المادة</th>
                        <th>المرحلة</th>
                        <th>السنة</th>
                        <th> الاسبوع</th>
                        <th> حذف</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
@endsection

@section('page-script-level')
            <script src={{asset("AdminScript/teacherDashBoard.js")}}></script>

@endsection