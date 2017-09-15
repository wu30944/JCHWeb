
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}" >
<link rel="stylesheet" href="{{ asset('css/modern-business.css')}}" >
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css')}}" >
<link rel="stylesheet" href="{{ asset('css/jquery.ui.css')}}" >
{{-- <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
 --}}{{-- 2017/05/18 新增日期相關jquery程式
	 css/jquery.datetimepicker.css
	 
 --}}

{{--loding--}}
<link href="/dist/css/load/load.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.css')}}" >
{{-- 2017/07/20.  新增CSS. 顯示日期包在框框內 --}}
<link rel="stylesheet" href="{{ asset('css/DateStyle.css')}}" >


    {{--<link rel="stylesheet" href="{{ asset('css/screen.css')}}" >--}}
{{-- 2017/08/28 新增使用ajax也是可以使用上一頁下一頁 --}}
{{-- <script src="../js/history.js"></script> --}}

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.ui.js"></script>

    {{--20170913 下方js是載入畫面轉轉轉的部分--}}
<script src="../loading/spin.js"></script>
<script src="../loading/LoadingScreen.js"></script>

<!-- JAVASCRIPTS -->
<!-- Script to Activate the Carousel -->
@include('inc.initialjs')

<title>
@if(isset($page_title))
		{{$page_title}}| 建成教會
	@else
         @yield('title') | 建成教會
    @endif
</title>

</head>