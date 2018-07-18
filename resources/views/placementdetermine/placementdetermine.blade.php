@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

        .el-form-item__label {
            float: right;
        }
    </style>
@endsection

@section('content')
    <div id="PlacementDetermine">
        <div class="row">
            <br>
            <data-tables
                    v-loading="loading"
                    :data="PlacementQuestionsData"
                    :show-action-bar="false"
                    :custom-filters="customFilters"
                    :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" @click="AddEdit({},{},isEditMode = false,dialogFormVisible=true)">
                            اضافة سؤال
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
                                @click="AddEdit(scope.$index, scope.row,isEditMode = true,dialogFormVisible= true)">
                            تعديل
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column
                        prop="question"
                        label="السؤال"
                >
                </el-table-column>
                <el-table-column
                        prop="answer1"
                        label="الاجابه الاولى"
                >
                </el-table-column>
                <el-table-column
                        prop="answer2"
                        label="الاجابه الثانيه"
                >
                </el-table-column>
                <el-table-column
                        prop="answer3"
                        label="الاجابه الثالثة"
                >
                </el-table-column>

                <el-table-column
                        prop="correct"
                        label="الاجابه الصحيحة"
                >
                </el-table-column>
                <el-table-column label="حذف">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="Delete(scope.$index, scope.row)">حذف
                        </el-button>
                    </template>
                </el-table-column>
            </data-tables>
        </div>

        {{--dialog start--}}
        <el-dialog title="" :visible.sync="dialogFormVisible" custom-class="dir" v-loading="loading">
            <el-form :model="PlacementDeterminForm">
                <el-form-item label="السؤال" :label-width="formLabelWidth">

                    <el-input
                            type="textarea"
                            placeholder="السؤال "
                            :autosize="{ minRows: 5, maxRows: 10}"
                            v-model="PlacementDeterminForm.question"
                    >
                    </el-input>
                </el-form-item>
                <el-form-item label="الاجابه الاولى" :label-width="formLabelWidth">
                    <el-input placeholder=" الاجابه الاولى" v-model="PlacementDeterminForm.answer1"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الثانية" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الثانيه"
                              v-model="PlacementDeterminForm.answer2"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الثالثة" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الثالثة" v-model="PlacementDeterminForm.answer3"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الصحيحة" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الصحيحة" v-model="PlacementDeterminForm.correct"></el-input>
                </el-form-item>

            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button type="success" @click="Save(dialogFormVisible = false)">حفظ</el-button>
    <el-button type="danger" @click="dialogFormVisible = false">الغاء</el-button>
  </span>
        </el-dialog>

        {{--dialog end--}}


    </div>

@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/placementdetermine.js')}}"></script>
@endsection