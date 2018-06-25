@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="week">
        <div class="row">

            <br>
            <data-tables :data="weekData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal">اضافة  اسابيع
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
                        prop="week"
                        label="الاسبوع"
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
                                <h4 class="modal-title"> الاسابيع الدراسية  </h4>
                            </div>
                            <div class="modal-body">
                                <form :model="form">

                                    <div class="form-group">
                                        <label for="name_ar">الاسبوع </label>
                                        <input v-model="form.week" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder="ادخل اسبوع" name="email">
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
            <script src="{{asset('AppAdmin/week.js')}}"></script>
@endsection