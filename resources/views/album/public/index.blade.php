@extends('TmpView.tmp')

@section('title','活動相簿')

@section('content')
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
                                <li class="active">@lang('function_title.ActionAlbum')</li>
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
                <div id="myTabContent" class="tab-content col-md-12">
                    @if(isset($objAlbumSet))
                        @foreach($objAlbumSet as $dtAlbum)
                            @if(count($dtAlbum)>0)
                                <div class="col-md-4 text-center" >
                                    <div class="thumbnail">
                                        <div class="caption" align="center">
                                            <a href="{{route('album.IndexD',$dtAlbum[0]->id)}}">{{$dtAlbum[0]->album_name}}</a>
                                            <p>
                                                <div align="center" class="SlideShow">
                                                    @foreach($dtAlbum as $item)
                                                        {{--<a href="{{route('album.IndexD',$item->id)}}">--}}
                                                            <img class="img-responsive  img-portfolio img-hover"  alt="" src="{{$item->photo_path}}" style="width: 250px; height: 250px;">
                                                        {{--</a>--}}
                                                    @endforeach
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                {{-- @include('WebUIControl.Pager') --}}
            </div>
            <!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
              要記得，必須要有paginate()，在blade才能夠使用下列方法-->
            <div class="row">
                <div class="col-lg-12 text-center">
                {{$objAlbumSet->render()}}
                </div>
            </div>
        </div>
    </section>
    <script>
//        $('.SlideShow').cycle();
        $('.SlideShow').cycle();
    </script>
@stop
