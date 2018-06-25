@extends('adminapp.adminapp')
@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection
@section('content')
    <div id="studentmanagment">

        <data-tables :data="studentData" :show-action-bar="false" :custom-filters="customFilters"
                     :actions-def="actionsDef">
            <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                <el-col :span="5">
                    <el-input v-model="customFilters[0].vals">
                    </el-input>
                </el-col>


            </el-row>


            <el-table-column
                    prop="grade"
                    label="المرحلة "
            >
            </el-table-column>

            <el-table-column
                    prop="year"
                    label='السنة الدراسية '
            >
            </el-table-column>

            <el-table-column
                    prop="studentCount"
                    label="عدد الطلاب "
            >
            </el-table-column>





        </data-tables>


    </div>
@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/sstate.js')}}"></script>
@endsection