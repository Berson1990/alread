@extends('adminapp.adminapp')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="dashborad">
        <br><br>
        <div class="contanier-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{student }}</div>
                                    <div>عدد الطلاب</div>
                                </div>
                            </div>
                        </div>
                        {{--<a href="{{url('/studentmangmnet')}}">--}}
                            {{--<div class="panel-footer">--}}
                                {{--<span class="pull-left"> التفاصيل</span>--}}
                                {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{ teacher }}</div>
                                    <div>عدد المدرسين</div>
                                </div>
                            </div>
                        </div>
                        {{--<a href="{{url('/teachermanagment')}}">--}}
                            {{--<div class="panel-footer">--}}
                                {{--<span class="pull-left"> التفاصيل</span>--}}
                                {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{ lesson }}</div>
                                    <div>عدد الدروس</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{ question }}</div>
                                    <div>عدد الاسئلة</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{ answer }}</div>
                                    <div>عدد الاجابات</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge">@{{ questionreport }}</div>
                                    <div>عدد الشكاوى</div>
                                </div>
                            </div>
                        </div>
                        {{--<a href="{{url('/reportquestion')}}">--}}
                            {{--<div class="panel-footer">--}}
                                {{--<span class="pull-left"> التفاصيل</span>--}}
                                {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                                {{--<div class="clearfix"></div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script-level')
    <script src="{{asset('AppAdmin/Dashbord.js')}}"></script>
@endsection