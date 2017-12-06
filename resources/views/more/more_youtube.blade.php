@extends('TmpView.tmp')

@section('title','更多影片')

@section('content')
	<section class='container'>
		<div class="content full">
			<!-- Team Members -->
		        <div class="row">
		            <div class="col-lg-12">
		                <h2 class="page-header text-center">{{$VideoType}}</h2>
		            </div>
	{{-- 	            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
		                    <div class="caption">
		                        <h3>John Smith<br>
		                            <small>Job Title</small>
		                        </h3>
		                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste saepe et quisquam nesciunt maxime.</p>
		                        <ul class="list-inline">
		                            <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
		                            </li>
		                            <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		        </div> --}}
		        <!-- /.row -->
			    <div class="container">
			    @if (isset($dtmore_youtube))
			    	{{-- expr --}}
			    	@foreach($dtmore_youtube->chunk(3) as $item)
			    		<div class="row">
				    	@foreach ($item as $more_youtube)
					    	
					    	 <div class="col-md-4 text-center">
				                <div class="thumbnail">
				                     <div class="embed-responsive embed-responsive-4by3">
		                           		 <iframe class="embed-responsive-item" src="{{$more_youtube->link}}" frameborder="0" allowfullscreen></iframe>
		                        	</div>	
				                    <div class="caption" align="left">
				                        <h3>
				                    	<br>
				                        <strong>@lang('default.subject')：
				                       {{$more_youtube->theme}}
				                        	{{-- <input size="16" type="text" style="width:100%;border-style:none;outline:none" readonly="true" id="theme" value="{{$more_youtube->theme}}" align="right"> --}}
				                        <br>
			                            <small><label>@lang('default.speaker'):</label>{{$more_youtube->name}}</small>
			                            <br>
			                            <small><label>@lang('default.date'):</label>{{$more_youtube->video_date}}</small> 
			                            </strong>
				                        </h3>

				                    </div>
				                </div>
				            </div>
				    	@endforeach
				    	</div><!-- end row -->
			    	@endforeach
			    @endif
					
				</div>

				<!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
				要記得，必須要有paginate()，在blade才能夠使用下列方法-->
		        <div class="row">
		            <div class="col-lg-12 text-center">
		               {{$dtmore_youtube->render()}}
		            </div>
				</div>
			{{-- @include('WebUIControl.Pager') --}}
		</div>
	</section>
@stop