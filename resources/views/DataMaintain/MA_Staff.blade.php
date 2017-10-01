@extends('admin.layouts.base')
@section('title','職務人員')
@section('pageDesc','DashBoard')
@section('content')
@section('content')
	<section class='container box'>
		<!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center">@lang('default.jch_staff')</h1>
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @elseif($message = Session::get('fails'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>

        @endif

	    <div class="container" >
            <div class="form-group row add">
            <br>
                <div class="col-md-4">
					<button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btnSearch" onclick="Search()">
						<span class='glyphicon glyphicon-search'> </span> @lang('default.search')
					</button>
					@if(Gate::forUser(auth('admin')->user())->check('admin.data.create'))
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                    </button>
					@endif
					@if(Gate::forUser(auth('admin')->user())->check('admin.data.edit'))
                	<button class="btn btn-info" id="edit">
						<span class="glyphicon glyphicon-pencil"></span> @lang('default.edit')
					</button>
	              	<button type="button" class="btn btn-warning" data-dismiss="modal" disabled="disabled" id="cancel">
		                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
		            </button>
					@endif
                </div>
            </div>
			{{-- 搜尋測試區塊 --}}
			{!! Form::open(['route'=>'MA_SearchStaff','id'=>'form_search']) !!}
			<div class="col-lg-12">
				<div class="thumbnail">

					<table class="table  site-footer" >
						<tr>
							<td class="col-lg-2">
								<label>@lang('default.name'):</label>
							</td>
							<td>
								{!!form::text('SearchName',(isset($request))?$request->SearchName:'',['class'=>'text form-control','id'=>'SearchName'])!!}
								{{-- <input type="text" class="form-control" id="SearchSpeaker" > --}}
							</td>

						</tr>
						<tr>
							<td class="col-lg-2" align="left">
								<div style="display: inline;">
									<label>@lang('default.staff'):</label>
								</div>
							</td>
							<td>
								<div style="display: inline;">
									{!! Form::select('SearchStaff',$ItemAll,(isset($request))?$request->SearchStaff:2, ['placeholder'=>'請選擇職務','style'=>'width:130px','id'=>'SearchStaff']) !!}
								</div>
							</td>
						</tr>
						<tr>
							<td class="col-lg-2" align="left">
								<div style="display: inline;">
									<label>@lang('default.depart'):</label>
								</div>
							</td>
							<td>
								<div style="display: inline;">
									{!! Form::select('SearchDepart',$ItemDepartAll,(isset($request))?$request->SearchDepart:2, ['placeholder'=>'請選擇部','style'=>'width:130px','id'=>'SearchDepart']) !!}
								</div>
							</td>
						</tr>
						<tr>
							<td class="col-lg-2">
								<label >@lang('default.sdate'):</label>
							</td>
							<td>
								{{-- <input type="text" class="form-control search-date-modal" id="SearchSDate" > --}}
								{!!form::text('SearchSDate',(isset($request))?$request->SearchSDate:'',['class'=>'text form-control search-date-modal','id'=>'SearchSDate'])!!}
							</td>
						</tr>
						<tr>
							<td class="col-lg-2">
								<label >@lang('default.edate'):</label>
							</td>
							<td>
								{!!form::text('SearchEDate',(isset($request))?$request->SearchEDate:'',['class'=>'text form-control search-date-modal','id'=>'SearchEDate'])!!}
								{{-- <input type="text" class="form-control search-date-modal" id="SearchEDate" > --}}
							</td>
						</tr>
					</table>
					@if(count($dtStaff)===0)
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>查無符合資料</strong>
						</div>
					@endif
				</div>
			</div>
			{!! Form::close() !!}
			{{-- 搜尋測試區塊 --}}

            <div class="row">
				{!! Form::open(['route'=>'admin.MA_Insert_Staff','id'=>'form_add','files'=>true,'class'=>'hide']) !!}
	            {{-- <form id="form_link_add" method="post" action="{{ url('MA_Insert_Sunday_Video') }}"> --}}
		            <div class="col-md-4 text-center " id="div_add" >
			                <div class="thumbnail">
			                   <div align="left">     
			                        <label for="upload-profile-picture">                           
			                             <input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl" style="width:200px">

			                        </label>
		                    	</div>
			                    <div class="caption" align="left">
			                    	<p>
			  		                    <div align="center">
				                        	 <img class="img-responsive preview img-circle"  alt="" id="preview" src="http://via.placeholder.com/200x200" style="width: 200px; height: 200px;">
				                        </div>
			                    		{{-- <img class="img-responsive preview img-circle"  alt="" id="preview" src="/photo/sample.jpg">
	 --}}		                    </p>
			                        <p>
										<label for="">@lang('default.name') :</label>
											{{--{!!form::label('name','姓名:')!!}--}}
										<div style="display: inline;">
											{!!form::text('name','',['class'=>'name'])!!}
										</div>
		                    		</p>
	                				<p>
	                					<div style="display: inline;">
										<label for="">@lang('default.staff')</label>
	            						{{--{!!form::label('duty','職務:')!!}--}}
	            						</div>
	                    				<div style="display: inline;">
	                    				{!! Form::select('duty',$ItemAll, old('duty'), ['placeholder'=>'請選擇職務','style'=>'width:100px']) !!}
	                    				</div>
			                         </p>
									<p>
										<div style="display: inline;">
										<label for="">@lang('default.depart')</label>
											{{--{!!form::label('depart','部門:')!!}--}}
										</div>
										<div style="display: inline;">
											{!! Form::select('depart',$ItemDepartAll, old('depart'), ['placeholder'=>'請選擇部','style'=>'width:100px','clase'=>'form-control']) !!}
										</div>
									</p>
			                          <p>
										<div style="display: inline;">
											<label for="">@lang('default.sdate')</label>
											{{--{!!form::label('depart','部門:')!!}--}}
										</div>
			                          	 {{--{!!form::label('sdate','開始日期:')!!}--}}

		        						  <input class="date-modal" size="16" type="text" id="sdate" name="sdate" >
	        						  </p>
	  	                             <p>
										<div style="display: inline;">
											<label for="">@lang('default.edate')</label>
											{{--{!!form::label('depart','部門:')!!}--}}
										</div>
			                        	  {{--{!!form::label('edate','結束日期:')!!}--}}
		        						  <input class="date-modal" size="16" type="text" id="edate" name="edate" >
	        						  </p>
		                            <div align="right">                                
			                            <button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btn_add" >
		                        			<span class='glyphicon glyphicon-check'> </span>加入
		                    			</button>	
		                    			{{-- <input class="submit" type="submit" value="加入"/> --}}
		                    		</div>
			                    </div>
			                </div>
		            </div>
	            {{-- </form> --}}
	            {!! Form::close() !!}
            </div>

             @if (isset($dtStaff))
		    	{{-- expr --}}
		    	@foreach ($dtStaff->chunk(3) as $item)
		    		<div class="row">
		    			 @foreach ($item as $person)
					    	 <div class="col-md-4 text-center" id="container_{{$person->id}}">

				                <div class="thumbnail">

			 			        <div class="alert alert-block hide" id="div_alert_{{$person->id}}">
						            <button type="button" class="close" data-dismiss="alert">×</button>
						            <strong>
						            	<input  style="background-color:   transparent;   border:   0px" readonly="true" id="alert_msg_{{$person->id}}">
						            </strong>
						        </div>

				                   <div align="left">     
				                        <label for="upload-profile-picture">     
				                         	<input type="text" name="staff_id_{{$person->id}}" id="staff_{{$person->id}}" class="hide" value="{{$person->id}}">                     
				                             <input name="image" id="image_{{$person->id}}" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl chgupl hide" style="width:200px" data-info="{{$person->id}}">

				                        </label>
			                    	</div>

				                    <div class="caption" align="left">
		    	                    	<p>
				                        	<div align="center">
					                        	 <img class="img-responsive img-circle"  alt="" id="preview_{{$person->id}}" src="{{$person->image_path}}" style="width: 200px; height: 200px;">
					                        </div>
				                        </p>
		                				<p>
			                        		<label >@lang('default.name')：</label>
		                    				<input class="span3" size="16" type="text" id="name_{{$person->id}}" value="{{$person->name}}" style="border-style:none;outline:none" readonly="true" class="form-control name">
		                				</p>
		                				<p>
		                					<label>@lang('default.staff')：</label>

		                					{!! Form::select('duty_'.$person->id,$ItemAll, $person->cod_id, ['placeholder'=>'請選擇職務','style'=>'width:100px','disabled'=>'disabled','class'=>'staff','id'=>'duty_'.$person->id,'data-info'=>$person->id]) !!}
											@if($person->cod_id == 5)
												{!! Form::select('fellowship_'.$person->id,$ItemFellowshipAll, $person->fellowship_id, ['placeholder'=>'請選擇團契','disabled'=>'disabled','class'=>'span4','style'=>'width:140px','id'=>'fellowship_'.$person->id]) !!}
											@else
												{!! Form::select('fellowship_'.$person->id,$ItemFellowshipAll, $person->fellowship_id, ['placeholder'=>'請選擇團契','disabled'=>'disabled','class'=>'hide','style'=>'width:140px','id'=>'fellowship_'.$person->id]) !!}
											@endif
										</p>
										<p>
											@if($person->cod_id == 2 or $person->cod_id == 3 or $person->cod_id==5)
											<label class="" id="lblDepart_{{$person->id}}">@lang('default.depart')：</label>

											{!! Form::select('depart_'.$person->id,$ItemDepartAll, $person->depart_id, ['placeholder'=>'請選擇部','style'=>'width:100px','disabled'=>'disabled','class'=>'span4','id'=>'depart_'.$person->id]) !!}
											@else
											<label class="hide" id="lblDepart_{{$person->id}}">@lang('default.depart')：</label>

											{!! Form::select('depart_'.$person->id,$ItemDepartAll, $person->depart_id, ['placeholder'=>'請選擇部','style'=>'width:100px','class'=>'hide','id'=>'depart_'.$person->id]) !!}

											@endif
										</p>
				                        <p>
				                        	<label >@lang('default.sdate')：</label>
		            						  <input class="date-modal" size="16" type="text" id="sdate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->sdate}}">
		    						  	</p>
		    						  	 <p>
				                        	<label >@lang('default.edate')：</label>
		            						  <input class="date-modal" size="16" type="text" id="edate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->edate}}">
		    						  	</p>

			                            <div align="right">                                
				                            <button type="button" class="save-modal btn btn-success hide" data-info="{{$person->id}}" data-dismiss="modal" id="update_{{$person->id}}" >
			                        			<span class='glyphicon glyphicon-check'> </span> @lang('default.update')
			                    			</button>	
											@if(Gate::forUser(auth('admin')->user())->check('admin.data.destory'))
			                                <button class="delete-modal btn btn-danger hide"
			                                    data-info="{{$person->id}}">
			                                    <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
			                                </button>
											@endif

		                        		</div>
				                    </div>
				                </div>
				            </div>
			            @endforeach
		            </div>
		    	@endforeach
		    @endif
		</div>
			<!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
			要記得，必須要有paginate()，在blade才能夠使用下列方法-->
	        <div class="row">
	            <div class="col-lg-12 text-center">
	               {{$dtStaff->appends((isset($request))?['SearchName'=>$request->SearchName,'SearchStaff'=>$request->SearchStaff,
	               'SearchDepart'=>$request->SearchDepart,'SearchSDate'=>$request->SearchSDate,'SearchEDate'=>$request->SearchEDate]:'')->render()}}
	            </div>
			</div>
			
  		<div id="Edit_Modal" class="modal fade" role="dialog">
		
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                              <input class="hide"  id="staff_id" type="text">
                             
                     
                        <div class="deleteContent">
                            @lang('message.delete_msg') <span class="dname"></span> ? <span
                                class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="addbtn">
                                <span id="action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
      </section>
    @stop
    @section('js')
	<link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
	<script src="../js/jquery.datetimepicker.full.js"></script>
	<script src="../js/jquery.validate.js"></script>
    <script>
      		
				$().ready(function() {

					$("#form_add").validate({
						rules: {
							name:{
								required: true,
								minlength: 3
							},
							duty: {
								required: true,
								minlength: 1
							},
							sdate: {
								required: true,
								date: true,
								dateISO: 'YYYY-MM-DD'
							},
							edate: {
								required: true,
								date: true,
								dateISO: 'YYYY-MM-DD'
							}
						},
						messages: {
							name: "請輸入姓名",
							duty: "請輸入職務",
							sdate: {
								required: "請輸入任期開始日期",
								date: "您輸入的可能不是日期"
							},
							edate: {
								required: "請輸入任期結束日期",
								date: "您輸入的可能不是日期"
							}
						}
					});
				});

				/*
					修改
					按下修改按鈕，將文字顯示在控制向上
				*/
			    $("#edit").on('click', function(){
			        
			        // alert('修改');
			        // $('input[class="span2"]').removeAttr('style','readonly');
			        $('input[class="span3"]').attr("style",{"border-style":"block","outline":"block"});
			        $('.date-modal').attr("style",{"border-style":"block","outline":"block"});

			        $('input[class="span3"]').removeAttr("readonly");
			        $('select[class="span4"]').removeAttr("disabled");
                    $('select[class="staff"]').removeAttr("disabled");
			        $('.date-modal').removeAttr("readonly");

			        $('#cancel').removeAttr("disabled");
			        $('#save').removeAttr("disabled");
			        $('#edit').attr('disabled',"disabled");

			        $('.btn-danger').removeClass('hide');
			        $('.btn-success').removeClass('hide');

			        $('.chgupl').removeClass('hide');

			        // $('button[class="delete-modal btn btn-danger hide"]').
			        // $("#container").css("background-color", "red");

			    });



	          $('.date-modal').datetimepicker({
		            yearOffset:0,  
		            lang:'zh-TW',
		            timepicker:false,
		            format:'Y-m-d',
		            formatDate:'Y-m-d'
	    	  });

	          /*
	          * 2017/09/28
	          * */
			$('.search-date-modal').datetimepicker({
				yearOffset:0,
				lang:'zh-TW',
				timepicker:false,
				format:'Y-m-d',
				formatDate:'Y-m-d'
			});

    	    $('#edit_photo').on('click', function() {
		        // $('.second').addClass('hide');
		        $('#Edit_Photo_Modal').modal('show');
		    });

			/*
				取消
				按下取消按鈕，帶出預設畫面
			*/

		    $('#cancel').on('click',function(){
		        
				$('input[class="span3"]').attr("style","border-style:none;");				
				$('.date-modal').attr("style","border-style:none;");

		        $('input[class="span3"]').attr('readonly',"true");
		        $('.date-modal').attr('readonly',"true");


		        $('#cancel').attr('disabled',"disabled");
		        $('#save').attr('disabled',"disabled");
		        $('#edit').removeAttr("disabled");

		        $('.btn-danger').addClass('hide');
		        $('.btn-success').not('#btnSearch').addClass('hide');

		        $('#div_add').addClass('hide');

		        $('select[class="span4"]').attr('disabled',"disabled");
                $('select[class="staff"]').attr('disabled',"disabled");

		        $('#name').val('');
		        $('#sdate').val('');
		        $('#edate').val('');

		        $('.chgupl').addClass('hide');

		    });

		    /*
		    	2017/06/18. 
		    	新增
		    	當按下新增程式會去做的事情
		    */
		    $('#add').on('click',function()
		    {	

		    	$('#div_add').removeClass('hide');
		        $('#btn_add').removeClass('hide');
		    	$('#cancel').removeAttr("disabled");
		    	$('#sdate').attr("style",{"border-style":"block","outline":"block"});
		    	$('#sdate').removeAttr("readonly");
		    	$('#edate').attr("style",{"border-style":"block","outline":"block"});
		    	$('#edate').removeAttr("readonly");

		    	$('#edit').attr('disabled',"disabled");
		    	$('#form_add').removeClass('hide');
		    });

    	    var objImg;

		    var ImgURL;
		    /**
		     * 格式化
		     * @param   num 要轉換的數字
		     * @param   pos 指定小數第幾位做四捨五入
		     */
		     function format_float(num, pos)
		    {
		        var size = Math.pow(10, pos);
		        return Math.round(num * size) / size;
		    }
		    /**
		     * 預覽圖
		     * @param   input 輸入 input[type=file] 的 this
		    */
		    function preview(input,$img_id) {
		        if (!input.files[0].type.match('image.*'))
		        {
		            alert('您選擇的不是圖片檔案');
		            $('#image').attr({value:''});

		        }
		        else if (input.files && input.files[0] ) {
		            var reader = new FileReader();
		            objImg=input.files[0];

		            //為了避免使用者上傳照片後，又去編輯其他ITEM的照片，導致上傳照片對應不正確
		            //所以改為當某個項目上傳照片後，將其他項目的更新、選取檔案的控制項改為不能修改的狀態
		            $('.chgupl').not('#image_'+$img_id).attr('disabled',"disabled");
		            $('.save-modal').not('#update_'+$img_id).attr('disabled',"disabled");

		            
		            if($img_id=='')
		            {
		            	$img_id='#preview';
		            }else{
		            	$img_id='#preview_'+$img_id;
		            }

		            reader.onload = function (e) {
		                $($img_id).attr('src', e.target.result);
		                var KB = format_float(e.total / 1024, 2);
		                $('.size').text("檔案大小：" + KB + " KB");
		                ImgURL=e.target.result
		            }
		 
		            reader.readAsDataURL(input.files[0]);
		        }
		    }
		 
		    $("body").on("change", ".upl", function (){
		    	//alert($(this).data('info'));
		    	$id_info = $(this).data('info');
		    	
		    	if(typeof($id_info)=='undefined')
		    	{
		    		$img_id = '';
		    	}
		    	else{
		    		$img_id = $id_info;

		    	}
		        preview(this,$img_id);
		    })


		    $("#btnUpdatePhoto").on('click', function(){
		        if(objImg.type.match('image.*'))
		        {
		            // var reader = new FileReader();
		            // $('.show-update-img').attr('src', ImgURL);
		            // reader.readAsDataURL(objImg);
		            
		             //利用ajax傳送到伺服器
		             // $('#preview').attr('src','/photo/sample.jpg');

		            var formData = new FormData();
		            formData.append('image', objImg);
		            formData.append('id',$('#fellowship_id').val());
		            formData.append('_token',$('input[name=_token]').val());
		            $.ajax({
		                    url: '/admin/MA_Fellowship_Photo',
		                    data: formData,
		                    cache: false,
		                    contentType: false,
		                    processData: false,
		                    type: 'post',
		                    success: function(data){
		                          if(data['ServerNo']=='200'){
		                            // 如果成功
		                           $('#ShowImg').attr('src', data['ResultData']);
		                            
		                            // $('input[name=ShowImg]').val(data);
		                            $(obj).off('change');
		                            
		                          }else{
		                            alert('test');
		                            // 如果失败
		                              // alert(data['ResultData']);
		                          }
		                    }
		            });

		        }

		    });


		    $(document).on('click', '.save-modal', function() {
		       
	            var stuff = $(this).data('info');

		        var id = stuff;
		        var name = $('#name_'+stuff).val();
		        var duty = $('#duty_'+stuff).val();
		        var sdate = $('#sdate_'+stuff).val();
		        var edate = $('#edate_'+stuff).val();
		        var depart = $('#depart_'+stuff).val();
                var fellowship = $('#fellowship_'+stuff).val();
//				alert( fellowship);
		        // var video_link = $('#speaker_'+stuff).val();


		        if(typeof(objImg)!='undefined')
		        {
		        	 if(objImg.type.match('image.*'))
			        {
			        	// alert('test');
			            var formData = new FormData();
			            formData.append('image', objImg);
			            formData.append('id',id);
			            formData.append('name',name);
			            formData.append('duty',duty);
			            formData.append('sdate',sdate);
			            formData.append('edate',edate);
			            formData.append('depart',depart);
			            formData.append('fellowship',fellowship);
			            formData.append('_token',$('input[name=_token]').val());

			            $.ajax({
			                    url: '/admin/MA_Update_Staff',
			                    data: formData,
			                    cache: false,
			                    contentType: false,
			                    processData: false,
			                    type: 'post',
			                    success: function(data){
			                          if(data['ServerNo']=='200'){
			                            // 如果成功
										$('#div_alert_'+id).removeClass('alert-danger');
										$('#alert_msg_'+id).val(data['ResultData']);
										$('#div_alert_'+id).addClass('alert-success');
										$('#div_alert_'+id).removeClass('hide');
			                          }else{
			                            alert(data['ResultData']);
			                            // 如果失败
										$('#div_alert_'+id).removeClass('alert-success');
										$('#alert_msg_'+id).val(data['ResultData']);
										$('#div_alert_'+id).addClass('alert-danger');
										$('#div_alert_'+id).removeClass('hide');
			                          }
			                    }
			            });

			        }

		        }else{

			        	$.ajax({
				            type: 'post',
				            url: '/admin/MA_Update_Staff',
				            data: {
				                '_token': $('input[name=_token]').val(),
				                'id':id,
				                'name':name ,
				                'duty':duty,
				                'sdate': sdate  ,
				                'edate': edate,
								'depart':depart,
								'fellowship':fellowship
		                    },
				            success: function(data){ 
				            	// alert(data['errors']);
				                if(data['ServerNo']=='200')
				                {	
				                	 // alert(data['ResultData']);
				                	 $('#div_alert_'+id).removeClass('alert-danger');
				                	 $('#alert_msg_'+id).val(data['ResultData']);
				                	 $('#div_alert_'+id).addClass('alert-success');
				                	 $('#div_alert_'+id).removeClass('hide');                	            

				                }else if(data['ServerNo']=='404')
				                {
				                	 // alert(data['ResultData']);
				                	 $('#div_alert_'+id).removeClass('alert-success');
				                	 $('#alert_msg_'+id).val(data['ResultData']);
				                	 $('#div_alert_'+id).addClass('alert-danger');
				                	 $('#div_alert_'+id).removeClass('hide');

				                }
				                
				            }
				        });
		        }
	              setTimeout(function () {
	                  $(".alert-block").hide(200);
	                }, 3000);      
		    });

			 $('.modal-footer').on('click', '.delete', function() {
			 	
			 	// alert($('#action_video_id').val());	
		        $.ajax({
		            type: 'post',
		            url: '/admin/MA_Delete_Staff',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id':  $('#staff_id').val()
		            },
		            success: function(data) {
		                $('#container_' + $('#staff_id').val()).remove();
		                 location.reload();
		            }
		        });
		    });

 		    $(document).on('click', '.delete-modal', function() {

		        $('.actionBtn').addClass('btn-danger');
		        $('.actionBtn').addClass('delete');
		        $('.modal-title').text('刪除');
		        $('.deleteContent').show();
		        $('.form-horizontal').hide();
		        //$('.dname').html($(this).data('name'));
		        $('#Edit_Modal').modal('show');
		        $('#action_button').text('刪除');
		        $('#action_button').addClass('glyphicon-trash');

	             var stuff = $(this).data('info');
	             
		        $('#staff_id').val(stuff);
		        
		    });


            $(function () {
              $(".alert-block").click(function () {
                $(".alert-block").slideToggle(200);
                setTimeout(function () {
                  $(".alert-block").hide(200);
                }, 3000);
              });
              
              // setTimeout(function () {
              //     $(".alert-test").hide(200);
              //   }, 3000);
            })

			$('select[class="staff"]').change(function(){
//			alert($(this).data('info'));

				$id = $(this).data('info');
				$strStaff=$('#duty_'+$id).val();

				if($strStaff==5)
				{
//                   alert($('#duty_'+$id).val());
                    $('#fellowship_'+$id).removeClass('hide');
                    $('#fellowship_'+$id).removeAttr("disabled");
                    $('#lblDepart_'+$id).removeClass('hide');
                    $('#depart_'+$id).removeClass('hide');
				}else
				{
                    $('#fellowship_'+$id).addClass('hide');
                    if($strStaff== 2 || $strStaff == 3)
					{
                        $('#lblDepart_'+$id).removeClass('hide');
                        $('#lblDepart_'+$id).removeClass('hide');
                        $('#depart_'+$id).removeClass('hide');
					}else {

                        $('#lblDepart_'+$id).addClass('hide');
						$('#depart_'+$id).addClass('hide');
					}
				}

			});


			function Search(){
				form_search.submit();
			}
      </script>
@stop	   