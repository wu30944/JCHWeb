@extends('TmpView.tmp')

@section('title','更多影片')

@section('content')
	<section class='container'>
		<!-- Team Members -->
	        <div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header text-center">禮拜影片</h1>
	            </div>

		    <div class="container" >
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

             <div class="alert alert-success alert-block hide" id="alert_block">
	                <button type="button" class="close" data-dismiss="alert">×</button>
	                <strong >
	                	<input class="span3" size="16" type="text" id="message" style="border-style:none;outline:none" readonly="true" >
	                </strong>
            </div>


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

			{!! Form::open(['url'=>'MA_Insert_Sunday_Video','id'=>'form_link_add']) !!} 
            {{-- <form id="form_link_add" method="post" action="{{ url('MA_Insert_Sunday_Video') }}"> --}}
	            <div class="col-md-4 text-center hide" id="div_add" >
		                <div class="thumbnail">
		                   {{--   <div class="embed-responsive embed-responsive-4by3">
	                       		 <iframe class="embed-responsive-item" src="" frameborder="0" allowfullscreen id=""></iframe>
	                    	</div> --}}

		                    <div class="caption" align="left">
		                    	<p>
	                					<div style="display: inline;">
	            						{!!form::label('video_type','影音類型:')!!}
	            						</div>
	                    				<div style="display: inline;">
	                    				{!! Form::select('video_type',$ItemAll, old('video_type'), ['placeholder'=>'Select Category','style'=>'width:120px']) !!}
	                    				</div>
			                         </p>
		                        <p>
	                        		<label for="link">影片連結：</label><br>
	                        			{{-- {{$more_youtube->link}} --}}
	                    				<input class="span2_add " size="16" type="text" style="width:100%;" id="video_link" name="video_link">
	                    		</p>
                				<p>
	                    				<label for="theme">主題：</label><br>
	                    				<input class="span3_add " size="16" type="text" id="theme" name="theme" style="width:80%;"><br>
		                         </p>
		                         <p>
		                            <label for="speaker">專講人員：</label><br>
		                            	<input class="span3_add " size="16" type="text" id="speaker" name="speaker" style="width:80%;"><br>
	                             </p>
	                             <p>
		                        <label for="video_date">日期：</label><br>
	        						  <input class="date-modal" size="16" type="text" id="datepicker_add" name="video_date" >
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
		    @if (isset($dtvideos))
		    	{{-- expr --}}
		    	@foreach ($dtvideos as $more_youtube)
			    	 <div class="col-md-4 text-center" id="container_{{$more_youtube->id}}">
		                <div class="thumbnail">
		                     <div class="embed-responsive embed-responsive-4by3">
                           		 <iframe class="embed-responsive-item" src="{{$more_youtube->link}}" frameborder="0" allowfullscreen id="iframe_{{$more_youtube->id}}"></iframe>
                        	</div>

		                    <div class="caption" align="left">
		                    <p>
	                					<div style="display: inline;">
	            						{!!form::label('video_type','影音類型:')!!}
	            						</div>
	                    				<div style="display: inline;">
	                    				{!! Form::select('video_type_'.$more_youtube->id,$ItemAll, $more_youtube->type, ['placeholder'=>'Select Category','style'=>'width:130px','disabled'=>'disabled','class'=>'span4','id'=>'video_type_'.$more_youtube->id]) !!}
	                    				</div>
			                         </p>
		                        <p>	
                            		<label >影片連結:</label><br>
                            			{{-- {{$more_youtube->link}} --}}
                        				<input class="span2" size="16" type="text" style="width:100%;border-style:none;outline:none" readonly="true" id="videolink_{{$more_youtube->id}}" value="{{$more_youtube->link}}" >
                				</p>

                				<p>
                        				<h3>主題:<input class="span3" size="16" type="text" id="theme_{{$more_youtube->id}}" value="{{$more_youtube->theme}}" style="border-style:none;outline:none" readonly="true" ></h3>
                				</p>
                				<p>
		                            <small>專講人員:<input class="span3" size="16" type="text" id="speaker_{{$more_youtube->id}}" value="{{$more_youtube->name}}" style="border-style:none;outline:none" readonly="true" ></small>
                                     
		                        
		                        </p>
		                        <p>
		                        <label >日期:</label>
            						  <input class="date-modal" size="16" type="text" id="datepicker_{{$more_youtube->id}}" style="border-style:none;outline:none" readonly="true" value="{{$more_youtube->video_date}}">
    						  </p>
	                            <div align="right">                                
		                            <button type="button" class="save-modal btn btn-success hide" data-info="{{$more_youtube->id}}" data-dismiss="modal" id="save_{{$more_youtube->id}}" >
	                        			<span class='glyphicon glyphicon-check'> </span>儲存
	                    			</button>	

	                                <button class="delete-modal btn btn-danger hide"
	                                    data-info="{{$more_youtube->id}}">
	                                    <span class="glyphicon glyphicon-trash"></span> 刪除
	                                </button>

                        		</div>
		                    </div>
		                </div>
		            </div>
		    	@endforeach
		    @endif
			 <input class="hide"  id="action_video_id">
			</div>

			<!--下列方法為顯示分頁頁碼，配合controller當中elquent模型的DB::paginate(一面幾筆資料)
			要記得，必須要有paginate()，在blade才能夠使用下列方法-->
	        <div class="row">
	            <div class="col-lg-12 text-center">
	               {{$dtvideos->render()}}
	            </div>
			</div>
			{{-- @include('WebUIControl.Pager') --}}
				{{-- 20170611.  增禮拜影片新增頁面 --}}
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
	                                <label class="control-label col-sm-2" for="Addfellowship_name">影片連結:</label>
	                                <div class="col-sm-10">
	                                    <input type="text" class="form-control" id="Addfellowship_name" >
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addmeeting_time">主題:</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addmeeting_time">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addday">專講人員:</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addday">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="control-label col-sm-2" for="Addfloor">日期:</label>
	                                <div class="col-sm-10">
	                                    <input type="name" class="form-control" id="Addfloor">
	                                </div>
	                            </div>
	                        </form>
	                        <div class="deleteContent">
	                            您確定要刪除此影片 <span class="dname"></span> ? <span
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
	        {{-- 下面的link是，為了讓必輸欄位如果沒有輸入資料控制項變為紅色，提示文字為紅色 --}}
	        <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
		    <script src="../js/jquery.datetimepicker.full.js"></script>
	        <script src="../js/jquery.validate.js"></script>
			<script>
			// validate signup form on keyup and submit
			// $(function(){
			// 	//須與form表單ID名稱相同
			// 	$("#form_link_add").validate();
			// });

			// $(function(){ 
			// var validate = $("#form_link_add").validate({ 
			// debug: false, //調試模式取消submit的默認提交功能 //
			// //errorClass: "label.error", //默認為錯誤的樣式類為︰error 
			// focusInvalid: false, //當為false時，驗證無效時，沒有焦點響應 
			// onkeyup: false, 
			// submitHandler: function(form){ //表單提交句柄,為一回調函數，帶一個參數︰form 
			// alert("提交表單"); 
			// form.submit(); //提交表單 
			// }, 
			// rules:{ 
			// 	link:{ required:true }, 
			// 	theme:{ required:true }, 
			// 	speaker:{ 
			// 		required:true, 
			// 		}, 
			// 	datepicker_add:
			// 		{ required:true, 
			// 		} } }); }); 

			$().ready(function() {

				$("#form_link_add").validate({
					rules: {
						video_link:{
							required: true,
							minlength: 3
						},
						theme: {
							required: true,
							minlength: 1
						},
						speaker: {
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
						video_link: "請輸入影片連結",
						theme: "請輸入主題",
						speaker: {
							required: "請輸入講道牧師",
							minlength: "輸入的文字太少"
						},
						video_date: {
							required: "請輸入影片日期",
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

		        $('select[class="span4"]').removeAttr("disabled");

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

		        $('select[class="span4"]').attr('disabled',"disabled");
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
		        $('#action_video_id').val(stuff);
		    });

		    /*
				按下新增按鈕會做的事情
		    */
		    // $(document).on('click', '.add-modal', function() {

		    //     var video_link = $('#link').val();
		    //     var theme = $('#theme').val();
		    //     var speaker = $('#speaker').val();
		    //     var video_date = $('#datepicker_add').val();
		    //     var id="";

		    //     $.ajax({
		    //         type: 'post',
		    //         url: '/MA_Edit_Sunday_Video',
		    //         data: {
		    //             '_token': $('input[name=_token]').val(),
		    //             'video_link':video_link ,
		    //             'theme':theme,
		    //             'speaker': speaker  ,
		    //             'video_date': video_date     
		    //                 },
		    //         success: function(data){ 
		    //         	// alert(data['errors']);
		    //             if(data['ServerNo']=='200')
		    //             {	
		    //             	alert('新增成功');
		    //             	// $('#videolink_'+stuff).val(data['data'].link);
			   //              // $('#theme_'+stuff).val(data['data'].theme);
			   //              // $('#speaker_'+stuff).val(data['data'].name);
			   //              // $('#datepicker_'+stuff).val(data['data'].video_date);
			   //              // $('iframe_'+stuff).attr("src",data['data'].link);
		    //             }else if(data['ServerNo']=='404')
		    //             {
		    //             	alert(data['errors']);
		    //             	// $('#videolink_'+stuff).val(video_link);
			   //              // $('#theme_'+stuff).val(theme);
			   //              // $('#speaker_'+stuff).val(speaker);
			   //              //  $('#datepicker_'+stuff).val(video_date);
			   //              // $('iframe_'+stuff).attr("src",data.link);
		    //             }
		                
		    //         }
		    //     });
		    // });


		    $(document).on('click', '.save-modal', function() {
		       
	             var stuff = $(this).data('info');

		        var id = stuff;
		        var videolink = $('#videolink_'+id).val();
		        var speaker = $('#speaker_'+id).val();
		        var theme = $('#theme_'+id).val();
		        var datepicker = $('#datepicker_'+id).val();
		        var videotype = $('#video_type_'+id).val();


		        $.ajax({
		            type: 'post',
		            url: '/MA_Edit_Sunday_Video',
		            data: {
			                '_token': $('input[name=_token]').val(),
			                'id':id,
			                'video_link':videolink ,
			                'speaker':speaker,
			                'theme': theme  ,
			                'video_date': datepicker   ,
			                'video_type':videotype
		                    			},
		            success: function(data){ 
		            	// alert(data['errors']);
		                if(data['ServerNo']=='200')
		                {	
		                	alert(data['message']);
		                	$('#videolink_'+id).val(data['data'].link);
			                $('#speaker_'+id).val(data['data'].name);
			                $('#theme_'+id).val(data['data'].theme);
			                $('#datepicker_'+id).val(data['data'].video_date);
			                $('#video_type_'+id).val(data['data'].type);
		                }else if(data['ServerNo']=='404')
		                {
		                	// alert(data['message']);
		                	// $('#message').val(data['message']);
		                	// $('#alert_block').removeClass('hide');
		                	alert(data['message']);
		                	$('#videolink_'+id).val(videolink);
			                $('#speaker_'+id).val(speaker);
			                $('#theme_'+id).val(theme);
			                $('#datepicker_'+id).val(datepicker);
			              	$('#video_type_'+id).val(videotype);
			              }
		            }
		        });
		    });

			 $('.modal-footer').on('click', '.delete', function() {
			 	
			 	// alert($('#action_video_id').val());	
		        $.ajax({
		            type: 'post',
		            url: '/MA_Delete_Sunday_Video',
		            data: {
		                '_token': $('input[name=_token]').val(),
		                'id':  $('#action_video_id').val()
		            },
		            success: function(data) {
		                $('#container_' + $('#action_video_id').val()).remove();
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
		            url: '/MA_News_Edit',
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
		                    $('#ShowImg').attr('src','/photo/sample900*300.jpg');
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

              $(function () {
              // $(".alert-block").click(function () {
              //   $(".alert-block").slideToggle(200);
              //   setTimeout(function () {
              //     $(".alert-block").hide(200);
              //   }, 3000);
              // });
              
              setTimeout(function () {
                  $(".alert-block").hide(3000);
                }, 3000);
            })
			</script>

	</section>
@stop