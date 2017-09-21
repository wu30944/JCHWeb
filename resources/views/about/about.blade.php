@extends('TmpView.tmp')

@section('title','關於我們')

@section('content')

    <section class='container'>

        <!-- Page Content -->
        <div class="content full">

            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1 class="page-header"> @lang('function_title.about_jch')
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <div class="lgray-bg">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home"> @lang('default.home')</a>
                            </li>
                            <li class="active"> @lang('function_title.about_jch')</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Content Row -->
            <div class="row">
                <!-- Map Column -->
                <div class="col-md-8">
                    <!-- Embedded Google Map -->
            <iframe src="{{$jchinfo['MAP']}}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    {{-- <iframe width="100%" height="400px" frameborder="0" scrolling="no" 
                    marginheight="0" marginwidth="0" 
                    src="http://maps.google.com/maps?hl=zh-TW&amp;ie=UTF8&amp;ll=25.0521101,121.5183149,&amp;spn=25.0521101,121.5183149,&amp;t=m&amp;z=4&amp;output=embed"></iframe> --}}
                </div>
                <!-- Contact Details Column -->
                <div class="col-md-4">
                    <h3><label for="">{{$jchinfo['CNAME']}}</label></h3>
                    <p><span class="glyphicon glyphicon-map-marker"></span> @lang('default.address'): {{$jchinfo['ADDRESS']}}
                    </p>
                    <p><span class="glyphicon glyphicon-phone-alt"></span> 
                       @lang('default.phone'): {{$jchinfo['PHONE']}} </p>
                        <p><span class="glyphicon glyphicon-print"></span> @lang('default.fex'): {{$jchinfo['FEX']}} </p>
                    <p><span class="glyphicon glyphicon-envelope"></span>
                        <abbr title="Email">@lang('default.email')</abbr>: <a href="mailto:{{$jchinfo['EMAIL']}}">{{$jchinfo['EMAIL']}}</a>
                    </p>
                    <p>@lang('default.uniform_number'): {{$jchinfo['UNIFORM']}}
                    </p>
                
                    <ul class="list-unstyled list-inline list-social-icons">
                        <li>
                            <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
@stop


