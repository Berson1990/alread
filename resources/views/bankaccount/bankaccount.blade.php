@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="bankaccount">
        <div class="row">

            <br>
            <data-tables :data="bankaccountData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">
                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal">اضافة حساب بنكى
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
                        prop="account_no"
                        label=" رقم الحساب"
                >
                </el-table-column>
                <el-table-column
                        prop="owner_name"
                        label="اسم صاحب الحساب"
                >
                </el-table-column>
                <el-table-column
                        prop="swift_code"
                        label="رقم الايبان"
                >

                </el-table-column>
                <el-table-column
                        prop="bank_name"
                        label="اسم البنك"
                >
                </el-table-column>
                {{--<el-table-column--}}
                        {{--label="صوة البنك"--}}
                {{-->--}}
                    {{--<template slot-scope="scope">--}}
                        {{--<img class="img-responsive" :src=scope.row.imge style="width: 40px ;height: 40px">--}}
                    {{--</template>--}}
                {{--</el-table-column>--}}

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
                                <h4 class="modal-title"> الحساب البنكى </h4>
                            </div>
                            <div class="modal-body">
                                <form :model="form">

                                    <div class="form-group">
                                        <label for="name_ar">رقم الحساب </label>
                                        <input v-model="form.account_no" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder="رقم الحساب " name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="name_ar">اسم صاحب الحساب </label>
                                        <input v-model="form.owner_name" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder="اسم صاحب الحساب  " name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="name_ar"> رقم الايبان </label>
                                        <input v-model="form.swift_code" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder=" رقم الايبان  " name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="name_ar">اسم  البنك </label>
                                        <input v-model="form.bank_name" type="text" class="form-control" id="name_ar"
                                               required
                                               placeholder="اسم البنك" name="email">
                                    </div>


                                    <div class="form-group">
                                        <label for="item_imge">صورة البنك </label>
                                        <input type="file" class="form-control" id="SalesCat_img">
                                        <br>
                                    </div>
                                    <div class="form-group">
                                        <img class="img-responsive" :src=form.imge />
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
            <script src="{{asset('AppAdmin/bankaccount.js')}}"></script>
@endsection