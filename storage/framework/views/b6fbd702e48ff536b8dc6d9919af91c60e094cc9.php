<?php $__env->startSection('page-style-level'); ?>
    <style>
        .dir {
            direction: rtl;
        }

        .el-form-item__label {
            float: right;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="Placement">
        <div class="row">
            <br>
            <data-tables
                    v-loading="loading"
                    :data="PlacementData"
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
                            اضافة مستوى
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
                        prop="placement"
                        label="المستوى"
                >
                </el-table-column>
                <el-table-column
                        prop="placement_duration"
                        label="المدة الزمنية"
                >
                </el-table-column>
                <el-table-column
                        prop="correct_quetisons_from"
                        label="عدد الاسئلة الصحيحة من"
                >
                </el-table-column>
                <el-table-column
                        prop="correct_quetisons_to"
                        label="عدد الاسئلة الصحيحة الى"
                >
                </el-table-column>

                <el-table-column
                        prop="correct_final_exam_from"
                        label="عدد الاسئله الصحيحة للنجاح فى المستوى من"
                >
                </el-table-column>
                <el-table-column
                        prop="correct_final_exam_to"
                        label="عدد الاسئله الصحيحة للنجاح فى المستوى الى"
                >
                </el-table-column>
                <el-table-column   width="150" label="اختبار نهاية الدورة">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="primary"

                                @click="GotToAddFinalPlacementExam(scope.$index, scope.row)">اختبار نهاية الدورة
                        </el-button>
                    </template>
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

        
        <el-dialog title="" :visible.sync="dialogFormVisible" custom-class="dir" v-loading="loading">
            <el-form :model="PlacementForm">
                <el-form-item label="المستوى" :label-width="formLabelWidth">
                    <el-input placeholder="المستوى " v-model="PlacementForm.placement"></el-input>
                </el-form-item>
                <el-form-item label="مدة المستوى" :label-width="formLabelWidth">
                    <el-input placeholder="مدة المستوى" v-model="PlacementForm.placement_duration"></el-input>
                </el-form-item>
                <el-form-item label="عدد الاسئله الصحيحة للدخول الى المستوى من" :label-width="formLabelWidth">
                    <el-input placeholder="عدد الاسئله الصحيحة للدخول الى المستوى من "
                              v-model="PlacementForm.correct_quetisons_from"></el-input>
                </el-form-item>
                <el-form-item label=" عدد الاسئله الصحيحة للدخول الى المستوى الى" :label-width="formLabelWidth">
                    <el-input placeholder=" عدد الاسئله الصحيحة للدخول الى المستوى الى"
                              v-model="PlacementForm.correct_quetisons_to"></el-input>
                </el-form-item>
                <el-form-item label="عدد الاسئله الصحيحة للنجاح فى المستوى من" :label-width="formLabelWidth">
                    <el-input placeholder=" عدد الاسئله الصحيحة للنجاح فى المستوى من   "
                              v-model="PlacementForm.correct_final_exam_from"></el-input>
                </el-form-item>
                <el-form-item label="عدد الاسئله الصحيحة للنجاح فى المستوى الى" :label-width="formLabelWidth">
                    <el-input placeholder="عدد الاسئله الصحيحة للنجاح فى المستوى الى "
                              v-model="PlacementForm.correct_final_exam_to"></el-input>
                </el-form-item>

            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button type="success" @click="Save(dialogFormVisible = false)">حفظ</el-button>
    <el-button type="danger" @click="dialogFormVisible = false">الغاء</el-button>
  </span>
        </el-dialog>

        


    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script-level'); ?>
    <script src="<?php echo e(asset('AppAdmin/placement.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminapp.adminapp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>