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
	                        <li><a href="{{url('/')}}">首頁</a>
	                        </li>
	                        <li class="active">建成長執</li>
	                    </ol>
	                </div>    
	            </div>
	        </div>
	    </div>


             @if (count($dtElders)>0)
     	        <div class="row">
		            <div class="col-lg-12">
		                <h1 class="page-header text-center">長老</h1>
		            </div>
		        </div>

		    	{{-- expr --}}
		    	<div class="row">
		    	@foreach ($dtElders as $person)
		    		
		    			 {{-- @foreach ($item as $person) --}}
					    	 <div class="col-md-4 text-center" id="container_{{$person->id}}">

				                <div class="thumbnail">

				                    <div class="caption" align="left">
		    	                    	<p>
				                        	<div align="center">
					                        	 <img class="img-responsive img-circle"  alt="" id="preview_{{$person->id}}" src="{{$person->image_path}}" style="width: 200px; height: 200px;">
					                        </div>
				                        </p>
		                				<p>
			                        		<label >姓名：</label>
		                    				<input class="span3" size="16" type="text" id="name_{{$person->id}}" value="{{$person->name}}" style="border-style:none;outline:none" readonly="true" >
		                				</p>
		                				<p>
		                					<label>職務：</label>

		                					<input class="span3" size="16" type="text" id="duty_{{$person->id}}" value="{{$person->cod_val}}" style="border-style:none;outline:none" readonly="true" 
				                        </p>
				                        <p>
				                        	<label >任期開始：</label>
		            						  <input class="date-modal" size="16" type="text" id="sdate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->sdate}}">
		    						  	</p>
		    						  	 <p>
				                        	<label >任期結束：</label>
		            						  <input class="date-modal" size="16" type="text" id="edate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->edate}}">
		    						  	</p>

				                    </div>
				                </div>
				            </div>
			            {{-- @endforeach --}}
		            
		    	@endforeach
		    	</div>
		    @endif
		             @if (count($dtDeacons)>0)
     	        <div class="row">
		            <div class="col-lg-12">
		                <h1 class="page-header text-center">執事</h1>
		            </div>
		        </div>

		    	{{-- expr --}}
		    	<div class="row">
		    	@foreach ($dtDeacons as $person)
		    		
		    			 {{-- @foreach ($item as $person) --}}
					    	 <div class="col-md-4 text-center" id="container_{{$person->id}}">

				                <div class="thumbnail">

				                    <div class="caption" align="left">
		    	                    	<p>
				                        	<div align="center">
					                        	 <img class="img-responsive img-circle"  alt="" id="preview_{{$person->id}}" src="{{$person->image_path}}" style="width: 200px; height: 200px;">
					                        </div>
				                        </p>
		                				<p>
			                        		<label >姓名：</label>
		                    				<input class="span3" size="16" type="text" id="name_{{$person->id}}" value="{{$person->name}}" style="border-style:none;outline:none" readonly="true" >
		                				</p>
		                				<p>
		                					<label>職務：</label>

		                					<input class="span3" size="16" type="text" id="duty_{{$person->id}}" value="{{$person->cod_val}}" style="border-style:none;outline:none" readonly="true" 
				                        </p>
				                        <p>
				                        	<label >任期開始：</label>
		            						  <input class="date-modal" size="16" type="text" id="sdate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->sdate}}">
		    						  	</p>
		    						  	 <p>
				                        	<label >任期結束：</label>
		            						  <input class="date-modal" size="16" type="text" id="edate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->edate}}">
		    						  	</p>

				                    </div>
				                </div>
				            </div>
			            {{-- @endforeach --}}
		            
		    	@endforeach
		    	</div>
		    @endif

		  
		</div>
 	</section>
@stop	   