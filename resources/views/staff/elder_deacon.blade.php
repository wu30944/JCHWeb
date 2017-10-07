@extends('TmpView.tmp')

@section('title','建成長執')

@section('content')
	<section class='container'>
	<div class="content full">
		<!-- Team Members -->
        <div class="row">
	        <div class="col-md-12">
	            <h1 class="page-header">建成長執
	                {{-- <small>Subheading</small> --}}
	            </h1>
	            <div class="lgray-bg ">
	                <div class="container:before">
	                    <ol class="breadcrumb">
	                        <li> <a href="{{url('/')}}"><span class="glyphicon glyphicon glyphicon-home">首頁</a>
	                        </li>
	                        <li class="active">建成長執</li>
	                    </ol>
	                </div>    
	            </div>
	        </div>
	    </div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header text-center">長老</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">

				<ul id="myTab" class="nav nav-tabs nav-justified">
					@if(isset($dtElders) && count($dtElders)>0)

						@for($i=0;$i<count($dtElders);$i++)
							@if($i==0)
								<li class="active"><a href="#service_{{$dtElders[$i]->depart}}" data-toggle="tab"><i class="fa fa-car"></i>
										{{$dtElders[$i]->depart}} </a>
								</li>
							@else
								<li class=""><a href="#service_{{$dtElders[$i]->depart}}" data-toggle="tab"><i class="fa fa-car"></i>
										{{$dtElders[$i]->depart}}
									</a>
								</li>
							@endif
						@endfor
					@endif

				</ul>
				<br>
				<div id="myTabContent" class="tab-content col-md-12">

					@if(isset($dtElders) && count($dtElders)>0)
						@for($i=0;$i<count($dtElders);$i++)
							@if($i==0)
								<div class="tab-pane fade active in" id="service_{{$dtElders[$i]->depart}}">
									<div class="col-md-4 text-center " id="container_{{$dtElders[$i]->id}}" >

										<div class="thumbnail">

											<div class="caption" align="left">
												<p>
												<div align="center">
													<img class="img-responsive img-circle"  alt="" id="preview_{{$dtElders[$i]->id}}" src="{{$dtElders[$i]->image_path}}" style="width: 200px; height: 200px;">
												</div>
												</p>
												<p>
													<label >姓名：</label>
													<input class="span3" size="16" type="text" id="name_{{$dtElders[$i]->id}}" value="{{$dtElders[$i]->name}}" style="border-style:none;outline:none" readonly="true" >
												</p>
												<p>
													<label>職務：</label>

													<input class="span3" size="16" type="text" id="duty_{{$dtElders[$i]->id}}" value="{{$dtElders[$i]->cod_val}}" style="border-style:none;outline:none" readonly="true"
												</p>
												<p>
													<label >任期開始：</label>
													<input class="date-modal" size="16" type="text" id="sdate_{{$dtElders[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtElders[$i]->sdate}}">
												</p>
												<p>
													<label >任期結束：</label>
													<input class="date-modal" size="16" type="text" id="edate_{{$dtElders[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtElders[$i]->edate}}">
												</p>

											</div>
										</div>
									</div>
								</div>
							@else
								<div class="tab-pane fade " id="service_{{$dtElders[$i]->depart}}">
									<div class="col-md-4 text-center col-md-offset-{{$i+$i}}" id="container_{{$dtElders[$i]->id}}">

										<div class="thumbnail">

											<div class="caption" align="left">
												<p>
												<div align="center">
													<img class="img-responsive img-circle"  alt="" id="preview_{{$dtElders[$i]->id}}" src="{{$dtElders[$i]->image_path}}" style="width: 200px; height: 200px;">
												</div>
												</p>
												<p>
													<label >姓名：</label>
													<input class="span3" size="16" type="text" id="name_{{$dtElders[$i]->id}}" value="{{$dtElders[$i]->name}}" style="border-style:none;outline:none" readonly="true" >
												</p>
												<p>
													<label>職務：</label>

													<input class="span3" size="16" type="text" id="duty_{{$dtElders[$i]->id}}" value="{{$dtElders[$i]->cod_val}}" style="border-style:none;outline:none" readonly="true"
												</p>
												<p>
													<label >任期開始：</label>
													<input class="date-modal" size="16" type="text" id="sdate_{{$dtElders[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtElders[$i]->sdate}}">
												</p>
												<p>
													<label >任期結束：</label>
													<input class="date-modal" size="16" type="text" id="edate_{{$dtElders[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtElders[$i]->edate}}">
												</p>

											</div>
										</div>
									</div>
								</div>
							@endif
						@endfor

					@endif
				</div>

			</div>
		</div>


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header text-center">執事</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">

				<ul id="myTab" class="nav nav-tabs nav-justified">
					@if(isset($dtElders) && count($dtElders)>0)

						@for($i=0;$i<count($dtElders);$i++)
							@if($i==0)
								<li class="active"><a href="#deacons_{{$dtElders[$i]->depart}}" data-toggle="tab"><i class="fa fa-car"></i>
										{{$dtElders[$i]->depart}} </a>
								</li>
							@else
								<li class=""><a href="#deacons_{{$dtElders[$i]->depart}}" data-toggle="tab"><i class="fa fa-car"></i>
										{{$dtElders[$i]->depart}}
									</a>
								</li>
							@endif
						@endfor
					@endif

				</ul>
				<br>
				<div id="myTabContent" class="tab-content col-md-12">

					@if(isset($dtDeacons) && count($dtDeacons)>0)
						@for($i=0;$i<count($dtDeacons);$i++)
							@if($i==0 or $dtDeacons[$i]->depart=='禮拜部')
								<div class="tab-pane fade active in" id="deacons_{{$dtDeacons[$i]->depart}}">
									<div class="col-md-4 text-center" id="container_{{$dtDeacons[$i]->id}}">

										<div class="thumbnail">

											<div class="caption" align="left">
												<p>
												<div align="center">
													<img class="img-responsive img-circle"  alt="" id="preview_{{$dtDeacons[$i]->id}}" src="{{$dtDeacons[$i]->image_path}}" style="width: 200px; height: 200px;">
												</div>
												</p>
												<p>
													<label >姓名：</label>
													<input class="span3" size="16" type="text" id="name_{{$dtDeacons[$i]->id}}" value="{{$dtDeacons[$i]->name}}" style="border-style:none;outline:none" readonly="true" >
												</p>
												<p>
													<label>職務：</label>

													<input class="span3" size="16" type="text" id="duty_{{$dtDeacons[$i]->id}}" value="{{$dtDeacons[$i]->cod_val}}" style="border-style:none;outline:none" readonly="true"
												</p>
												<p>
													<label >任期開始：</label>
													<input class="date-modal" size="16" type="text" id="sdate_{{$dtDeacons[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtDeacons[$i]->sdate}}">
												</p>
												<p>
													<label >任期結束：</label>
													<input class="date-modal" size="16" type="text" id="edate_{{$dtDeacons[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtDeacons[$i]->edate}}">
												</p>

											</div>
										</div>
									</div>
								</div>
							@else
								<div class="tab-pane fade " id="deacons_{{$dtDeacons[$i]->depart}}">
									<div class="col-md-4 text-center" id="container_{{$dtDeacons[$i]->id}}">

										<div class="thumbnail">

											<div class="caption" align="left">
												<p>
												<div align="center">
													<img class="img-responsive img-circle"  alt="" id="preview_{{$dtDeacons[$i]->id}}" src="{{$dtDeacons[$i]->image_path}}" style="width: 200px; height: 200px;">
												</div>
												</p>
												<p>
													<label >姓名：</label>
													<input class="span3" size="16" type="text" id="name_{{$dtDeacons[$i]->id}}" value="{{$dtDeacons[$i]->name}}" style="border-style:none;outline:none" readonly="true" >
												</p>
												<p>
													<label>職務：</label>

													<input class="span3" size="16" type="text" id="duty_{{$dtDeacons[$i]->id}}" value="{{$dtDeacons[$i]->cod_val}}" style="border-style:none;outline:none" readonly="true"
												</p>
												<p>
													<label >任期開始：</label>
													<input class="date-modal" size="16" type="text" id="sdate_{{$dtDeacons[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtDeacons[$i]->sdate}}">
												</p>
												<p>
													<label >任期結束：</label>
													<input class="date-modal" size="16" type="text" id="edate_{{$dtDeacons[$i]->id}}" style="border-style:none;outline:none" readonly="true" value="{{$dtDeacons[$i]->edate}}">
												</p>

											</div>
										</div>
									</div>
								</div>
							@endif
						@endfor

					@endif
				</div>

			</div>
		</div>

		  
		</div>
 	</section>
@stop	   