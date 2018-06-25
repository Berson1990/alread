@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection
@section('content')
    <script type="text/javascript">
        teachersput = <?php echo json_encode(Session::get('teachersput'));?>
    </script>

    <div class="sp-50"></div>
    <div id="mytest">
        <div class="row">

            <br>
            <data-tables :data="TestData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal"
                                   @click="AddEdit(null,{},false)">اضافة اختبار جديد
                        </el-button>
                    </el-col>
                </el-row>
                <el-table-column label="اضف اسئله للاختبار">
                    <template slot-scope="scope">
                        <el-button
                                data-toggle="modal"
                                data-target="#myModal"
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="AddEdit(scope.$index,scope.row,true)"
                        >
                            تعديل الاختبار
                        </el-button>
                    </template>
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="المادة"
                >
                </el-table-column>
                <el-table-column
                        prop="grade"
                        label="المرحلة"
                >
                </el-table-column>
                <el-table-column
                        prop="year"
                        label="السنة الدراسية"
                >
                </el-table-column>
                <el-table-column
                        prop="week"
                        label="الاسبوع"
                >
                </el-table-column>

                <el-table-column label="حذف/اضافة اسئله اضافيه">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="showModalTest(scope.$index , scope.row)">
                            حذف/اضافة اسئله اضافيه
                        </el-button>
                    </template>

                </el-table-column>
                <el-table-column label="حذف الاختبار">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="danger"
                                @click="deletetest(scope.$index , scope.row)">حذف الاختبار
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
                                <h4 class="modal-title"> الاختبار </h4>
                            </div>
                            <div class="modal-body">
                                <form :model="form">
                                    <div class="form-group">
                                        <label for="category_id"> السنة الدراسية :</label>

                                    </div>
                                    <div class="form-group">
                                        <el-select v-model="form.year_id"
                                                   v-on:change="getSubject(form.year_id,form.grade_id)" filterable
                                                   placeholder=" اختار سنة دراسية "
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

                                    </div>
                                    <div class="form-group">
                                        <el-select v-model="form.subject_id" filterable placeholder=" اختار المادة  "
                                                   id="category_id">
                                            <el-option
                                                    v-for="subject in Subject"
                                                    :key="subject.subject_id"
                                                    :label="subject.name"
                                                    :value="subject.subject_id">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id"> الاسابيع الدراسية :</label>

                                    </div>
                                    <div class="form-group">
                                        <el-select v-model="form.week_id"
                                                   filterable
                                                   placeholder=" اختار الاسبوع "
                                                   id="category_id">
                                            <el-option
                                                    v-for="week in Week"
                                                    :key="week.week_id"
                                                    :label="week.week"
                                                    :value="week.week_id">
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="form-group">
                                        <label v-show="!isEditMode">اسئلة الاختبار</label>
                                    </div>
                                    <div v-show="!isEditMode" v-for="quetsions in quetsions">

                                        <div class="form-group">
                                            <label for="quetsion"> السؤال </label>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" id="quetsion"
                                                   v-model="quetsions.quetsion">
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" v-bind:value={correct:correct1}
                                                   v-model="quetsions.correct">
                                            <input class="form-control" v-model="quetsions.answer1"
                                                   @input="correct1 = $event.target.value">
                                            <input type="radio" v-bind:value={correct:correct2}
                                                   v-model="quetsions.correct">
                                            <input v-model="quetsions.answer2" class="form-control"
                                                   @input="correct2 = $event.target.value">
                                            <input type="radio" v-bind:value={correct:correct3}
                                                   v-model="quetsions.correct">
                                            <input class="form-control" v-model="quetsions.answer3"
                                                   @input="correct3 = $event.target.value">

                                        </div>
                                    </div>
                                    <button v-show="!isEditMode" type="button" class="el-icon-circle-plus-outline"
                                            @click="AddNewQuestionsInUi()"> اضف سؤال جديد
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal" @click="Save()">
                                    حفظ

                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Close()">اغلاق
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <el-dialog title="Shipping address" :visible.sync="dialogTableVisible">
                <table class="table table table-bordred">
                    <thead>
                    <tr>
                        <td>السؤال</td>
                        <td>الاجابه الاولى</td>
                        <td>الاجابه الثانية</td>
                        <td>الاجابه الثالثة</td>
                        <td>الاجابه الصحيحة</td>
                        <td> حذف السؤال</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(quetsions,index) in testQuestion">
                        <td>@{{quetsions.questaion}}</td>
                        <td>@{{quetsions.answer_1}}</td>
                        <td>@{{quetsions.answer_2}}</td>
                        <td>@{{quetsions.answer_3}}</td>
                        <td>@{{quetsions.correct}}</td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="deleteAuestion(index,quetsions,testQuestion)">حذف السؤال</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <hr>
                <div class="form-group">
                    <label for="quetsion"> السؤال </label>
                </div>
                <div class="form-group">
                    <input class="form-control" id="quetsion" v-model="questsionEdit.questaion">
                </div>
                <div class="form-group">
                    <input type="radio" v-bind:value={correct:correct1} v-model="questsionEdit.correct">
                    <input class="form-control" v-model="questsionEdit.answer_1" @input="correct1 = $event.target.value">
                    <input type="radio" v-bind:value={correct:correct2} v-model="questsionEdit.correct">
                    <input v-model="questsionEdit.answer_2" class="form-control" @input="correct2 = $event.target.value">
                    <input type="radio" v-bind:value={correct:correct3} v-model="questsionEdit.correct">
                    <input class="form-control" v-model="questsionEdit.answer_3" @input="correct3 = $event.target.value">
                </div>
                <button type="button" class="btn btn-success" @click="addNewQuestion(testQuestion)">اضافة سؤال جديد</button>
            </el-dialog>
        </div>
    </div>




@endsection
@section('page-script-level')
    <script src={{asset("AdminScript/mytest.js")}}></script>

@endsection