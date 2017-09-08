@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
	如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>


 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">聚會資訊
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">首頁</a>
                </li>
                <li class="active">聚會資訊</li>
            </ol>

        </div>
</div>
@if(Auth::check())
{{-- pull-right 這個是將按鈕切到右邊 --}}
    <a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 
@endif
{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="text-center table-striped" cellspacing="0" width="70%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
    如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dtMeetingInfo as $var)
        <tr>
            <td>{{$var->name}}</td>
            <td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
            <td>{{$var->floor}} 樓</td>
            <td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
        </tr>
        @endforeach
        
        </tbody>
</table>
</section>
@stop
            <tr >
                <th class="text-center">團契</th>
                <th class="text-center">聚會時間</th>
                <th class="text-center">日</th>
                <th class="text-center">樓層</th>
                <th class="hidden">Age</th>
            </tr>
        </thead>
        <tbody>
		@foreach ($dtMeetingInfo as $var)
		<tr>
			<td>{{$var->name}}</td>
			<td>{{$var->meeting_time}}</td>
            <td>{{$var->day}}</td>
			<td>{{$var->floor}} 樓</td>
			<td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger hidden">刪除</a></td>
		</tr>
		@endforeach
        
        </tbody>
</table>
</section>
@stop