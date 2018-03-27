@extends('TmpView.tmp')

@section('title','首頁')


@section('content')
    <!-- inc.carousel 使輪播的部分 -->
    @include('widgets.carousel')

    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    @if (isset($dtVerse))
                       @foreach ($dtVerse as $verse)
                           {{-- expr --}}
                           {{$verse->content}}{{$verse->chapter}}
                       @endforeach
                    @endif
                </h3>
            </div>
            <div class="row">
           @include('widgets.worship')
            <div class="col-md-4">
              @include('widgets.meeting_info')
              @include('widgets.news_info')
            </div>
        </div>
        </div>
        <!-- /.row -->
        @include('widgets.action_photo')

    </div>
    <!-- /.container -->
@stop
@section('js')
    <script>
        $('.SlideShow').cycle();
    </script>
@stop