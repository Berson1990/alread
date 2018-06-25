@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="year">
        <div class="row">

            <br>
            <data-tables :data="yearData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal">اضافة سنة دراسية جديدة
                        </el-button>
                    </el-col>
                </el-row>
                <el-table-column label="تعديل">
                    <template slot-scope="scope">
                        <el-button
                                data-toggle="modal"
                                data-target="#myModal"
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="handleEdit(scope.$index, scope.row)">تعديل
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column
                        prop="year"
                        label="اسم السنة الدراسية"
                >
                </el-table-column>
                <el-table-column
                        prop="grade"
                        label="المرحله التابع لها السنه"
                >
                </el-table-column>


                <el-table-column label="حذف">
                    <template slot-scope="scope">

                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">حذف
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
                                <h4 class="modal-title"> السنين الدراسية </h4>
                            </div>
                            <div class="modal-body">
                                <form :model="form">

                                    <div class="form-group">
                                        <label for="grade_id"> المرحلة الدراسية :</label>
                                        <el-select v-model="form.grade_id" filterable placeholder=" اختار مرحلة دراسية"
                                                   id="grade_id">
                                            <el-option
                                                    v-for="grade in Grade"
                                                    :key="grade.grade_id"
                                                    :label="grade.grade"
                                                    :value="grade.grade_id">
                                            </el-option>
                                        </el-select>

                                    </div>

                                    <div class="form-group">
                                        <label for="name_ar">السنة الدراسية</label>
                                        <input v-model="form.year" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder="ادخل السنة الدراسية  " name="email">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" @click="Save()">حفظ

                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Close()">اغلاق
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

        @endsection

        @section('page-script-level')
            <script src="{{asset('AppAdmin/year.js')}}"></script>
@endsection