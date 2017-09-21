@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>

<div class="content full">
     <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">@lang('function_title.meeting_info')
                {{-- <small>Subheading</small> --}}
            </h1>
            <div class="lgray-bg ">
                <div class="container:before">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home"> @lang('function_title.home')</a>
                        </li>
                        <li class="active">@lang('function_title.meeting_info')</li>
                    </ol>
                </div>    
            </div>
        </div>
    </div>
    {{-- @if(Auth::check()) --}}
    {{-- pull-right 這個是將按鈕切到右邊 --}}
    {{--     <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
    @endif
     --}}
    {{-- <table class='table table-hover'>  --}}
    <table id="gridview" class="text-center table-striped table-hover table" cellspacing="0" width="60%">
    {{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
        如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
            <thead>
                <tr >
                    <th class="text-center">@lang('default.fellowship')</th>
                    <th class="text-center">@lang('default.meeting_time')</th>
                    <th class="text-center">@lang('default.day')</th>
                    <th class="text-center">@lang('default.floor_1')</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dtMeetingInfo as $var)
            <tr>
                <td><a href="{{route('fellowship',$var->fellowship_id)}}">{{$var->name}}</a></td>
                <td>{{$var->meeting_time}}</td>
                <td>{{$var->day}}</td>
                <td>{{$var->floor}} @lang('default.floor_2')</td>
            </tr>
            @endforeach
            
            </tbody>
    </table>
</div>
</section>
@stop