
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="建成基督長老教會">
<meta name="keywords" content="建成教會,建成基督長老教會,教會,建成" />
<meta name="author" content="">
<meta http-equiv="Pragma" content="no-cache">
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


{{--2017/09/20 從AdminLET拉過來的 載入畫面 loding--}}
<link href="/dist/css/load/load.css" rel="stylesheet">

<title>
@if(isset($page_title))
		{{$page_title}}| 建成教會
	@else
         @yield('title') | 建成教會
    @endif
</title>

@yield('css')
</head>

<body>

<!-- navigation為導覽 -->
@include('inc.navigation')

@include('inc.loading')
<!-- content就是我們點選後，要顯示的內容 -->
@yield('content')

@include('inc.footer')


{{-- 2017/08/28 新增使用ajax也是可以使用上一頁下一頁 --}}
{{-- <script src="../js/history.js"></script> --}}
<script src="/dist/js/common.js"></script>
    {{--20170913 下方js是載入畫面轉轉轉的部分--}}
{{-- <script src="../loading/spin.js"></script> --}}
<script src="../loading/LoadingScreen.js"></script>

    {{--20180114 相片插件--}}
<script src="{{asset('js/JqueryCyclePlug/jquery.cycle.js')}}"></script>

<!-- JAVASCRIPTS -->
<!-- Script to Activate the Carousel -->
@include('inc.initialjs')

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.ui.js"></script>

@yield('js')

</body>
</html>