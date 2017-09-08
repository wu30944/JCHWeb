@extends('TmpView.tmp')

@section('title','首頁')

<!-- inc.carousel 使輪播的部分 -->
@include('widgets.carousel')

@section('content')
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

        <!-- Call to Action Section -->
        <div class="well Hidden">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
@stop