@extends('TmpView.tmp')

@section('title','主日信息預告')

@section('content')

<section class='container'>

<div class="content full">
     <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">@lang('function_title.SundayPreview')
                {{-- <small>Subheading</small> --}}
            </h1>
            <div class="lgray-bg ">
                <div class="container:before">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home"> @lang('function_title.home')</a>
                        </li>
                        <li class="active">@lang('function_title.SundayPreview')</li>
                    </ol>
                </div>    
            </div>
        </div>
    </div>

        <div class="row">
            <h3><label for="">本週信息</label></h3>
        </div>

            <div class="row">
{{--                         <div class="col-lg-12">
                    <h2 class="page-header">Service Tabs</h2>
                </div> --}}
                <div class="col-lg-12">

                    <ul id="myTab" class="nav nav-tabs nav-justified">
                        @if(isset($dtLanguage) && count($dtLanguage)>0)

                            @for($i=0;$i<count($dtLanguage);$i++)
                                @if($i==0)
                                    <li class="active"><a href="#service_{{$dtLanguage[$i]->id}}" data-toggle="tab"><i class="fa fa-car"></i>
                                    {{$dtLanguage[$i]->cod_val}} @lang('default.sunday')</a>
                                    </li>  
                                @else
                                    <li class=""><a href="#service_{{$dtLanguage[$i]->id}}" data-toggle="tab"><i class="fa fa-car"></i>
                                    {{$dtLanguage[$i]->cod_val}} @lang('default.sunday')
                                    </a>
                                    </li>  
                                @endif     
                            @endfor
                        @endif
     
                    </ul>

                    <div id="myTabContent" class="tab-content col-md-12">                              
                         @if(isset($dtLanguage) && count($dtLanguage)>0)
                            @foreach($dtLanguage as $Item)
                                <div class="tab-pane fade active in" id="service_{{$Item->id}}">
                                      <table id="" class="text-center table-striped table-hover table" cellspacing="0">
                                        {{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
                                            如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
                                                <thead>
                                                    <tr >
                                                        <th class="text-center">@lang('default.date')</th>
                                                        <th class="text-center">@lang('default.subject')</th>
                                                        <th class="text-center">@lang('default.speaker')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($dtSundayPreview))
                                                    @foreach ($dtSundayPreview as $var)
                                                        @if($var->language_type===$Item->cod_id)
                                                            <tr>
                                                                <td>{{$var->date}}</td>
                                                                <td>{{$var->subject}}</td>
                                                                <td>{{$var->speaker}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </tbody>
                                        </table>
                                 </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

</div>
</section>
@stop