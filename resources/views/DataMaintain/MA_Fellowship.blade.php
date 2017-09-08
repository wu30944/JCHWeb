@extends('TmpView.tmp')

@section('title','團契資料維護')

@section('content')

<section class='container'>
<style>
.table-borderless tbody tr td, .table-borderless tbody tr th,
    .table-borderless thead tr th {
    border: none;
}
</style>

<body>
    <div class="content full ">
            <div class="col-lg-12">
                    <h1 class="page-header text-center">團契資料維護</h1>
                </div>
    <div class="first">
             
            @if(Auth::check())
            <div class="form-group row add">
            <br>
                <div class="col-md-4">
                    <button class="btn btn-primary" type="submit" id="add">
                        <span class="glyphicon glyphicon-plus"></span> 新增
                    </button>
                </div>
            </div>
            @endif

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
                            @if(Auth::check())
                            <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    @foreach($dtfellowship as $item)
                    <tr class="item{{$item->id}}">
                        {{-- <td>{{$item->id}}</td> --}}
                        <td class="hidden">{{$item->id}}</td>
                        <td>{{$item->NAME}}</td>
                        @if(Auth::check())
                        <td><button class="edit-modal btn btn-info"
                                data-info="{{$item->NAME}},{{$item->id}},{{$item->PARA_1}}">
                                <span class="glyphicon glyphicon-edit"></span> 修改
                            </button>
                            <button class="delete-modal btn btn-danger"
                                data-info="{{$item->NAME}},{{$item->id}},{{$item->PARA_1}}">
                                <span class="glyphicon glyphicon-trash"></span> 刪除
                            </button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="second hide">
                     <!-- Intro Content -->
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive show-update-img"  alt="" id="ShowImg" style="max-width: 500; max-height: 290px;">

                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="edit_photo">
                            <span id="edit_photo_" class='glyphicon'></span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="id" id="fellowship_id" class="hide">
                        <input type="text" id="Introduction_Title" value="" placeholder="團契名稱">
                        <br>
                        <br>
                        <textarea id="Introduction_Content" style="width:100%;height:230px" placeholder=""></textarea>
                        {{-- <input type="text" name="Introduction_Content" value="456"> --}}
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
                            <textarea id="Page_one_Content" style="width:100%;height:200px"></textarea>                          
                        </div>
                        <div class="tab-pane fade" id="service-two">
                            {{-- <input type="text" id="Page_two_Title_" value=""> --}}
                             {{-- <br> --}}
                            <textarea id="Page_two_Content" style="width:100%;height:200px"></textarea>
                        </div>
                        <div class="tab-pane fade" id="service-three">
                            {{-- <input type="text" id="Page_three_Title_" value=""> --}}
                             {{-- <br> --}}
                            <textarea id="Page_three_Content" style="width:100%;height:200px"></textarea>
                        </div>
                        <div class="tab-pane fade" id="service-four">
                            {{-- <input type="text" id="Page_four_Title_" value=""> --}}
                            {{-- <br> --}}
                            <textarea id="Page_four_Content" style="width:100%;height:200px"></textarea>
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
                        <img class="img-responsive preview"  alt="" id="preview" src="/photo/sample.jpg">
                        <a href="#" class="btn button-change-profile-picture">

                        <label for="upload-profile-picture">
                           
                             <input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field upl" >
                        </label>
                        </a>
                        <span id="upload-avatar"></span>
                    
                    <div class="deleteContent hide" >
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>
                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="btnUpdatePhoto">
                            <span id="spUpdatePhoto" class='glyphicon'>上傳</span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> 取消
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
                'NAME':stuff[0] ,
                'PARA_1': stuff[2]       
                    },
            success: function(data){
                //alert(data.id);
                $('#Introduction_Title').val(data[0].introduction_title);
                $('#Introduction_Content').val(data[0].introduction_content);
                $('#Page_one_Title').val(data[0].page_one_title);
                $('#Page_two_Title').val(data[0].page_two_title);
                $('#Page_three_Title').val(data[0].page_three_title);
                $('#Page_four_Title').val(data[0].page_four_title);
                $('#Page_one_Title_').val(data[0].page_one_title);
                $('#Page_two_Title_').val(data[0].page_two_title);
                $('#Page_three_Title_').val(data[0].page_three_title);
                $('#Page_four_Title_').val(data[0].page_four_title);
                $('#Page_one_Content').val(data[0].page_one_content);
                $('#Page_two_Content').val(data[0].page_two_content);
                $('#Page_three_Content').val(data[0].page_three_content);
                $('#Page_four_Content').val(data[0].page_four_content);
                $('#fellowship_id').val(data[0].id);
                if(data[0].image_path==""){
                    $('#edit_photo').text(" 新增照片");
                    $('#ShowImg').attr('src','/photo/sample.jpg');
                }else{
                    $('#ShowImg').attr('src',data[0].image_path);
                    $('#edit_photo').text(" 更換照片");
                    // alert(data[0].image_path);
                }
              
                //alert(data[0].id);
            }
        });
    });

    $('#edit_photo').on('click', function() {
        // $('.second').addClass('hide');
        $('#Edit_Photo_Modal').modal('show');
    });



    $('#ctlCANCEL').on('click', function() {
        $('.second').addClass('hide');
        $('.first').removeClass('hide');
        $("#ShowImg").removeAttr("src");
    });

    $('#add').on('click',function(){
        $('.first').addClass('hide');
        $('.second').removeClass('hide');
        $('#update_action_button').text(" 新增");
        $('#update_action_button').addClass('glyphicon-check');
        $('#update_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');

    });

    $('#addbtn').on('click', function() {
        
        $.ajax({
            type: 'post',
            url: '/MA_Fellowship_D_Edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'introduction_title': $('#Introduction_Title').val(),
                'introduction_content': $('#Introduction_Content').val(),
                'page_one_title': $('#Page_one_Title').val(),
                'page_two_title': $('#Page_two_Title').val(),
                'page_three_title': $('#Page_three_Title').val(),
                'page_four_title': $('#Page_four_Title').val(),
                'page_one_content': $('#Page_one_Content').val(),
                'page_two_content': $('#Page_two_Content').val(),
                'page_three_content': $('#Page_three_Content').val(),
                'page_four_content': $('#Page_four_Content').val(),
                'id':$('#fellowship_id').val()
                           }
            , success: function(data){
                $('.second').addClass('hide');
                $('.first').removeClass('hide');
                alert('儲存成功');
                $("#ShowImg").removeAttr("src");
            }

        });
    });
</script>
</body>
</section>
@stop