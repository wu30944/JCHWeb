@extends('admin.layouts.base')

@section('title','403')

@section('pageHeader','錯誤')

@section('pageDesc','没有權限')

@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content" style="padding-top: 30px">
            <h3><i class="fa fa-warning text-yellow"></i>  没有權限.</h3>

            <p>
                没有權限.
                你可以返回<a href="{{route('admin.index')}}"> 首頁 </a> 或者返回 <a href="{{$previousUrl}}"> 上一頁 </a>.
            </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->


@endsection


@section('js')

@endsection