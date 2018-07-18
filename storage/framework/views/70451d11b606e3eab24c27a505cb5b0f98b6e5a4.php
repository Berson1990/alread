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
    <div id="PlacementPayment">
        <div class="row">
            <br>
            <data-tables
                    v-loading="loading"
                    :data="PlacementPaymentData"
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

                <el-table-column
                        prop="users.name"
                        label="اسم الطالب"
                >
                </el-table-column>
                <el-table-column
                        prop="placement.placement"
                        label="المستوى"
                >
                </el-table-column>
                <el-table-column

                        label="حاله الدفع"
                >
                    <template slot-scope="scope">
                      
                        <el-button v-show="scope.row.payment===1" type="success">تم الدفع</el-button>
                        <el-button v-show="scope.row.payment===0" type="danger">لم يتم الدفع</el-button>
                    </template>
                </el-table-column>

        </div>

        
        <el-dialog title="" :visible.sync="dialogFormVisible" custom-class="dir" v-loading="loading">
            <el-form :model="PlacementExamForm">
                <el-form-item label="السؤال" :label-width="formLabelWidth">

                    <el-input
                            type="textarea"
                            placeholder="السؤال "
                            :autosize="{ minRows: 5, maxRows: 10}"
                            v-model="PlacementExamForm.question"
                    >
                    </el-input>
                </el-form-item>
                <el-form-item label="الاجابه الاولى" :label-width="formLabelWidth">
                    <el-input placeholder=" الاجابه الاولى" v-model="PlacementExamForm.answer1"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الثانية" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الثانيه"
                              v-model="PlacementExamForm.answer2"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الثالثة" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الثالثة" v-model="PlacementExamForm.answer3"></el-input>
                </el-form-item>
                <el-form-item label="الاجابه الصحيحة" :label-width="formLabelWidth">
                    <el-input placeholder="الاجابه الصحيحة" v-model="PlacementExamForm.correct"></el-input>
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
    <script src="<?php echo e(asset('AppAdmin/placementpaymennt.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminapp.adminapp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>