@extends('admin.layouts.base')
@section('title','最新消息維護')
@section('pageDesc','DashBoard')
@section('content')

<section class='container box'>
<style>
.table-borderless tbody tr td, .table-borderless tbody tr th,
    .table-borderless thead tr th {
    border: none;
}
.tooltip > .tooltip-inner {background-color: #ff0000; color: 000000;}
.tooltip.left .tooltip-arrow { border-left-color: #F7F7F7; }
.tooltip.top .tooltip-arrow { border-top-color: #ff0000; }
.tooltip.right .tooltip-arrow { border-right-color: #ff0000;}
.tooltip.bottom .tooltip-arrow { border-bottom-color: #F7F7F7; }
</style>

<body>
    <div class="content full ">
        <div class="col-lg-12">
            <h1 class="page-header text-center">@lang('function_title.MANews')</h1>
        </div>
        <div class="first">
            @if(Gate::forUser(auth('admin')->user())->check('admin.News.Create'))
            <div class="form-group row add">
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                    </button>
                </div>
            </div>
            @endif

            <div class="alert alert-block alert-success hide" id="SuccessAlter">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>
                    <input  style="background-color:   transparent;   border:   0px" readonly="true" value="@lang('message.SaveSuccess')" id="SuccessMsg">
                </strong>
            </div>


            <div class="table-responsive text-center">
                {{-- <table class="table table-borderless table-striped" id="gridview"> --}}
                <table class="table table-borderless table-striped" id="gridview">
                    {{-- <table id="gridview" class="text-center table-striped" cellspacing="0" width="70%"> --}}
                    <thead>
                        <tr>
                            <th class="text-center">標題</th>
                            <th class="text-center">建立時間</th>
                            <th class="text-center">內文</th>
                            @if(Gate::forUser(auth('admin')->user())->check('admin.News.Edit') or Gate::forUser(auth('admin')->user())->check('admin.News.Destory'))
                            <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    @if(isset($dtNews))
                        @foreach($dtNews as $item)
                        <tr class="item{{$item->id}}">
                            <td align="left"><p id="Title{{$item->id}}">{{$item->title}}</p></td>
                            <td><p id="CreateAt{{$item->id}}">{{$item->created_at}}</p></td>
                            <td align="left">
                                <p id="Content{{$item->id}}">{{mb_substr(strip_tags ($item->content),0,25,"utf-8")}}...</p>
                            </td>

                            <td>
                                @if(Gate::forUser(auth('admin')->user())->check('admin.News.Edit'))
                                <button class="edit-modal btn btn-info"
                                    data-info="{{$item->id}},{{$item->title}},{{$item->action_date}},{{$item->content}}">
                                    <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                </button>
                                @endif
                                @if(Gate::forUser(auth('admin')->user())->check('admin.News.Destory'))
                                    <button class="delete-modal btn btn-danger"
                                            data-info="{{$item->id}},{{$item->title}},{{$item->action_date}},{{$item->content}}">
                                        <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                    </button>
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
            <p class="error text-center alert alert-danger hidden"></p>
            <div class="form-group col-md-12">
                <h4>
                    <label for="news_title" class="control-label" align="right">@lang('default.title')：</label>
                    <input type="text" id="edit_news_title" style="width:50%" >
                    <input type="text" id="news_id" class="hide">
                </h4>
            </div>
            <div class="form-group col-md-12">
                <h4>
                    <label for="action_date" class="control-label " align="right">@lang('default.date')：</label>
                    {{--{!!form::text('action_date','',['id'=>'edit_action_date','style'=>'width:15%'])!!}--}}
                    <input class="span2"  type="text" id="edit_action_date" style="width:15%" >
                </h4>
            </div>
            <div class="form-group col-md-12">
                <h4>
                    <label for="timepicker" class="control-label " >@lang('default.time')：</label>
                    {{--{!!form::text('action_time','',['id'=>'edit_timepicker','style'=>'width:10%'])!!}--}}
                    <input type="text" id="edit_timepicker" style="width:10%">
                </h4>
            </div>
            <div class="form-group col-md-12">
                <h4>
                    <label for="action_position" class="control-label" >@lang('default.position')：</label>
                    {{--{!!form::text('action_position','',['id'=>'edit_action_position'])!!}--}}
                    <input type="text" id="edit_action_position" >
                </h4>
            </div>

            <hr>

            <div class="col-md-12">
                <div align="center">
                     <img class="img-responsive img-hover" src="http://placehold.it/900x300" alt="" id="ShowImg" style="max-width:100%; max-height: 400px;">
                </div>
                <button type="button" class="btn actionBtn" data-dismiss="modal" id="edit_photo">
                    <span id="edit_photo_text" class='glyphicon'></span>
                </button>
            </div>

            <div class="col-md-12">

                <hr>
                {{-- <textarea id="editor1" style="width:100%;height:230px"></textarea> --}}

                 <textarea id="edit_news_content" name="news_content" ></textarea>

            </div>

            <div class="add_modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal" id="UpdateBtn">
                        <span id="update_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning btn-cancel" data-dismiss="modal" id="ctlCANCEL">
                        <span class='glyphicon glyphicon-remove'></span> 取消
                    </button>
            </div>
            <hr>
        </div>
        {!! Form::open(['route'=>'News.Create','id'=>'CreateForm', 'files' => true,'class'=>'hide']) !!}
        <div class="row">
            <div class="col-md-12 text-center" >
                <div class="" align="left">
                    <div class="caption" >
                        <div class="form-group col-md-12">
                            <h4>
                                <label for="news_title" class="control-label" align="right">@lang('default.title')：</label>
                                {{--<input class="span2_add " size="16" type="text" style="width:100%;" name="photo_link" onchange="readURL(this.value,'');" id="action_photo_link">--}}
                                {!!form::text('news_title','',['id'=>'create_news_title','style'=>'width:50%'])!!}
                            </h4>
                        </div>
                        <div class="form-group col-md-12">
                            <h4>
                                <label for="action_date" class="control-label " align="right">@lang('default.date')：</label>
                                {{--<input class="span3_add " size="16" type="text" id="theme" name="theme" style="width:80%;"><br>--}}
                                {!!form::text('action_date','',['id'=>'create_action_date','style'=>'width:15%'])!!}
                            </h4>
                        </div>
                        <div class="form-group col-md-12">
                            <h4>
                                <label for="timepicker" class="control-label " >@lang('default.time')：</label>
                                {{--<input class="span3_add " size="16" type="text" id="speaker" name="speaker" style="width:80%;"><br>--}}
                                {!!form::text('action_time','',['id'=>'create_timepicker','style'=>'width:10%'])!!}
                            </h4>
                        </div>
                        <div class="form-group col-md-12">
                            <h4>
                                <label for="action_position" class="control-label" >@lang('default.position')：</label>
                                {{--<input class="date-modal" size="16" type="text" id="datepicker_add" name="photo_date" >--}}
                                {!!form::text('action_position','',['id'=>'create_action_position'])!!}
                            </h4>
                        </div>
                        <div class="form-group col-md-12">
                            <div align="center">
                                <img name="image" class="img-responsive img-hover" src="http://placehold.it/1500x300" alt="" id="" style="max-width:100%; max-height: 400px;">
                            </div>
                            <button type="button" class="btn actionBtn btn-success" data-dismiss="modal" id="choice_photo">
                                <span class='glyphicon glyphicon-check' ></span> @lang('default.upload_photo')
                            </button>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <textarea id="news_content" name="news_content" ></textarea>
                        </div>

                        <div class="form-group col-md-12" align="right">
                            <button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="" >
                                <span class='glyphicon glyphicon-check'> </span> @lang('default.add')
                            </button>
                            {{-- <input class="submit" type="submit" value="加入"/> --}}
                            <button type="button" class="btn btn-warning btn-cancel" data-dismiss="modal" >
                                <span class='glyphicon glyphicon-remove'></span> 取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </form> --}}
            <div id="Create_Photo_Modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="size"></div>
                            <img class="img-responsive img-hover preview" src="http://placehold.it/900x300" alt="">
                            <label for="upload-profile-picture">
                                {!! Form::file('image',[ 'id'=>'create_photo','class'=>'upl']) !!}
                                {{--<input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl" >--}}
                            </label>
                            </a>
                            <span id="upload-avatar"></span>
                            <div class="modal-footer">
                                <p class="error text-center alert alert-danger hidden"></p>
                                <button type="button" class="btn actionBtn btn-success btn-check" data-dismiss="modal" id="btnUpdatePhoto" >
                                    <span id="spUpdatePhoto" class='glyphicon glyphicon-check'></span> @lang('default.check')
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> 取消
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
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
                        <button type="button" class="btn actionBtn btn-success btn-check" data-dismiss="modal" id="" >
                            <span id="spUpdatePhoto" class='glyphicon glyphicon-check'></span> @lang('default.check')
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
    <script src="../js/jquery.validate.js"></script>
    <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
    <script>

        $().ready(function() {

                $("#CreateForm").validate({
                    rules: {
                        news_title:{
                            required: true,
                            minlength: 3
                        },
                        action_date:{
                            required: true
                        }
                    },
                    messages: {
                        news_title: "請輸入標題",
                        action_date:"請輸入日期"
                }
//                ,errorPlacement: function(error, element) { //錯誤信息位置設置方法
//                        error.appendTo( element.parent().next() ); //這裡的element是錄入數據的對象
//                    }
            });
        });


        // Replace the <textarea id="editor1"> with an CKEditor instance.
        var objNewsEditor=CreateCKEDITOR('edit_news_content');
        var objCreateNewsEditor=CreateCKEDITOR('news_content');


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
            $('.btn-check').attr('disabled','disabled');
            alert('您選擇的不是圖片檔案');
            $('#image').attr({value:''});

        }
        else if (input.files && input.files[0] ) {
            $('.btn-check').attr('disabled',false);
            var reader = new FileReader();
            objImg=input.files[0];
            $('#create_image').val(objImg);
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
    });

        /*
            日期
            只給使用者選擇日期
            yearOffset:點開後今年＋yearOffset就會是目前的年份  
            lang:語言 通常會用'zh-TW'
            timepicker:是否藏掉選擇時間的控制項
            format:顯示在畫面上日期格式 'Y/m/d',
            formatDate: 'Y/m/d'
        */
      $('#edit_action_date').datetimepicker({
            yearOffset:0,  
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
      });

    $('#create_action_date').datetimepicker({
        yearOffset:0,
        lang:'zh-TW',
        timepicker:false,
        format:'Y-m-d',
        formatDate:'Y-m-d'
    });

      /*
        時間
        datepicker:是否藏掉選擇日期的控制項 false,
        format:選擇時間格式'H:i',
        step:選擇時間的區間 30
      */
      $('#edit_timepicker').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });

    $('#create_timepicker').datetimepicker({
        datepicker:false,
        format:'H:i',
        step:30
    });

        /*
            上傳
            //如果ID是空的表示此筆消息是新增，如果動作是新增，則上傳照片必須要等到按下新增按鈕才會執行上傳的動作
            //如果是以存在的資料，ID應該不會是空的，當按下更新鈕就去執行
          */
    $(".btn-check").on('click', function(){

          ShowImg(objImg);
//
//        if($('#news_id').val()!="")
//        {
//            saveImg(objImg);
//        }else
//        {
//            ShowImg(objImg);
//            $('#edit_photo_text').text("更換照片");
//        }

    });


    /**
     * 更新圖片後，將畫面上的圖片更換掉
     * @param   input 輸入 input[type=file] 的 this
    */
    function ShowImg(input) {
        //alert('test');
        var reader = new FileReader();
        reader.onload = function (e) {

            $('.img-responsive').attr('src', ImgURL);
            alert(input.val());

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
            url: '{{route('News.Edit')}}',//'/admin/MA_News_Edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'id':stuff[0],
                'title':stuff[1] ,
                'action_date':stuff[2] ,
                'content': stuff[3]       
                    },
            success: function(data){
                // alert(data[1].title);
                $('#edit_news_title').val(data.title);
                $('#edit_action_date').val(data.action_date);
                // $('#editor1').val(data.content);
                InsertHTML(objNewsEditor,data.content);
                $('#edit_timepicker').val(data.action_time);
                $('#edit_action_position').val(data.action_position);
                $('#news_id').val(data.id);

                if(data.image==""){
                    //alert('add');
                    $('#edit_photo_text').text("新增照片");
                    $('#edit_photo_text').addClass('glyphicon-check');
                    $('#ShowImg').attr('src','http://placehold.it/900x300');


                }else{
                    //alert('update');
                    $('#ShowImg').attr('src',data.image);
                    $('#edit_photo_text').text("更換照片");

                    // alert(data[0].image_path);
                }
                $(window).scrollTop(0);
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
        $('#spUpdatePhoto').addClass('glyphicon-check');
        $('#Edit_Photo_Modal').modal('show');

    });

    /*
        當按下圖片修改按鈕時
    */
    $('#choice_photo').on('click', function() {
        // $('.second').addClass('hide');
        $('.form-horizontal').show();
        $('.deleteContent').hide();
        $('#spUpdatePhoto').addClass('glyphicon-check');
        $('#Create_Photo_Modal').modal('show');

    });



    /*
        當按下取消按鈕時
    */

    $('.btn-cancel').on('click', function() {
        $('.second').addClass('hide');
        $('.first').removeClass('hide');
        $("#ShowImg").removeAttr("src");
        ClearText(objNewsEditor);

        $('.error').text('');
        $('.error').addClass('hidden');

        $('#CreateForm').addClass('hide');

        $(window).scrollTop(0);
        $('.img-responsive').attr('src','http://placehold.it/900x300');
        $('.upl').val('');
        objImg.empty();

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

    /*
    *   2017/11/07  原來寫法為：按下編輯，點選更換相片，進入選擇相片，選擇完畢後，就會呼叫後端去將圖片儲存
    *               改為：選擇完畢按下確定，不會呼叫後端，而是等到按下更新按鈕才去將圖片上傳儲存
    * */
    $('#UpdateBtn').on('click', function() {
        var $id = $('#news_id').val();
        if(typeof(objImg) != "undefined")
        {
            var formData = new FormData();
            formData.append('image', objImg);
            formData.append('id',$id);
            formData.append('news_title',$('#edit_news_title').val());
            formData.append('action_date',$('#edit_action_date').val());
            formData.append('action_time',$('#edit_timepicker').val());
            formData.append('news_content',GetContents(objNewsEditor));
            formData.append('action_position',$('#edit_action_position').val());
            formData.append('_token',$('input[name=_token]').val());
            $.ajax({
                url: '{{route('News.Update')}}',//'/admin/MA_News_Photo',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                success: function(data){
                    if(data['ServerNo']=='200'){
                        //alert(data['content']);
                        $('#Title'+$id).text(data['ResultData'].title);
                        $('#Content'+$id).text(data['content']);
                        $('.second').addClass('hide');
                        $('.first').removeClass('hide');

                        $('#SuccessAlter').removeClass('hide');
                        $('#SuccessAlter').show();

                        $('.upl').val('');

                        setTimeout(function () {
                            $(".alert-block").hide(200);
                        }, 3000);
                        $(window).scrollTop(0);
                    }
                },error: function(e)
                {

                    var errors = e.responseJSON;
                    //errors.Message.length 顯示傳回來有多少個元素
                    //alert(errors.Message.length);
                    //error.Message[] 這種方式為取出回傳元素個別的值

                    //var ControlID = errors.Message[1];
                    alert(errors.Message);
                    $(window).scrollTop(0);

                    //MessageShow(errors.Key,errors.Message);
                }
            });

        }else{
            $.ajax({
                type: 'post',
                url: '{{route('News.Update')}}',//'/admin/MA_News_Insert',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'news_title': $('#edit_news_title').val(),
                    'action_date': $('#edit_action_date').val(),
                    'action_time': $('#edit_timepicker').val(),
                    'news_content': GetContents(objNewsEditor),//$('#editor1').val(),
                    'action_position': $('#edit_action_position').val(),
                    'id':$id
                }
                , success: function(data){
                    if(data['ServerNo']=='200'){
//                        alert(data['content']);
                        $('#Title'+$id).text(data['ResultData'].title);
                        $('#Content'+$id).text(data['content']);
                        $('.second').addClass('hide');
                        $('.first').removeClass('hide');

                        $('#SuccessAlter').removeClass('hide');
                        $('#SuccessAlter').show();

                        $('.upl').val('');

                        setTimeout(function () {
                            $(".alert-block").hide(200);
                        }, 3000);
                        $(window).scrollTop(0);
                    }

                },error: function(e)
                {
                    var errors = e.responseJSON;
                    //errors.Message.length 顯示傳回來有多少個元素
                    //alert(errors.Message.length);
                    //error.Message[] 這種方式為取出回傳元素個別的值

                    //var ControlID = errors.Message[1];

                    $(window).scrollTop(0);
                    MessageShow(errors.Key,errors.Message);
                }

            });
        }

        ClearText(objNewsEditor);
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
            url: '{{route('News.Destory')}}',//'/admin/MA_News_Delete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#news_id').val()
            },
            success: function(data) {

                $('.item' + $('#news_id').val()).remove();

            }, errors:function(e){
                 var errors = e.responseJSON;
                 $(window).scrollTop(0);
                 alert(errors.Message);
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
        $('#CreateForm').removeClass('hide');
        $('#update_action_button').text("新增消息");
        $('#update_action_button').addClass('glyphicon-check');
        $('#update_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        // $('.actionBtn').addClass('edit');
        $('#edit_photo_text').text("新增照片");
        $('#edit_photo_text').addClass('glyphicon-plus');
        $('#ShowImg').attr('src','http://placehold.it/900x300');
        /*
        * 按下新增按鈕就把儲存ID的隱藏控制項內容清空
        * */
        $('#news_id').val('');
    });

</script>
@stop