@extends('adminapp.adminapp')
@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection
@section('content')
    <div id="teachermanagment">

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
                    label="اسم المعلم "
            >
            </el-table-column>

            <el-table-column
                    prop="phone"
                    label='الجوال '
            >
            </el-table-column>

            <el-table-column
                    prop="mail"
                    label="البريد الالكترونى"
            >
            </el-table-column>

            <el-table-column label="حظر \ فك الحظر عن معلم">
                <template slot-scope="scope">

                    <el-button
                            v-if="scope.row.state === 0"
                            class="el-icon-edit"
                            size="medium"
                            type="danger"
                            @click="update(scope.$index, scope.row,1)">محظور
                    </el-button>
                    <el-button
                            v-if="scope.row.state === 1"
                            class="el-icon-edit"
                            size="medium"
                            type="success"
                            @click="update(scope.$index, scope.row,0)">مفعل
                    </el-button>
                </template>
            </el-table-column>



        </data-tables>


    </div>
@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/teachermanagment.js')}}"></script>
@endsection