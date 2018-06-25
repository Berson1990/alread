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
            <label> عن التطبيق </label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="عن التطبيق  "
                    v-model="aboutPolicy.about">
            </el-input>
            <br>
            <br>


            <label for="">الشروط والاحكام </label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="الشروط والاحكام "
                    v-model="aboutPolicy.policy">
            </el-input>

            <button class="btn btn-success" @click="updateAbout()"> @{{ save }}</button>
        </div>


    </div>

@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/about.js')}}"></script>
@endsection