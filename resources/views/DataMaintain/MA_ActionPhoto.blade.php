@extends('admin.layouts.base')
@section('title','活動照片維護')
@section('pageDesc','DashBoard')
@section('content')
	<section class='container box'>
		<!-- Team Members -->
	        <div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header text-center">@lang('function_title.MAActionPhoto')</h1>
	            </div>

				<div class="container" >
				<div class="form-group row add">
				<br>
					<div class="col-md-4">
					@if(Gate::forUser(auth('admin')->user())->check('admin.ActionPhoto.Create'))
						<button class="btn btn-primary" type="submit" id="add">
							<span class="glyphicon glyphicon-plus"></span> @lang('default.add')
						</button>
					@endif
					@if(Gate::forUser(auth('admin')->user())->check('admin.ActionPhoto.Edit'))
						<button class="btn btn-info" id="edit">
							<span class="glyphicon glyphicon-pencil"></span> @lang('default.edit')
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal" disabled="disabled" id="cancel">
							<span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
						</button>
					</div>
					@endif
				</div>

				{!! Form::open(['route'=>'ActionPhoto.Create','id'=>'form_link_add']) !!}
				 <div class="row">
				{{-- <form id="form_link_add" method="post" action="{{ url('MA_Insert_Sunday_Video') }}"> --}}
					<div class="col-md-4 text-center hide" id="div_add" >
							<div class="thumbnail" align="left">
							<img id="blah" src="#" alt="your image" class="hide" style="width:650px;height:220px;" />
								<div class="caption" >
									<label for="link">@lang('default.photo_link')：</label><br>
											{{-- {{$more_youtube->link}} --}}
								<input class="span2_add " size="16" type="text" style="width:100%;" name="photo_link" onchange="readURL(this.value,'');" id="action_photo_link">

									<p>
											<label for="theme">@lang('default.title')：</label><br>
											<input class="span3_add " size="16" type="text" id="theme" name="theme" style="width:80%;"><br>
									 </p>
									 <p>
										<label for="speaker">@lang('default.content')：</label><br>
											<input class="span3_add " size="16" type="text" id="speaker" name="speaker" style="width:80%;"><br>
									 </p>
									 <p>
									<label for="video_date">@lang('default.date')：</label><br>
										  <input class="date-modal" size="16" type="text" id="datepicker_add" name="photo_date" >
									  </p>
									<div align="right">
										<button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btn_add" >
											<span class='glyphicon glyphicon-check'> </span>@lang('default.add')
										</button>
										{{-- <input class="submit" type="submit" value="加入"/> --}}

									</div>
								</div>
							</div>
					</div>
				{{-- </form> --}}
					  </div>
				{!! Form::close() !!}


				@if (isset($dtActionPhoto))
					{{-- expr --}}
					@foreach($dtActionPhoto as $action_photo)
						{{-- @foreach ($item as $action_photo) --}}
						 <div class="col-md-4 text-center" id="container_{{$action_photo->id}}">
							<div class="thumbnail">

								<div class="alert alert-block hide" align="left" id="div_alert_{{$action_photo->id}}">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>
										<input  style="background-color:   transparent;   border:   0px" readonly="true" id="alert_msg_{{$action_photo->id}}">
									</strong>
								</div>

								<img class="img-responsive img-portfolio img-hover" src="{{$action_photo->photo_link}}" alt="" style="width:650px;height:220px;" id="action_photo_link_{{$action_photo->id}}">

								<div class="" align="left">
									<p>
										<label >@lang('default.photo_link')：</label><br>
											{{-- {{$more_youtube->link}} --}}
										<input class="span2" size="16" type="text" style="width:100%;border-style:none;outline:none" readonly="true" id="photo_link_{{$action_photo->id}}" value="{{$action_photo->photo_link}}" onchange="readURL(this.value,{{$action_photo->id}});">
									</p>
									<p>
										@lang('default.title')：<input class="span3" size="16" type="text" id="theme_{{$action_photo->id}}" value="{{$action_photo->title}}" style="border-style:none;outline:none" readonly="true" >
									</p>
									<p>
																										@lang('default.content')：<input class="span3" size="16" type="text" id="content_{{$action_photo->id}}" value="{{$action_photo->content}}" style="border-style:none;outline:none" readonly="true" >
									</p>
									<p>
										@lang('default.date')：<input class="date-modal" size="16" type="text" id="datepicker_{{$action_photo->id}}" style="border-style:none;outline:none" disabled="disabled" readonly="true" value="{{$action_photo->photo_date}}">
									</p>
									<div align="right">
									@if(Gate::forUser(auth('admin')->user())->check('admin.ActionPhoto.Update'))
										<button type="button" class="save-modal btn btn-success hide" data-info="{{$action_photo->id}}" data-dismiss="modal" id="save_{{$action_photo->id}}" >
											<span class='glyphicon glyphicon-check'> </span> @lang('default.save')
										</button>
									@endif
									@if(Gate::forUser(auth('admin')->user())->check('admin.ActionPhoto.Destory'))
										<button class="delete-modal btn btn-danger hide"
											data-info="{{$action_photo->id}}">
											<span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
										</button>
									 @endif
									</div>
								</div>
							</div>
						</div>
						{{-- @endforeach --}}
					@endforeach
				@endif
				 <input class="hide"  id="action_photo_id">
				</div>
			</div>
			{{-- @include('WebUIControl.Pager') --}}
				{{-- 20170629  新增頁面 --}}
			<div id="AddModel" class="modal fade" role="dialog">
	            <div class="modal-dialog">
	                <!-- Modal content-->
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal">&times;</button>
	                        <h4 class="modal-title"></h4>
	                    </div>
	                    <div class="modal-body">
	                        <form class="form-horizontal" role="form">
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addfellowship_name">@lang('default.photo_link'):</label>
	                                <div class="col-sm-10">
	                                    <input type="text" class="form-control" id="Addfellowship_name" >
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addmeeting_time">@lang('default.title'):</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addmeeting_time">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addday">@lang('default.content'):</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addday">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addfloor">@lang('default.date'):</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addfloor">
	                                </div>
	                            </div>
	                        </form>
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
	        {{-- 下面的link是，為了讓必輸欄位如果沒有輸入資料控制項變為紅色，提示文字為紅色 --}}
	        <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
		    <script src="../js/jquery.datetimepicker.full.js"></script>
	        <script src="../js/jquery.validate.js"></script>
			<script>

			$(document).ready(function() {

				$("#form_link_add").validate({
					rules: {
						video_link:{
							required: true,
							minlength: 3
						},
						video_date: {
							required: true,
							date: true,
							dateISO: 'YYYY-MM-DD'
						}
					},
					messages: {
						video_link: "請輸入照片連結",
						video_date: {
							required: "請輸入照片日期",
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
		        $('input[class="span2"]').attr("style",{"border-style":"block","outline":"block"});
		        $('input[class="span3"]').attr("style",{"border-style":"block","outline":"block"});
		        $('.date-modal').attr("style",{"border-style":"block","outline":"block"});
		        $('input[class="span2"]').attr("style","width:100%;");

		        $('input[class="span2"]').removeAttr("readonly");
		        $('input[class="span3"]').removeAttr("readonly");
		        $('.date-modal').removeAttr("readonly");

		        $('#cancel').removeAttr("disabled");
		        $('#save').removeAttr("disabled");
		        $('#edit').attr('disabled',"disabled");

		        $('.btn-danger').removeClass('hide');
		        $('.btn-success').removeClass('hide');

		        $('.date-modal').removeAttr("disabled");
		        // $('button[class="delete-modal btn btn-danger hide"]').
		        // $("#container").css("background-color", "red");

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
		    	$('#datepicker_add').attr("style",{"border-style":"block","outline":"block"});
		    	$('#datepicker_add').removeAttr("readonly");
		    	$('#edit').attr('disabled',"disabled");
		    });


			/*
				取消
				按下取消按鈕，帶出預設畫面
			*/

		    $('#cancel').on('click',function(){
		        
				$('input[class="span3"]').attr("style","border-style:none;");
				$('input[class="span2"]').attr("style","border-style:none;");
				$('.date-modal').attr("style","border-style:none;");

		        $('input[class="span2"]').attr('readonly',"true");
		        $('input[class="span3"]').attr('readonly',"true");
		        $('.date-modal').attr('readonly',"true");

		        

		        $('#cancel').attr('disabled',"disabled");
		        $('#save').attr('disabled',"disabled");
		        $('#edit').removeAttr("disabled");
		        $('.span2').width('100%');

		        $('.btn-danger').addClass('hide');
		        $('.btn-success').addClass('hide');

		        $('#div_add').addClass('hide');

		        $('#blah').addClass('hide');
		        $('#action_photo_link').val('');
		        $('#theme').val('');
		        $('#speaker').val('');
		        $('#datepicker_add').val('');
		    });

		    $(document).on('click', '.delete-modal', function() {
		        // var stuff = $(this).data('info').split(',');
		        // alert(stuff);
		        // fillmodalData(stuff) ;
		        // $('.actionBtn').removeClass('btn-success');
		        $('.actionBtn').addClass('btn-danger');
		        $('.actionBtn').addClass('delete');
		        $('.modal-title').text('刪除');
		        $('.deleteContent').show();
		        $('.form-horizontal').hide();
		        //$('.dname').html($(this).data('name'));
		        $('#AddModel').modal('show');
		        $('#action_button').text('刪除');
		        $('#action_button').addClass('glyphicon-trash');

	             var stuff = $(this).data('info');
		        $('#action_photo_id').val(stuff);
		    });

		    /*
				按下新增按鈕會做的事情
		    */
		     $(document).on('click', '.add-modal', function() {
				alert('新增');
//		         var video_link = $('#link').val();
//		         var theme = $('#theme').val();
//		         var speaker = $('#speaker').val();
//		         var video_date = $('#datepicker_add').val();
//		         var id="";
//
//		         $.ajax({
//		             type: 'post',
//		             url: '/MA_Edit_Sunday_Video',
//		             data: {
//		                 '_token': $('input[name=_token]').val(),
//		                 'video_link':video_link ,
//		                 'theme':theme,
//		                 'speaker': speaker  ,
//		                 'video_date': video_date
//		                     },
//		             success: function(data){
//		             	// alert(data['errors']);
//		                 if(data['ServerNo']=='200')
//		                 {
//		                 	alert('新增成功');
//		                 	// $('#videolink_'+stuff).val(data['data'].link);
//			                 // $('#theme_'+stuff).val(data['data'].theme);
//			                 // $('#speaker_'+stuff).val(data['data'].name);
//			                 // $('#datepicker_'+stuff).val(data['data'].video_date);
//			                 // $('iframe_'+stuff).attr("src",data['data'].link);
//		                 }else if(data['ServerNo']=='404')
//		                 {
//		                 	alert(data['errors']);
//		                 	// $('#videolink_'+stuff).val(video_link);
//			                 // $('#theme_'+stuff).val(theme);
//			                 // $('#speaker_'+stuff).val(speaker);
//			                 //  $('#datepicker_'+stuff).val(video_date);
//			                 // $('iframe_'+stuff).attr("src",data.link);
//		                 }
//
//		             }
//		         });
		     });


		    $(document).on('click', '.save-modal', function() {

	             var stuff = $(this).data('info');
	             // alert(stuff);
		        var id = stuff;
		        var photo_link = $('#photo_link_'+stuff).val();
		        var theme = $('#theme_'+stuff).val();
		        var content = $('#content'+stuff).val();
		        var photo_date = $('#datepicker_'+stuff).val();
		        // alert( id);
		        // var video_link = $('#speaker_'+stuff).val();

		        $.ajax({
		            type: 'post',
		            url: '{{route('ActionPhoto.Update')}}',//'/admin/MA_Update_ActionPhoto',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id':id,
		                'photo_link':photo_link ,
		                'theme':theme,
		                'speaker': content  ,
		                'photo_date': photo_date
		                    },
		            success: function(data){

						$('#photo_link_'+stuff).val(data['data'].photo_link);
						$('#theme_'+stuff).val(data['data'].title);
						$('#content'+stuff).val(data['data'].content);
						$('#datepicker_'+stuff).val(data['data'].photo_date);

                        $('#div_alert_'+id).removeClass('alert-danger').addClass('alert-success').removeClass('hide').show();
                        $('#alert_msg_'+id).val(data['Message']);
//                        $('#div_alert_'+id).addClass('alert-success');
//                        $('#div_alert_'+id).removeClass('hide');
                        setTimeout(function () {
                            $(".alert-block").hide(200);
                        }, 3000);

		            },error : function(e){
		                var errors = e.responseJSON;
                        $('#div_alert_'+id).removeClass('alert-success').addClass('alert-danger').removeClass('hide').show();
                        $('#alert_msg_'+id).val(errors.errors);

					}

		        });

            });

			 $('.modal-footer').on('click', '.delete', function() {
			 	
			 	// alert($('#action_photo_id').val());	
		        $.ajax({
		            type: 'post',
		            url: '{{route('ActionPhoto.Destory')}},///admin/MA_Delete_ActionPhoto',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id':  $('#action_photo_id').val()
		            },
		            success: function(data) {
		                $('#container_' + $('#action_photo_id').val()).remove();
		            }
		        });
		    });

			 /*
        		當按下修改按鈕時
		    */
		    $(document).on('click', '.edit-modal', function() {
		       var stuff = $(this).data('info').split(',');
		        $('.first').addClass('hide');
		        $('.second').removeClass('hide');
		        $('#update_action_button').text(" 更新");
		        $('#update_action_button').addClass('glyphicon-check');
		        $('#update_action_button').removeClass('glyphicon-trash');
		        $('.actionBtn').addClass('btn-success');
		        $('.actionBtn').removeClass('btn-danger');
		        $('.actionBtn').addClass('edit');
		        // alert(stuff[1]);
		        $.ajax({
		            type: 'post',
		            url: '/admin/MA_News_Edit',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id':stuff[0],
		                'title':stuff[1] ,
		                'action_date':stuff[2] ,
		                'content': stuff[3]       
					},
		            success: function(data){
		                // alert(data[1].title);
		                $('#news_title').val(data.title);
		                $('#datepicker').val(data.action_date);
		                $('#news_content').val(data.content);
		                $('#timepicker').val(data.action_time);
		                $('#action_postion').val(data.action_postion);
		                $('#news_id').val(data.id);

		                if(data.image==""){
		                    $('#edit_photo_text').text(" 新增照片");
		                    $('#ShowImg').attr('src','/photo/public/sample900_300.jpg');
		                    $('#spUpdatePhoto').text(" 上傳");

		                }else{
		                    
		                    $('#ShowImg').attr('src',data.image);
		                    $('#edit_photo_text').text(" 更換照片");
		                    $('#spUpdatePhoto').text(" 更新");
		                    // alert(data[0].image_path);
		                }
		              
		                //alert(data[0].id);
		            }
		        });
		    });

          $('.date-modal').datetimepicker({
	            yearOffset:0,  
	            lang:'zh-TW',
	            timepicker:false,
	            format:'Y-m-d',
	            formatDate:'Y-m-d'
    	  });

          /*
			2017/07/03.  當使用者更改照片連結
						 即時預覽照片
						 如果是修改原有照片，id參數應該會有值

          */
	    function readURL(input,id) {
	    	if(id==='')
	    	{ 		
	    		$('#blah').attr('src', input);
    			$('#blah').removeClass('hide');
    		}
	    	else 
	    	{
	    		// alert('test');
	    		$('#action_photo_link_'+id).attr('src', input);
	    	}
   
            // if (input.files && input.files[0]) {
            //     var reader = new FileReader();
 
            //     reader.onload = function (e) {
            //         $('#blah').attr('src', e.target.result);
            //     }
 
            //     reader.readAsDataURL(input.files[0]);
            // }

        }

            $(function () {
                $(".alert-block").click(function () {
                    $(".alert-block").slideToggle(200);
                    setTimeout(function () {
                        $(".alert-block").hide(200);
                    }, 3000);
                });

            });
		</script>
@stop