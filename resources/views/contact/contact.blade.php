@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="about">

        <div class="panel panel-head">عن التطبيق والشروط والاحكام</div>


        <div class="row">
            <label> الجوال / الواتساب </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="عن التطبيق  "
                    v-model="aboutPolicy.phone_whatsapp">
            </el-input>
            <br>
            <br>


            <label for="">البريد الالكترونى </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="الشروط والاحكام "
                    v-model="aboutPolicy.email">
            </el-input>
            <label for="">الموقع الالكترونى </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="الشروط والاحكام "
                    v-model="aboutPolicy.website">
            </el-input>
            <label for="">العنوان </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="الشروط والاحكام "
                    v-model="aboutPolicy.address">
            </el-input>
            <br>
            <br>
            <br>
            <button class="btn btn-success" @click="updateAbout()"> @{{ save }}</button>
        </div>


    </div>

@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/contact.js')}}"></script>
@endsection