@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="assgined">
        <div class="row">

            <br>
            <data-tables :data="teacherData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>
                </el-row>

                <el-table-column
                        prop="name"
                        label="اسم المعلم"
                >
                </el-table-column>
                <el-table-column label="تسكينات المعلم">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="getassgin(scope.$index , scope.row)">تسكينات المعلم
                        </el-button>
                    </template>
                </el-table-column>
            </data-tables>



            {{--show assgigned--}}

            <el-dialog title="تسكينات المدرس" :visible.sync="dialogTableVisible">
                {{--<el-table :data="teacher_assgin">--}}
                {{--<el-table-column property="teacher_assgin.grade" label="المرحلة الدراسية" width="150"></el-table-column>--}}
                {{--<el-table-column property="teacher_assgin.year" label="السنة الدراسية" width="200"></el-table-column>--}}
                {{--<el-table-column property="teacher_assgin.name" label="اسم المادة"></el-table-column>--}}
                {{--</el-table>--}}
                <table class="table table-bordred">
                    <thead>
                    <td>المرحلةالدراسية</td>
                    <td>السنة الدراسية</td>
                    <td>المادة الدراسية</td>
                    <td> حذف التسكين</td>
                    </thead>
                    <tbody>
                    <tr v-for="(assgin , index) in teacher_assgin">
                        <td>@{{ assgin.grade }}</td>
                        <td>@{{ assgin.year}}</td>
                        <td>@{{ assgin.name}}</td>
                        <td>
                            <button class="btn btn-danger" @click="deleteAssgin(assgin, index,teacher_assgin)">حذف
                                التسكين
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </el-dialog>


        </div>

        @endsection

        @section('page-script-level')
            <script src="{{asset('AppAdmin/assgined.js')}}"></script>
@endsection