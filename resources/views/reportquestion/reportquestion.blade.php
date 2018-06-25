@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="report">
        <div class="row">

            <br>
            <data-tables :data="ReportData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    {{--<el-col :span="19">--}}
                    {{--<el-button type="success" data-toggle="modal" data-target="#myModal">اضافة مرحله جديدة--}}
                    {{--</el-button>--}}
                    {{--</el-col>--}}
                </el-row>


                <el-table-column
                        prop="TeacherName"
                        label="اسم المدرس">
                </el-table-column>
                <el-table-column
                        prop="StuedntName"
                        label="اسم الطلب">
                </el-table-column>
                <el-table-column
                        prop="question"
                        label=" السؤال المقدم عليه الشكوى">
                </el-table-column>
                <el-table-column
                        prop="report"
                        label="   الشكوى">
                </el-table-column>


            </data-tables>


        </div>

        @endsection

        @section('page-script-level')
            <script src="{{asset('AppAdmin/reportquestion.js')}}"></script>
@endsection