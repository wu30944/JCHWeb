@if(isset($fellowship_info) and count($fellowship_info)===1)

        @extends('TmpView.tmp')

        {{--@section('title','社青團契')--}}

        @section('content')
        <section class='container'>
            <div class="content full">
             <!-- Page Heading/Breadcrumbs -->

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header"><strong>{{$fellowship_info->name}}</strong>
                                {{-- <small>Subheading</small> --}}
                        </h1>
                        <div class="lgray-bg ">
                            <div class="container:before">
                                <ol class="breadcrumb">
                                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home"> @lang('default.home')</a>
                                </li>
                                <li class="active">{{$fellowship_info->name}}</li>
                            </ol>
                            </div>    
                        </div>
                    </div>
                </div>


                         <!-- Intro Content -->
                    <div class="row">
                        <div class="col-md-6" align="center">
                            <img class="img-responsive" src="{{$Image}}" alt=""  style="max-width: 500; max-height: 290px;">
                        </div>
                        <div class="col-md-6">
                            <h2>{{$fellowship_info->introduction_title}}</h2>
                            {!!$fellowship_info->introduction_content!!}
                        </div>
                    </div>
                    <!-- /.row -->   

                <!-- Service Tabs -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">@lang('default.introduction')</h2>
                    </div>
                    <div class="col-lg-12">

                        <ul id="myTab" class="nav nav-tabs nav-justified">
                            @if(isset($fellowship_info->page_one_title))
                            <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-star"></i> {{$fellowship_info->page_one_title}}</a>
                            </li>
                            @endif
                             @if($fellowship_info->page_two_title!='')
                            <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-star"></i> {{$fellowship_info->page_two_title}}</a>
                            </li>
                            @endif
                             @if($fellowship_info->page_three_title!='')
                            <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-star"></i> {{$fellowship_info->page_three_title}}</a>
                            </li>
                            @endif
                             @if($fellowship_info->page_four_title!='')
                            <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-star"></i> {{$fellowship_info->page_four_title}}</a>
                            </li>
                            @endif
                        </ul>{{--   
                            <div class="col-md-1"></div> --}}
                            <div id="myTabContent" class="tab-content col-md-10">
                             @if($fellowship_info->page_one_title!='')
                                <div class="tab-pane fade active in" id="service-one">
                                    {!!$fellowship_info->page_one_content!!}
                                </div>
                             @endif
                             @if($fellowship_info->page_two_title!='')
                                <div class="tab-pane fade" id="service-two">
                                     {!!  $fellowship_info->page_two_content!!}
                                    {{-- <p>{{$fellowship_info->page_two_content}}</p> --}}
                                </div>
                             @endif
                             @if($fellowship_info->page_three_title!='')
                                <div class="tab-pane fade" id="service-three">
                                    {!!$fellowship_info->page_three_content!!}
                                </div>
                             @endif
                             @if($fellowship_info->page_four_title!='')
                                <div class="tab-pane fade" id="service-four">
                                    {!! $fellowship_info->page_four_content !!}
                                </div>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </section>
         @stop
 @endif