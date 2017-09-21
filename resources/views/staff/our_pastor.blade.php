

        @extends('TmpView.tmp')

        @section('title','我們的牧師')

        @section('content')
        <section class='container'>
               <div class="content full">
                 <!-- Page Heading/Breadcrumbs -->
                    <div class="row">
                        <div class="col-md-12">
                             <h1 class="page-header"><strong>@lang('function_title.our_pastor')</strong>
                            </h1>
                            <div class="lgray-bg ">
                                <div class="container:before">
                                    <ol class="breadcrumb">
                                        <li><span class="glyphicon glyphicon glyphicon-home"> <a href="{{url('/')}}">@lang('default.home')</a>
                                        </li>
                                        <li class="active">@lang('function_title.our_pastor')</li>
                                    </ol>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="row">
{{--                         <div class="col-lg-12">
                            <h2 class="page-header">Service Tabs</h2>
                        </div> --}}
                        <div class="col-lg-12">

                            <ul id="myTab" class="nav nav-tabs nav-justified">
                                @if(isset($dtPastor) && count($dtPastor)>0)

                                    @for($i=0;$i<count($dtPastor);$i++)
                                        @if($i==0)
                                            <li class="active"><a href="#service_{{$dtPastor[$i]->name}}" data-toggle="tab"><i class="fa fa-car"></i>
                                            {{$dtPastor[$i]->name}} @lang('default.pastor')</a>
                                            </li>  
                                        @else
                                            <li class=""><a href="#service_{{$dtPastor[$i]->name}}" data-toggle="tab"><i class="fa fa-car"></i>
                                            {{$dtPastor[$i]->name}} @lang('default.pastor')
                                            </a>
                                            </li>  
                                        @endif     
                                    @endfor
                                @endif
             
                            </ul>

                            <div id="myTabContent" class="tab-content col-md-12">

                                 @if(isset($dtPastor) && count($dtPastor)>0)
                                    @foreach($dtPastor as $Item)
                                        <div class="tab-pane fade active in" id="service_{{$Item->name}}">
                                         {!!$Item->content!!}
                                         </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
        </section>
         @stop
