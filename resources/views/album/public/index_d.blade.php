@extends('TmpView.tmp')

@section('title','活動相簿')

@section('content')
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <section class='container'>
        <div class="content full">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">@lang('function_title.ActionAlbum')
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <div class="lgray-bg ">
                        <div class="container:before">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home">@lang('default.home')</a>
                                </li>
                                <li>
                                    <a href="{{route('album.Index')}}">
                                        @lang('function_title.ActionAlbum')
                                    </a>
                                </li>
                                <li class="active">
                                    {{$AlbumName}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Members -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center"></h2>
                </div>
                <!-- /.row -->
                <div id="" class="col-sm-12">
                    @if(isset($dtAlbum))
                        @if(count($dtAlbum)>0)
                            @foreach($dtAlbum as $item)
                                    <div class="col-sm-3 text-center" >
                                        {{--<div class="thumbnail">--}}
                                            {{--<div class="caption" align="center">--}}
                                        <a href="{{$item->photo_path}}" title="{{$item->photo_name}}" download="" data-gallery><img class="img-responsive  img-portfolio img-hover" src="{{$item->photo_path}}"></a>
{{--                                                <img class="img-responsive  img-portfolio img-hover"  alt="" src="{{$item->photo_path}}" style="width: 250px; height: 200px;">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                            @endforeach
                        @endif
                    @endif
                </div>
                {{-- @include('WebUIControl.Pager') --}}
            </div>
            <!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
              要記得，必須要有paginate()，在blade才能夠使用下列方法-->
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{$dtAlbum->render()}}
                </div>
            </div>
        </div>
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a> <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
    </section>
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script>
        //        $('.SlideShow').cycle();
        $('.SlideShow').cycle({
            fx:      'turnDown',
            delay:   -4000
        });
    </script>
@stop
