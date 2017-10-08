@extends('TmpView.tmp')

@section('title','最新消息')

@section('content')

<section class='container'>
<!-- Page Heading/Breadcrumbs -->
<div class="content full">
     <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">@lang('function_title.news')
                    {{-- <small>Subheading</small> --}}
                </h1>
                <div class="lgray-bg ">
                    <div class="container:after">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home"> @lang('function_title.home')</a>
                            </li>
                            <li><a href="{{route('news')}}">@lang('function_title.news')</a>
                            </li>
                            <li class="active">
                            @if (isset($dtNews))
                                 @foreach ($dtNews as $News)
                                    {{$News->title}}
                                 @endforeach
                            @endif
                            </li>
                        </ol>
                    </div>    
                </div>
            </div>
    </div>
	 
        <!-- /.row -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                @if (isset($dtNews))
                    @foreach ($dtNews as $News)

                          <!-- First Blog Post -->
                            <h1>
                                {{$News->title}}
                            </h1>
                            <p><i class="fa fa-clock-o"></i></p>
                            <hr>
                            <h3>
                            @if ( !empty($News->action_date))
                                <span class="glyphicon glyphicon-calendar"></span>
                                <label>@lang('default.date'):</label>{{$News->action_date}}
                            @endif
                            @if ( !empty($News->action_time))
                                 <span class="glyphicon glyphicon-time"></span>
                                <label>@lang('default.time'):</label>{{$News->action_time}}
                            @endif
                            @if ( !empty($News->action_postion))
                                
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <label>@lang('default.action_postion'):</label>{{$News->action_postion}}
                            @endif

                            @if ( !empty($News->image))
                                <div align="left">
                                 <img class="img-responsive img-hover" src="{{$News->image}}" alt="" style="max-width: 550; max-height: 300px;">
                                <br>
                                  </div>  
                            @endif
                            </h3>
                             {!!$News->content!!}
                    @endforeach
                @endif

            </div>
    	</div>
    </div>
</section>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../js/ckeditor_api.js"></script>

@stop