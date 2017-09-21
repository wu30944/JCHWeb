@extends('admin.layouts.base')

@section('title','404')

@section('pageHeader','錯誤')

@section('pageDesc','頁面找不到')

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content" style="padding-top: 30px">
            <h3><i class="fa fa-warning text-yellow"></i>  頁面找不到.</h3>

            <p>
                頁面沒找到.
                此時你可以返回<a href="{{route('admin.index')}}"> 首頁 </a>.
            </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->



@endsection


@section('js')

@endsection