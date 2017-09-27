@extends('admin.layouts.base')
@section('title','團契資料維護')
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
            <h1 class="page-header text-center">@lang('function_title.MAFellowship')</h1>
        </div>

    <div class="first">

            @if(Gate::forUser(auth('admin')->user())->check('admin.data.create'))
            <div class="form-group row add">
            <br>
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                    </button>
                </div>
            </div>
            @endif
            <div class="row">
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
                </div>
            {{ csrf_field() }}
            <div class="table-responsive text-center">
                {{-- <table class="table table-borderless table-striped" id="gridview"> --}}
                <table class="table table-borderless table-striped" id="gridview">
                    {{-- <table id="gridview" class="text-center table-striped" cellspacing="0" width="70%"> --}}
                    <thead>
                        <tr>
                            {{-- <th class="text-center">#</th> --}}
                            <th class="hidden"></th>
                            <th class="text-center">團契名稱</th>
                            @if(Gate::forUser(auth('admin')->user())->check('admin.data.edit'))
                            <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    @foreach($dtfellowship as $item)
                    <tr class="item{{$item->id}}">
                        {{-- <td>{{$item->id}}</td> --}}
                        <td class="hidden">{{$item->id}}</td>
                        <td>{{$item->NAME}}</td>
                        <td>
                            @if(Gate::forUser(auth('admin')->user())->check('admin.data.edit'))
                            <button class="edit-modal btn btn-info"
                                data-info="{{$item->NAME}},{{$item->id}},{{$item->PARA_1}}">
                                <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                            </button>
                            @endif
                            @if(Gate::forUser(auth('admin')->user())->check('admin.data.destory'))
                            <button class="delete-modal btn btn-danger"
                                data-info="{{$item->NAME}},{{$item->id}},{{$item->PARA_1}}">
                                <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="second hide" id="DivSecond">
                     <!-- Intro Content -->
                <div class="row">
                    <div class="col-md-6">
                         <div align="center">
                            <img class="img-responsive show-update-img"  alt="" id="ShowImg" style="max-width: 100%; max-height: 290px;">
                        </div>
                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="edit_photo">
                            <span id="edit_photo_" class='glyphicon'></span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="id" id="fellowship_id" class="hide">
                        <input type="text" id="Introduction_Title" value="" placeholder="團契名稱">
                        <br>
                        
                         <textarea id="Introduction_Content" name="Introduction_Content" rows="10"></textarea>
                        {{-- <textarea id="Introduction_Content" style="width:100%;height:230px" placeholder=""></textarea> --}}

                    </div>
                </div>
                <!-- /.row -->   

            <!-- Service Tabs -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Service Tabs</h2>
                </div>
                <div class="col-lg-12">

                    <ul id="myTab" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-tree"></i> 
                        <input type="text" id="Page_one_Title" value="" placeholder="請填寫"></a>
                        </li>
                        <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-car"></i>
                        <input type="text" id="Page_two_Title" value="">
                        </a>
                        </li>
                        <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-support"></i> 
                        <input type="text" id="Page_three_Title" value="">
                        </a>
                        </li>
                        <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-database"></i> 
                        <input type="text" id="Page_four_Title" value="">
                        </a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="service-one">
                            {{-- <input type="text" id="Page_one_Title_" value=""> --}}
                             {{-- <br> --}}
                            <textarea id="Page_one_Content" ></textarea>                          
                        </div>
                        <div class="tab-pane fade" id="service-two">
                            {{-- <input type="text" id="Page_two_Title_" value=""> --}}
                             {{-- <br> --}}
                            <textarea id="Page_two_Content" ></textarea>
                        </div>
                        <div class="tab-pane fade" id="service-three">
                            {{-- <input type="text" id="Page_three_Title_" value=""> --}}
                             {{-- <br> --}}
                            <textarea id="Page_three_Content" ></textarea>
                        </div>
                        <div class="tab-pane fade" id="service-four">
                            {{-- <input type="text" id="Page_four_Title_" value=""> --}}
                            {{-- <br> --}}
                            <textarea id="Page_four_Content" ></textarea>
                        </div>
                    </div>

                </div>
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
                {!! Form::open(['route'=>'MADeleteFellowship','id'=>'FormDelete','class'=>'form-horizontal']) !!}

                <div class="modal-body">
                    <div class="deleteContent" >
                        {{--<input type="text" class="form-control hide" id="FellowshipId" disabled="disabled">--}}
                        {!!form::text('FellowshipId','',['class'=>'form-control hide','id'=>'FellowshipId'])!!}
                        @lang('default.sure_delete') <span class="dname"></span> ? <span
                                class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        {{--{!!Form::submit('刪除',['class'=>'btn glyphicon-trash btn-danger','id'=>'btnDelete']) !!}--}}
                        <button type="submit" class='btn  btn-danger'>
                            <span class='glyphicon glyphicon-trash'></span>  @lang('default.delete')
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span>  取消
                        </button>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
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
                        <img class="img-responsive preview"  alt="" id="preview" src="/photo/public/sample.jpg">
                        <a href="#" class="btn button-change-profile-picture">

                        <label for="upload-profile-picture">
                            {{--<input type="file" name="file[]" multiple="multiple" required="required" draggable="true" class="upl"/>--}}
                             <input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl" >
                        </label>
                        </a>
                        <span id="upload-avatar"></span>
                    </form>
                    <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>
                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="editbtn">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        {{--<button type="button" class="btn actionBtn" data-dismiss="modal" id="btnUpdatePhoto">--}}
                            {{--<span id="spUpdatePhoto" class='glyphicon'>上傳</span>--}}
                        {{--</button>--}}
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span>  取消
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="AddModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    {{--<form class="form-horizontal" role="form" action="">--}}
                    {!! Form::open(['route'=>'MACreateFellowship','id'=>'form_add','class'=>'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Addfellowship_name">團契名稱:</label>
                            <div class="col-sm-10">
                                {!!form::text('fellowship_name','',['class'=>'form-control','id'=>'fellowship_name'])!!}
                            </div>
                        </div>

                        <div class="add_modal-footer" align="right">
                            <p class="error text-center alert alert-danger hidden"></p>
                            <button type="submit" class='btn' id="btnSave">
                                <span class='glyphicon glyphicon-check'></span>  @lang('default.save')
                            </button>

                            <button type="button" class="btn btn-warning btn-cancel" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span>  取消
                            </button>
                        </div>
                    {{--</form>--}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </body>
</section>
    @stop

    @section('js')
    <script src="../js/jquery.validate.js"></script>

    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../js/ckeditor_api.js"></script>
    {{--<script src="js/jquery.shCircleLoader.js" type="text/javascript"></script>--}}
    <script>
        var objIntroductionContent=CreateCKEDITOR('Introduction_Content',100);
        var objPageOneContent = CreateCKEDITOR('Page_one_Content');
        var objPageTwoContent =CreateCKEDITOR('Page_two_Content');
        var objPageThreeContent= CreateCKEDITOR('Page_three_Content');
        var objPageFourContent = CreateCKEDITOR('Page_four_Content');

        var validator;
        $().ready(function() {
        
           validator= $("#form_add").validate({
                rules: {
                    fellowship_name:{
                        required: true
                    }
                },
                messages: {
                    fellowship_name: "請輸入團契名稱"
                }
            });
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
    function preview(input) {

//        alert(input.files.length);
        if (!input.files[0].type.match('image.*'))
        {
            alert('您選擇的不是圖片檔案');
            $('#image').attr({value:''});

        }
        else if (input.files && input.files[0] ) {
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


    $("#editbtn").on('click', function(){
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
                              var strPhotoName = data['ResultData'].toString();
                              alert('上傳成功');
                              $('#ShowImg').attr('src', strPhotoName);

                            // $('input[name=ShowImg]').val(data);
                              /*
                               20170913 註解掉下面這段程式，會有錯誤
                               $(obj).off('change');
                              * */


                          }else{
                            alert('上傳失敗');
                            // 如果失败
                              // alert(data['ResultData']);
                          }
                    }
            });

        }

    });

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

        $.ajax({
            type: 'get',
            url: '/MA_Fellowship_D',
            data: {
                '_token': $('input[name=_token]').val(),
                'ID':stuff[1],
                    },
            success: function(data){
                $('#edit_photo').text(" 新增照片");
                $('#Introduction_Title').val(data[0].introduction_title);
                // $('#Introduction_Content').val(data[0].introduction_content);
                SetContents(objIntroductionContent,data[0].introduction_content);
                $('#Page_one_Title').val(data[0].page_one_title);
                $('#Page_two_Title').val(data[0].page_two_title);
                $('#Page_three_Title').val(data[0].page_three_title);
                $('#Page_four_Title').val(data[0].page_four_title);

                SetContents(objPageOneContent,data[0].page_one_content);
                SetContents(objPageTwoContent,data[0].page_two_content);
                SetContents(objPageThreeContent,data[0].page_three_content);
                SetContents(objPageFourContent,data[0].page_four_content);

                $('#fellowship_id').val(data[0].id);

                if(data[0].image_path=="" ||data[0].image_path==undefined){
                    $('#edit_photo').text(" 新增照片");
                    $('#ShowImg').attr('src','/photo/public/sample.jpg');
                }else{
                    $('#ShowImg').attr('src',data[0].image_path);
                    $('#edit_photo').text(" 更換照片");
                    // alert(data[0].image_path);
                }
              

            }
        });
    });


    $('#edit_photo').on('click', function() {

        $('#footer_action_button').text(" 上傳");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('btn-success');

        $('.modal-title').text('上傳照片');
        // $('.second').addClass('hide');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#footer_action_button').text('上傳');
        $('#Edit_Photo_Modal').modal('show');
    });

    $('.btn-cancel').on('click', function() {

        validator.resetForm();
    });

    $('#ctlCANCEL').on('click', function() {
        $('.second').addClass('hide');
        $('.first').removeClass('hide');
        $("#ShowImg").removeAttr("src");

        ClearText(objPageOneContent);
        ClearText(objPageTwoContent);
        ClearText(objPageThreeContent);
        ClearText(objPageFourContent);

        $("#DivSecond").find(":text,textarea,input").each(function() {
            $(this).val("");
        });
    });

    $('#add').on('click',function(){

        $('.modal-title').text('新增團契');
        $('#btnSave').addClass('btn-success');
        $('#form_add').show();
        $('#AddModel').modal('show');

    });


    $(document).on('click', '.delete-modal', function() {

        var stuff = $(this).data('info').split(',');
        $('#FellowshipId').val(stuff[1]);
        //$('.dname').html($(this).data('name'));
        $('#DeleteModel').modal('show');
    });


    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/MADeleteFellowship',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#id').val()
            },
            success: function(data) {
                $('.item' + $('#id').val()).remove();
            }
        });
    });

    $('#addbtn').on('click', function() {
//        ClearText(objPage_one_Content);
//        alert($('#fellowship_id').val());
        $.ajax({
            type: 'post',
            url: '/MA_Fellowship_D_Edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'introduction_title': $('#Introduction_Title').val(),
                'introduction_content': GetContents(objIntroductionContent),
                'page_one_title': $('#Page_one_Title').val(),
                'page_two_title': $('#Page_two_Title').val(),
                'page_three_title': $('#Page_three_Title').val(),
                'page_four_title': $('#Page_four_Title').val(),
                'page_one_content': GetContents(objPageOneContent),
                'page_two_content': GetContents(objPageTwoContent),
                'page_three_content': GetContents(objPageThreeContent),
                'page_four_content': GetContents(objPageFourContent),
                'id':$('#fellowship_id').val()
                           }
            , success: function(data){
                if(data['ServerNo']=='200') {
                    $('.second').addClass('hide');
                    $('.first').removeClass('hide');
                    alert('儲存成功');
                    $("#ShowImg").removeAttr("src");
                }else if(data['ServerNo']=='404'){
                    alert(data['Result']);
                }

            },error:function(data)
            {
                alert('拍謝，程式有問題');
            }

        });

    });



    </script>
@stop