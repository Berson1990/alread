@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="teacherassgin">
        <div class="row">

            <br>
            <data-tables :data="teacherData" :show-action-bar="false" :custom-filters="customFilters"
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
                <el-table-column label="تسكين المعلم">
                    <template slot-scope="scope">
                        <el-button
                                data-toggle="modal"
                                data-target="#myModal"
                                class="el-icon-edit"
                                size="medium"
                                type="success"
                                @click="passdata(scope.$index, scope.row)"
                        >
                            تسكين المعلم
                        </el-button>
                    </template>
                </el-table-column>

            </data-tables>

            {{--modal--}}
            <div class="row" dir="rtl">

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> تسكين المعلم </h4>
                            </div>
                            <div class="modal-body">
                                <form :model="form">

                                    <div class="form-group">
                                        <label for="category_id"> المرحلة الدراسية :</label>
                                        <el-select v-model="form.grade_id" v-on:change="getYear(form.grade_id)"
                                                   filterable placeholder=" اختار مرحلة دراسية"
                                                   id="category_id">
                                            <el-option
                                                    v-for="grade in Grade"
                                                    :key="grade.grade_id"
                                                    :label="grade.grade"
                                                    :value="grade.grade_id">
                                            </el-option>
                                        </el-select>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="category_id"> السنة الدراسية :</label>
                                        <el-select v-model="form.year_id"
                                                   v-on:change="getSubject(form.year_id,form.grade_id)" filterable
                                                   placeholder=" اختار سنةدراسية "
                                                   id="category_id">
                                            <el-option
                                                    v-for="year in Year"
                                                    :key="year.year_id"
                                                    :label="year.year"
                                                    :value="year.year_id">
                                            </el-option>
                                        </el-select>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id"> المادة :</label>
                                        <el-select v-model="form.subject_id" filterable placeholder=" اختار سنةدراسية "
                                                   id="category_id">
                                            <el-option
                                                    v-for="subject in Subject"
                                                    :key="subject.subject_id"
                                                    :label="subject.name"
                                                    :value="subject.subject_id">
                                            </el-option>
                                        </el-select>

                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" @click="assgin()">حفظ

                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Close()">اغلاق
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


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
            <script src="{{asset('AppAdmin/teacherassgign.js')}}"></script>
@endsection