@extends('TmpView.tmp')
@section('title','最新消息')
@section('content')

{{--此處在畫面顯示成功訊息--}}
@if (Session::has('flash_message'))
 <div class="alert alert-success {{ Session::has('flash_message_important') ?'': 'alert-important'}}">
    {{-- expr --}}
   
    {{--下面的BUTTON是用來關閉提示訊息的視窗--}}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('flash_message') }}
</div>
@endif


<section class='container'>

{{-- pull-right 這個是將按鈕切到右邊 --}}
<a href=" {{ url('article/create') }}" role="btn" class="btn btn-primary pull-right">新增</a> 

 <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">最新消息
                {{-- <small>Subheading</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">最新消息</a>
                                        </li>
                <li class="active">Contact</li>
                     </ol>
        </div>
</div>

{{-- <table class='table table-hover'>  --}}
<table id="gridview" class="display" cellspacing="0" width="100%">
{{--如果想要關閉Search:在jquery.dataTables.min.js當中的第144行，sSearch:後方就是該畫面文字
	如果想要關閉Search後面的Textbox則是在jquery.dataTables.min.js中的第40行 g參數後方--}}
        <thead>
            <tr>
                <th>Name</th>
                           <th>Position</th>
                <th>Office</th>
                <th>Age</th>
            </tr>
        </thead>
{{--         <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
            </tr>
        </tfoot> --}}
        <tbody>
		@foreach ($query as $var)
		<tr>
			<td>{{$var->id}}</td>
			<td>{{$var->title}}</td>
			<td><a href="{{ url('article/'.$var->id.'/edit') }}" role="btn" class ="btn btn-warning">編輯</a></td>
			<td><a href="{{ url('article/'.$var->id.'/delete') }}" role="btn" class ="btn btn-danger">刪除</a></td>
		</tr>
		@endforeach
        
        </tbody>
</table>
</section>
@stop