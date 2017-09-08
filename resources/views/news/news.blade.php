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
<div class="content full">
     <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">最新消息
                    {{-- <small>Subheading</small> --}}
                </h1>
                <div class="lgray-bg ">
                    <div class="container:after">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">首頁</a>
                            </li>
                            <li class="active">最新消息</li>
                        </ol>
                    </div>    
                </div>
            </div>
    </div>

    <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">
                    <div id="first">
                        @if (isset($dtNews) and count($dtNews)>0)
                            @foreach ($dtNews as $News)

                                  <!-- First Blog Post -->
                                    <h2>
        {{--                                 <a href="{{route('news_d',$News->id)}}">{{$News->title}}</a> --}}
                                        {{$News->title}}
                                    </h2>

                                    <p><span class="glyphicon glyphicon-time"></span></i>&nbsp{{$News->action_date}}</p>
                                    @if ( !empty($News->image))
                                    <div align="center">
                                        <img class="img-responsive img-hover" src="{{$News->image}}" alt="" style="max-width: 400; max-height: 200px;">    
                                    </div>                       
                                    @endif
                                    <br>
                                     <p>{{mb_substr(strip_tags ($News->content),0,50,"utf-8")}}...</p>
                                     <h4>
                                     <textarea id="news_content" style="width:100%;height:230px;border-style:none;outline:none" readonly="true" class="hide">{{$News->content}}</textarea>   
                                    </h4>
                                    <a class="btn btn-primary" href="{{route('news_d',$News->title)}}">Read More <i class="fa fa-angle-right"></i></a>
                                   {{--  <button class="btn btn-primary btn-detail" id="btn_read_more" data-info="{{$News->id}},'id'">
                                            Read More <i class="fa fa-angle-right"></i>
                                    </button> --}}
                                    <hr >
                            @endforeach
                        @elseif(count($dtNews)===0)
                            查無符合資料
                        @endif

                        <!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
                        要記得，必須要有paginate()，在blade才能夠使用下列方法-->
                      @if ($isPaging)
                        <div class="row">
                            <div class="col-lg-12 text-center">
                               {{$dtNews->render()}}
                            </div>
                        </div>
                      @endif
                  </div>
                  <div id="second">
                      <p id="result">
                  </div>
    {{-- 
                    <!-- Pager -->
                    <ul class="pager">
                        <li class="previous">
                            <a href="#">&larr; Older</a>
                        </li>
                        <li class="next">
                            <a href="#">Newer &rarr;</a>
                        </li>
                    </ul> --}}

                </div>

    {{--             <!--搜尋控制項    Start-->
                <form action="{{ url('article') }}" method="post">
                    <br>
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input type="text" name="title" class="form-control">
                    <br>
                    <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                    <input type="submit" value="送出" name="" class="btn btn-primary">
                </form>
                 <!--搜尋控制項    End--> --}}
                <!-- Blog Sidebar Widgets Column -->
                
                <div class="col-md-4"> 

                   {{-- @include('WebUIControl.UISearch') --}}

                   <div class="well">
                        <h4>{{ isset($title_name) ? $title_name : '搜尋'}}</h4>
                            {{ csrf_field() }}
                            <div class="input-group">
                                 <input name="key_word" id="key_word" type="text" class="form-control" >
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="btnSend">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                 </span>
                             </div>
                    </div>
                     <!--搜尋控制項    Start-->

                    @include('category.categoryTreeview')

                    <!-- Side Widget Well -->
    {{--                 <div class="well" >
                        <h4>Side Widget Well</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                    </div> --}}

                </div>

            </div>
            <!-- /.row -->
    </div>
</section>
<script>
    $('#btnSend').on('click', function() {
          $.ajax({
            type: 'post',
            url: '/search_test',
            data: {
                    '_token': $('input[name=_token]').val(),
                    'key_word': $('#key_word').val()
                   }
            , success: function(data){

                $('#first').addClass('hide');
                $('#result').empty();
                $('#result').append(data);
                $('#key_word').val("");
             }

        });
    });

        $('.btn-detail').on('click', function() {
            var stuff = $(this).data('info').split(',');
            // alert(stuff[0]);
              $.ajax({
                type: 'post',
                url: '/read_more',
                data: {
                        '_token': $('input[name=_token]').val(),
                        'id': stuff[0]
                       }
                , success: function(data){

                    $('#first').addClass('hide');
                    $('#result').empty();
                    $('#result').append(data);
                    $('#key_word').val("");

                 }

            });
    });
</script>
@stop