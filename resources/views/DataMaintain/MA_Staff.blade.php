@extends('TmpView.tmp')

@section('title','建成長執')

@section('content')
	<section class='container'>
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
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> 新增
                    </button>
                	<button class="btn btn-info" id="edit">
						<span class="glyphicon glyphicon-pencil"></span> 修改
					</button>
	              	<button type="button" class="btn btn-warning" data-dismiss="modal" disabled="disabled" id="cancel">
		                <span class='glyphicon glyphicon-remove'></span> 取消
		            </button>
                </div>
            </div>

            <div class="row">
				{!! Form::open(['route'=>'MA_Insert_Staff','id'=>'form_add','files'=>true,'class'=>'hide']) !!} 
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
			                        	{!!form::label('name','姓名:')!!}
		                        		{{-- <label for="name">姓名：</label><br> --}}
		                        		{!!form::text('name','',['class'=>'name'])!!}
		                    				{{-- <input class="span2_add " size="16" type="text" style="width:100%;" id="name" name="name"> --}}
		                    		</p>
	                				<p>
	                					<div style="display: inline;">
	            						{!!form::label('duty','職務:')!!}
	            						</div>
	                    				{{-- <label for="duty">職務：</label><br> --}}
	                    				{{-- <select class="span3_add " size="16" type="text" id="duty" name="duty" style="width:80%;"><br> --}}
	                    				<div style="display: inline;">
	                    				{!! Form::select('duty',$ItemAll, old('duty'), ['placeholder'=>'Select Category','style'=>'width:100px']) !!}
	                    				</div>
			                         </p>
			                          <p>
			                          	 {!!form::label('sdate','開始日期:')!!}

			                        	  {{-- <label for="sdate">開始日期：</label><br> --}}
		        						  <input class="date-modal" size="16" type="text" id="sdate" name="sdate" >
	        						  </p>
	  	                             <p>
			                        	  {{-- <label for="edate">結束日期：</label><br> --}}
			                        	  {!!form::label('edate','結束日期:')!!}
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
			                        		<label >姓名：</label>
		                    				<input class="span3" size="16" type="text" id="name_{{$person->id}}" value="{{$person->name}}" style="border-style:none;outline:none" readonly="true" >
		                				</p>
		                				<p>
		                					<label>職務：</label>

		                					{!! Form::select('duty_'.$person->id,$ItemAll, $person->cod_id, ['placeholder'=>'Select Category','style'=>'width:100px','disabled'=>'disabled','class'=>'span4','id'=>'duty_'.$person->id]) !!}
		                           {{--        	  <select class="form-control" name="duty_{{$person->id}}">
											    @foreach($ItemAll as $item)
											      <option value="{{$item->id}}">{{$item->id}}</option>
											    @endforeach
											  </select> --}}
				                        </p>
				                        <p>
				                        	<label >開始日期：</label>
		            						  <input class="date-modal" size="16" type="text" id="sdate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->sdate}}">
		    						  	</p>
		    						  	 <p>
				                        	<label >結束日期：</label>
		            						  <input class="date-modal" size="16" type="text" id="edate_{{$person->id}}" style="border-style:none;outline:none" readonly="true" value="{{$person->edate}}">
		    						  	</p>

			                            <div align="right">                                
				                            <button type="button" class="save-modal btn btn-success hide" data-info="{{$person->id}}" data-dismiss="modal" id="update_{{$person->id}}" >
			                        			<span class='glyphicon glyphicon-check'> </span> 更新
			                    			</button>	

			                                <button class="delete-modal btn btn-danger hide"
			                                    data-info="{{$person->id}}">
			                                    <span class="glyphicon glyphicon-trash"></span> 刪除
			                                </button>

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
	               {{$dtStaff->render()}}
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
                            您確定要刪除此照片 <span class="dname"></span> ? <span
                                class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="addbtn">
                                <span id="action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> 取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
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
		        $('.btn-success').addClass('hide');

		        $('#div_add').addClass('hide');

		        $('select[class="span4"]').attr('disabled',"disabled");

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
		                    url: 'MA_Fellowship_Photo',
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
		         // alert( duty);
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
			            formData.append('_token',$('input[name=_token]').val());

			            $.ajax({
			                    url: 'MA_Update_Staff',
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
				            url: '/MA_Update_Staff',
				            data: {
				                '_token': $('input[name=_token]').val(),
				                'id':id,
				                'name':name ,
				                'duty':duty,
				                'sdate': sdate  ,
				                'edate': edate     
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
		            url: '/MA_Delete_Staff',
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

      </script>
 	</section>
@stop	   