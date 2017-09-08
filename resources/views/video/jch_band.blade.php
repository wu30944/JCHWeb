@extends('TmpView.tmp')

@section('title','更多影片')

@section('content')
	<section class='container'>
		<!-- Team Members -->
	        <div class="row">
	            <div class="col-lg-12">
	                <h2 class="page-header text-center">禮拜影片</h2>
	            </div>

		    <div class="container">
		    @if (isset($dtmore_youtube))
		    	{{-- expr --}}
		    	@foreach ($dtmore_youtube as $more_youtube)
			    	
			    	 <div class="col-md-4 text-center">
		                <div class="thumbnail">
		                     <div class="embed-responsive embed-responsive-4by3">
                           		 <iframe class="embed-responsive-item" src="{{$more_youtube->link}}" frameborder="0" allowfullscreen></iframe>
                        	</div>
		                    <div class="caption">
		                        <h3>主題：{{$more_youtube->theme}}<br>
		                            <small>專講人員：{{$more_youtube->name}}</small>
		                        </h3>
		                    </div>
		                </div>
		            </div>
		    	@endforeach
		    @endif
				
			</div>
			建成樂團影音

			<!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
			要記得，必須要有paginate()，在blade才能夠使用下列方法-->
	        <div class="row">
	            <div class="col-lg-12 text-center">
	               {{$dtmore_youtube->render()}}
	            </div>
			</div>
			{{-- @include('WebUIControl.Pager') --}}

	</section>
@stop