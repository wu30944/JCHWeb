@extends('admin.layouts.base')
@section('title','聚會時間資料維護')
@section('pageDesc','DashBoard')
@section('content')

<section class='container box'>
<style>
.table-borderless tbody tr td, .table-borderless tbody tr th,
    .table-borderless thead tr th {
    border: none;
}
</style>

<body>
    <div class="content full ">
        <div class="col-lg-12">
            <h1 class="page-header text-center">@lang('function_title.MANews')</h1>
        </div>
        <div class="first">
            @if(Gate::forUser(auth('admin')->user())->check('admin.data.create'))
            <div class="form-group row add">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                    </button>
                </div>
            </div>
            @endif
            <div class="table-responsive text-center">
                {{-- <table class="table table-borderless table-striped" id="gridview"> --}}
                <table class="table table-borderless table-striped" id="gridview">
                    {{-- <table id="gridview" class="text-center table-striped" cellspacing="0" width="70%"> --}}
                    <thead>
                        <tr>
                            <th class="text-center">標題</th>
                            <th class="text-center">建立時間</th>
                            <th class="text-center">內文</th>
                            <th class="text-center">Actions</th>
                            
                        </tr>
                    </thead>
                    @if(isset($dtNews))
                        @foreach($dtNews as $item)
                        <tr class="item{{$item->id}}">
                            <td align="left">{{$item->title}}</td>
                            <td>{{$item->created_at}}</td>
                            <td align="left">
                                {{mb_substr(strip_tags ($item->content),0,25,"utf-8")}}...
                                </td>

                            <td>
                                @if(Gate::forUser(auth('admin')->user())->check('admin.data.edit'))
                                <button class="edit-modal btn btn-info"
                                    data-info="{{$item->id}},{{$item->title}},{{$item->action_date}},{{$item->content}}">
                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                </button>
                                @endif
                                @if(Gate::forUser(auth('admin')->user())->check('admin.data.destory'))
                                    <button class="delete-modal btn btn-danger"
                                            data-info="{{$item->id}},{{$item->title}},{{$item->action_date}},{{$item->content}}">
                                        <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                    </button>
                                {{--<button class="delete-modal btn btn-danger"--}}
                                    {{--data-info="{{$item->id}},{{$item->title}},{{$item->action_date}},{{$item->content}}">--}}
                                    {{--<span class="glyphicon glyphicon-trash"></span> @lang('default.delete)--}}
                                {{--</button>--}}
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    @else
                        <div>
                            @lang('message.NoNews')
                        </div>
                    @endif
                </table>
            </div>
        </div>
        <div class="second hide">
                         <!-- Intro Content -->
            <h2>
                <label >標題：</label>
                <input type="text" id="news_title" >
                <input type="text" id="news_id" class="hide">
                {{-- <a href="{{route('news_d',$News->title)}}">{{$News->title}}</a> --}}
            </h2>

            <div class="input-append date col-md-12" id="dp3">
            <label >日期：</label>
              <input class="span2" size="16" type="text" id="datepicker">
              <span class="add-on"><i class="icon-th"></i></span>
              <label >時間：</label>
                <input type="text" id="timepicker"/><br><br>
            </div>
            <div class="col-md-12">
              <label >地點：</label>
                <input type="text" id="action_postion"/>            <br><br>
            </div>
            <hr>

            <div class="col-md-12">
                {{-- <img class="img-responsive show-update-img"  alt="" id="ShowImg" style="max-width: 500; max-height: 290px;"> --}}
                <div align="center">
                     <img class="img-responsive img-hover" src="/photo/sample900_300.jpg" alt="" id="ShowImg" style="max-width: width:100%; max-height: 400px;">
                </div>
                <button type="button" class="btn actionBtn" data-dismiss="modal" id="edit_photo">
                    <span id="edit_photo_text" class='glyphicon'></span>
                </button>
            </div>

            <div class="col-md-12">
             <hr>
             <br>
            {{-- <textarea id="editor1" style="width:100%;height:230px"></textarea> --}}

            <textarea cols="100" id="NewsEditor" name="NewsEditor" rows="10"></textarea>

            </div>

            <div class="add_modal-footer">
                <p class="error text-center alert alert-danger hidden"></p>

                    <button type="button" class="btn actionBtn" data-dismiss="modal" id="addbtn">
                        <span id="update_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="ctlCANCEL">
                        <span class='glyphicon glyphicon-remove'></span> 取消
                    </button>
            </div>
            <hr>
        </div>
    </div>
    <div id="Edit_Photo_Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="UploadPhotoForm" enctype="multipart/form-data" action="MA_Fellowship_Photo"  method="post">
                    {{ csrf_field() }}
                        <div class="size"></div>
                        <img class="img-responsive img-hover preview" src="http://placehold.it/900x300" alt="">
                        <label for="upload-profile-picture">

                             <input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl" >
                        </label>
                        </a>
                        <span id="upload-avatar"></span>
                     </form>
                    <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>
                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="btnUpdatePhoto" >
                            <span id="spUpdatePhoto" class='glyphicon glyphicon-check'></span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> 取消
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div id="DeleteModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">@lang('default.delete')</h4>
                </div>
                {{-- {!! Form::open(['route'=>'MADeleteFellowship','id'=>'FormDelete','class'=>'form-horizontal']) !!} --}}

                <div class="modal-body">
                    <div class="deleteContent" >
                        {{--<input type="text" class="form-control hide" id="FellowshipId" disabled="disabled">--}}
                        {{-- {!!form::text('FellowshipId','',['class'=>'form-control hide','id'=>'FellowshipId'])!!} --}}
                        @lang('default.sure_delete') <span class="dname"></span> ? <span
                                class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        {{--{!!Form::submit('刪除',['class'=>'btn glyphicon-trash btn-danger','id'=>'btnDelete']) !!}--}}
                        <button type="button" class='btn  btn-danger' id="btnDelete">
                            <span class='glyphicon glyphicon-trash'></span>  @lang('default.delete')
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span>  取消
                        </button>
                    </div>

                </div>
                {{-- {!! Form::close() !!} --}}
            </div>
        </div>
    </div>

</body>
</section>
@stop
@section('js')
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../js/ckeditor_api.js"></script>
    <script src="../js/jquery.datetimepicker.full.js"></script>
    <script>

        // Replace the <textarea id="editor1"> with an CKEditor instance.
            var objNewsEditor=CreateCKEDITOR('NewsEditor');


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
    function preview(input) {
        if (!input.files[0].type.match('image.*'))
        {
            $('#btnUpdatePhoto').attr('disabled','disabled');
            alert('您選擇的不是圖片檔案');
            $('#image').attr({value:''});

        }
        else if (input.files && input.files[0] ) {
            $('#btnUpdatePhoto').attr('disabled',false);
            var reader = new FileReader();
            objImg=input.files[0];
            reader.onload = function (e) {
                $('.preview').attr('src', e.target.result);
                var KB = format_float(e.total / 1024, 2);
                $('.size').text("檔案大小：" + KB + " KB");
                ImgURL=e.target.result
            }
 
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    $("body").on("change", ".upl", function (){
        preview(this);
    })

        /*
            日期
            只給使用者選擇日期
            yearOffset:點開後今年＋yearOffset就會是目前的年份  
            lang:語言 通常會用'zh-TW'
            timepicker:是否藏掉選擇時間的控制項
            format:顯示在畫面上日期格式 'Y/m/d',
            formatDate: 'Y/m/d'
        */
      $('#datepicker').datetimepicker({
            yearOffset:0,  
            lang:'zh-TW',
            timepicker:false,
            format:'Y/m/d',
            formatDate:'Y/m/d'
      });

      /*
            時間
            datepicker:是否藏掉選擇日期的控制項 false,
            format:選擇時間格式'H:i',
            step:選擇時間的區間 30
      */
      $('#timepicker').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });      

    /*
        上傳
        //如果ID是空的表示此筆消息是新增，如果動作是新增，則上傳照片必須要等到按下新增按鈕才會執行上傳的動作
        //如果是以存在的資料，ID應該不會是空的，當按下更新鈕就去執行
      */
    $("#btnUpdatePhoto").on('click', function(){
        
        if($('#news_id').val()!="")
        {
            alert('上傳照片');
            saveImg(objImg);
        }else
        {
            ShowImg(objImg);
            $('#edit_photo_text').text("更換照片");
        }     

    });

    function saveImg(img)
    {
        if(img.type.match('image.*'))
        {
            var formData = new FormData();
            formData.append('image', img);
            formData.append('id',$('#news_id').val());
            formData.append('_token',$('input[name=_token]').val());
            $.ajax({
                    url: '/admin/MA_News_Photo',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    success: function(data){
                          if(data['ServerNo']=='200'){
                            // 如果成功
                           $('#ShowImg').attr('src', data['ResultData']);
                           ShowImg(img);
                            // alert(data['ResultData']);
                           // $(obj).off('change');
                            
                          }else if(data['ServerNo']=='404'){
                            alert(data['errors']);
                            // 如果失败
                              // alert(data['ResultData']);
                          }
                    }
            });

        }
    }

    /**
     * 更新圖片後，將畫面上的圖片更換掉
     * @param   input 輸入 input[type=file] 的 this
    */
    function ShowImg(input) {

        var reader = new FileReader();
        reader.onload = function (e) {
        $('#ShowImg').attr('src', ImgURL);
        }
        reader.readAsDataURL(input);    
    }


    /*
        當按下修改按鈕時
    */
    $(document).on('click', '.edit-modal', function() {
       var stuff = $(this).data('info').split(',');
        $('.first').addClass('hide');
        $('.second').removeClass('hide');
        $('#update_action_button').text("更新");
        $('#update_action_button').addClass('glyphicon-check');
        $('#update_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        // $('.actionBtn').addClass('edit');
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
                // $('#editor1').val(data.content);
                InsertHTML(objNewsEditor,data.content);
                $('#timepicker').val(data.action_time);
                $('#action_postion').val(data.action_postion);
                $('#news_id').val(data.id);

                if(data.image==""){
                    $('#edit_photo_text').text("新增照片");
                    $('#edit_photo_text').addClass('glyphicon-check');
                    $('#ShowImg').attr('src','/photo/sample900_300.jpg');
                    $('#spUpdatePhoto').text("上傳");
                   

                }else{
                    
                    $('#ShowImg').attr('src',data.image);
                    $('#edit_photo_text').text("更換照片");
                    $('#spUpdatePhoto').text("更新");

                    // alert(data[0].image_path);
                }
              
                //alert(data[0].id);
            }
        });
    });

    /*
        當按下圖片修改按鈕時
    */
    $('#edit_photo').on('click', function() {
        // $('.second').addClass('hide');
        $('.form-horizontal').show();
        $('.deleteContent').hide();
        $('#btnUpdatePhoto').text("確認");
        $('#spUpdatePhoto').addClass('glyphicon-check');
        $('#Edit_Photo_Modal').modal('show');

    });


    /*
        當按下取消按鈕時
    */

    $('#ctlCANCEL').on('click', function() {
        $('.second').addClass('hide');
        $('.first').removeClass('hide');
        $("#ShowImg").removeAttr("src");
        ClearText(objNewsEditor);
        // $(".container").find(":text,textarea,file").each(function() {
        //         $(this).val("");
        //     });

    });


    $('#addbtn').on('click', function() {

         // alert(GetContents(objEditor1));
        $.ajax({
            type: 'post',
            url: '/admin/MA_News_Save',
            data: {
                    '_token': $('input[name=_token]').val(),
                    'news_title': $('#news_title').val(),
                    'action_date': $('#datepicker').val(),
                    'action_time': $('#timepicker').val(),
                    'news_content': GetContents(objNewsEditor),//$('#editor1').val(),
                    'action_postion': $('#action_postion').val(),
                    'id':$('#news_id').val()
                   }
            , success: function(data){
                //如果＃news_id是空的，表示一開始是沒有值的，所以就要新增到畫面上

                if($('#news_id').val()=="")
                {
                    $('#gridview').append("<tr class='item" + data['data'].id + "'><td align='left'>" + data['data'].title + "</td><td>" + data['data'].action_date + "</td><td align='left'>" + data['content'].substr(0,25) + "</td><td><button class='edit-modal btn btn-info' data-info='"+ data.id+","+data['data'].title+","+data['content']+","+data['data'].action_date+"' data-id='" + data['data'].id + "'><span class='glyphicon glyphicon-edit'></span> 修改</button> <button class='delete-modal btn btn-danger' data-info='"+data['data'].id+","+data['data'].title+","+data['data'].action_date+","+data['content']+"' data-id='" + data['data'].id + "' ><span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");

                    /*
                    *   修正新增訊息在第一次上傳照片會錯誤的問題
                    * */
                    $('#news_id').val(data['data'].id);

                    /*
                        此處要判斷是否有上傳照片，如果該參數是未定義，
                        就不需要跑saveImg這個Function
                    */
                    if(typeof(objImg) != "undefined")
                        saveImg(objImg);

                }else
                {
                    // alert(data['content']);
                    $('.item' + data['data'].id).replaceWith("<tr class='item" + data['data'].id + "'><td align='left'>" + data['data'].title + "</td><td>" + data['data'].action_date + "</td><td align='left'>" + data['content'].substr(0,25) + "</td><td><button class='edit-modal btn btn-info' data-info='"+ data['data'].id+","+data['data'].title+","+data['data'].action_date+","+data['data'].content+"' data-id='" + data['data'].id + "'><span class='glyphicon glyphicon-edit'></span> 修改</button> <button class='delete-modal btn btn-danger' data-info='"+data['data'].id+","+data['data'].title+","+data['data'].action_date+","+data['content']+"' data-id='" + data['data'].id + "' ><span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");

                }
                /*
                * 2017/10/09  修改為，當新增完畢後就重新刷新頁面
                * */
                location.reload();
//                $('.second').addClass('hide');
//                $('.first').removeClass('hide');
//                alert('儲存成功');
//                $("#ShowImg").removeAttr("src");
            },error: function(e)
            {

            }

        });

    });


    $(document).on('click', '.delete-modal', function() {
        //$('.dname').html($(this).data('name'));
        $('#DeleteModel').modal('show');

        var stuff = $(this).data('info').split(',');
        // alert(stuff[0]);
        $('#news_id').val(stuff[0]);
    });

    $('#btnDelete').on('click',function()
    {
         $.ajax({
            type: 'post',
            url: '/admin/MA_News_Delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#news_id').val()
            },
            success: function(data) {
                $('.item' + $('#news_id').val()).remove();
            }
        });
    });


    $('#add').on('click', function() {
        //先將控制項的內容都清空
        $(".container").find(":text,textarea,file").each(function() {
            $(this).val("");
        });
        ClearText(objNewsEditor);

        $('.first').addClass('hide');
        $('.second').removeClass('hide');
        $('#update_action_button').text("新增消息");
        $('#update_action_button').addClass('glyphicon-check');
        $('#update_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        // $('.actionBtn').addClass('edit');
        $('#edit_photo_text').text("新增照片");
        $('#edit_photo_text').addClass('glyphicon-plus');
        $('#spUpdatePhoto').text("確認");
        $('#ShowImg').attr('src','/photo/sample900_300.jpg');
        /*
        * 按下新增按鈕就把儲存ID的隱藏控制項內容清空
        * */
        $('#news_id').val('');
    });

</script>
@stop