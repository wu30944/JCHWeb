@extends('admin.layouts.base')
@section('title','金句資料維護')
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


         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@lang('function_title.MAVerses')
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">@lang('default.home')</a>
                        </li>
                        <li class="active">@lang('function_title.MAVerses')</li>
                    </ol>

                </div>
        </div>
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

        {{ csrf_field() }}
        <div class="table-responsive text-center">
           <table class="table table-borderless table-striped" id="gridview">
                <thead>
                    <tr>
                        <th class="text-center">畫面顯示</th>
                        <th class="text-center">聖經內容</th>
                        <th class="text-center">章節</th>
                        <th class="text-center">建立日期</th>
                        @if(Gate::forUser(auth('admin')->user())->check('admin.Carousel.Edit'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                @foreach($dtVerses as $item)
                <tr class="item{{$item->id}}">
                    <td>{{Form::radio('choice',$item->id,$item->is_show,['id'=>'show_'.$item->id])}}</td>
                    <td align="left"><p id = "content{{$item->id}}">{{$item->content}}</p></td>
                    <td align="left"><p id = "chapter{{$item->id}}">{{$item->chapter}}</p></td>
                    <td><p id = "created_at{{$item->id}}">{{$item->created_at}}</p></td>
                    <td>
                        @if(Gate::forUser(auth('admin')->user())->check('admin.Carousel.Edit'))
                        <button class="edit-modal btn btn-info"
                            data-info="{{$item->id}},{{$item->content}},{{$item->chapter}}">
                            <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                        </button>
                        @endif
                        @if(Gate::forUser(auth('admin')->user())->check('admin.data.destory'))
                        <button class="delete-modal btn btn-danger"
                            data-info="{{$item->id}},{{$item->content}},{{$item->chapter}}">
                            <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                        </button>
                        @endif
                    </td>

                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group hidden">
                            <label class="control-label col-sm-2 " for="id">id:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Content">@lang('default.verses'):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Content" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Chapter">@lang('default.chapter'):</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="Chapter">
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>

                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="editbtn">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
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
                        <form class="form-horizontal" role="form">
                            <div class="form-group hidden">
                                <label class="control-label col-sm-2 " for="Addid">id:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Addid" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="AddContent">@lang('default.verses'):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="AddContent" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="AddChapter">@lang('default.chapter'):</label>
                                <div class="col-sm-10">
                                    <input type="text" id="AddChapter" class="form-control"/>
                                    {{--<input type="name" class="form-control" id="Addmeeting_time">--}}
                                </div>
                            </div>
                        </form>
                        <div class="deleteContent">
                            Are you Sure you want to delete <span class="dname"></span> ? <span
                                class="hidden did"></span>
                        </div>
                        <div class="add_modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                            <button type="button" class="btn actionBtn" data-dismiss="modal" id="addbtn">
                                <span id="add_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</section>
    @stop
    @section('js')
    <script src="../js/jquery.datetimepicker.full.js"></script>
    <script>
        /*
      時間
      datepicker:是否藏掉選擇日期的控制項 false,
      format:選擇時間格式'H:i',
      step:選擇時間的區間 30
*/
        $('#meeting_time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:30
        });


    $(document).on('click', '.edit-modal', function() {

        $('.error').addClass('hidden');
        $('#footer_action_button').text("更新");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('修改');
        $('.deleteContent').hide();
        $('.form-horizontal').show();

        var $content = $(this).data('info').split(',');
        fillmodalData($content);
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        //alert( $('input[name=_token]').val());
        var id=$("#id").val();
        var content=$("#Content").val();
        var chapter=$('#Chapter').val();

        var is_show=$('#show_'+id).attr('checked');

        if(typeof(is_show) != "undefined")
        {
            is_show=1;
        }else
        {
            is_show=0;
        }


        $.ajax({
            type: 'post',
            url: '{{route('Verses.Update')}}',//'/admin/MAVersesEdit',
            data: {
                '_token': $('input[name=_token]').val(),
                'id':id,
                'is_show': is_show,
                'content': content,
                'chapter': chapter
            },
            success: function(data) {
                if (data['ServerNo']=='404'){
//                    alert(data['Result']);
                    $('.error').text(data['ResultData']);
                    $('.error').removeClass('hidden');
                    $('#myModal').modal('show');
                }
                else {
                      $('#content'+id).text(data['Data'].content);
                      $('#chapter'+id).text(data['Data'].chapter);
//                    alert(data['data'].is_show);
//                    if(data['data'].is_show=='1')
//                    {
//                        $('.item' + data['data'].id).replaceWith("" +
//                            "<tr class='item" + data['data'].id + "'>" +
//                            "<td>" + "<input name='choice' type='radio' value='" + data['data'].is_show + "' id='" +data['data'].id + "' checked='true'>" + "</td>" +
//                            "<td align='left'>" + data['data'].content + "</td>" +
//                            "<td align='left'>" + data['data'].chapter + "</td>" +
//                            "<td>" + data['data'].created_at + "</td>" +
//                            "<td><button class='edit-modal btn btn-info' data-info='"+ data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                            "<span class='glyphicon glyphicon-edit'></span> 編輯</button> " +
//                            "<button class='delete-modal btn btn-danger' data-info='"+data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                            "<span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");
//                    }else{
//                        $('.item' + data['data'].id).replaceWith("" +
//                            "<tr class='item" + data['data'].id + "'>" +
//                            "<td>" + "<input name='choice' type='radio' value='" + data['data'].is_show + "' id='" +data['data'].id + "'>" + "</td>" +
//                            "<td align='left'>" + data['data'].content + "</td>" +
//                            "<td align='left'>" + data['data'].chapter + "</td>" +
//                            "<td>" + data['data'].created_at + "</td>" +
//                            "<td><button class='edit-modal btn btn-info' data-info='"+ data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                            "<span class='glyphicon glyphicon-edit'></span> 編輯</button> " +
//                            "<button class='delete-modal btn btn-danger' data-info='"+data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                            "<span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");
//                    }

                }
            },error:function(e)
            {
                var errors=e.responseJSON;
                alert(errors.Message);
            }
        });
    });


    $('input[type="radio"]').on('click',function(){
        var UpdateID = $(this).val();
        var CurrentID='';
        $('input[type="radio"]').each(function(){
            if(typeof($(this).attr('checked'))!='undefined')
            {
                CurrentID=$(this).val();
            }
           $(this).not($('#show_'+UpdateID)).attr('checked',false);
        });
        $('#show_'+UpdateID).attr('checked',true);

        $.ajax({
            type: 'post',
            url: '{{route('Verses.IsShow')}}',//'/admin/MAVersesShow',
            data: {
                '_token': $('input[name=_token]').val(),
                'is_show': UpdateID,
                'no_show': CurrentID
            },
            success: function(data) {

            },error:function(e)
            {
                var errors=e.responseJSON;
                alert(errors.msg);
                location.reload();
            }
        });
    });

    /*
        當按下新增按鈕時，會去做的事情
    */
    $(document).on('click', '.btn-primary', function() {
        $('.error').addClass('hidden');
        $('#add_action_button').text("新增");
        $('#add_action_button').addClass('glyphicon-check');
        $('#add_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('新增');
        $('.deleteContent').hide();
        //$('.form-horizontal').show();

        $('#Content').val('');
        $('#Chapter').val('');

        $('#AddModel').modal('show');
    });

    function fillmodalData(details){

        $('#Chapter').val(details[2]);
        $('#Content').val(details[1]);
        $('#id').val(details[0]);

    }

    $("#addbtn").click(function() {
        // alert('test');
        $.ajax({
            type: 'post',
            url: '{{route('Verses.Create')}}',
            data: {
                 '_token': $('input[name=_token]').val(),
                'content': $("#AddContent").val(),
                'chapter': $('#AddChapter').val()
            },
            success: function(data) {
                if (data['ServerNo']=='404'){
                    $('.error').text(data['ResultData']);
                    $('.error').removeClass('hidden');
                    $('#AddModel').modal('show');
                }
                else {
                    alert(data['ResultData']);
                    location.reload();
                    //$('.error').addClass('hidden');
//                      location.reload();
//                    $('#table').append(
//                        "<tr class='item" + data['data'].id + "'>" +
//                        "<td>" + "<input name='choice' type='radio' value='" + data['data'].is_show + "' id='" +data['data'].id + "'>" + "</td>" +
//                        "<td align='left'>" + data['data'].content + "</td>" +
//                        "<td align='left'>" + data['data'].chapter + "</td>" +
//                        "<td>" + data['data'].created_at + "</td>" +
//                        "<td><button class='edit-modal btn btn-info' data-info='"+ data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                        "<span class='glyphicon glyphicon-edit'></span> 修改</button> " +
//                        "<button class='delete-modal btn btn-danger' data-info='"+data['data'].id+","+data['data'].content+","+data['data'].chapter+"' data-id='" + data['data'].id + "' data-name='" + data['data'].content + "'>" +
//                        "<span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>"
//                        );
                }
            },error:function(e){
                var errors = e.responseJSON;
            }

        });

    });



    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" 刪除");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('刪除');
        var stuff = $(this).data('info').split(',');
        // alert(stuff);
        fillmodalData(stuff) ;
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        //$('.dname').html($(this).data('name'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '{{route('Verses.Destory')}}',//'/admin/MAVersesDelete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#id').val()
            },
            success: function(data) {
                $('.item' + $('#id').val()).remove();
            }
        });
    });
</script>
@stop