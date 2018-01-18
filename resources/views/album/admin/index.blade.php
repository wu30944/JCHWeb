@extends('admin.layouts.base')
@section('title','相簿資料維護')
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
                    <h1 class="page-header">@lang('function_title.Album')
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">@lang('default.home')</a>
                        </li>
                        <li class="active">@lang('function_title.Album')</li>
                    </ol>

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
                        <th class="text-center">@lang('default.isshow')</th>
                        <th class="text-center">@lang('default.album_name')</th>
                        <th class="text-center">@lang('default.create_time')</th>
                        @if(Gate::forUser(auth('admin')->user())->check('admin.Carousel.Edit'))
                            <th class="text-center">@lang('default.action')</th>
                        @endif
                    </tr>
                    </thead>
                    @foreach($Album as $item)
                        <tr class="item{{$item->id}}">
                            <td>{{Form::radio('choice',$item->id,$item->isvisible,['id'=>'show_'.$item->id])}}</td>
                            <td align="left"><p id = "album_name{{$item->id}}">{{$item->album_name}}</p></td>
                            <td><p id = "created_at{{$item->id}}">{{$item->created_at}}</p></td>
                            <td>
                                @if(Gate::forUser(auth('admin')->user())->check('admin.Carousel.Edit'))
                                    <a href="{{route('Album.Edit',$item->album_name)}}" style="color:white">
                                        <button class="edit-modal btn btn-info"
                                            data-info="{{$item->id}}">
                                        <span class="glyphicon glyphicon-edit"></span>

                                                @lang('default.edit')

                                         </button>
                                    </a>
                                @endif
                                @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryAlbum'))
                                    <button class="delete-modal btn btn-danger"
                                            data-info="{{$item->id}}">
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

        <div id="DeleteModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('default.delete')</h4>
                    </div>
                    {!! Form::open(['route'=>'Album.DestoryAlbum','id'=>'FormDelete','class'=>'form-horizontal']) !!}

                    <div class="modal-body">
                        <div class="deleteContent" >
                            {!!form::text('DeleteAlbumID','',['class'=>'form-control hide','id'=>'DeleteAlbumID'])!!}
                            @lang('default.sure_delete') <span class="name"></span> ? <span
                                    class="hidden did"></span>
                        </div>
                        <div class="modal-footer">
                            <p class="error text-center alert alert-danger hidden"></p>

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

        <div id="AddModel" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">@lang('default.add')</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'Album.Create','id'=>'form_add','class'=>'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="AlbumName">@lang('default.album_name'):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="AlbumName" name="AlbumName">
                            </div>
                        </div>

                        <div class="add_modal-footer" align="right">
                            <p class="error text-center alert alert-danger hidden"></p>
                            <button type="submit" class='btn btn-success' id="btnSave">
                                <span class='glyphicon glyphicon-check'></span>  @lang('default.save')
                            </button>

                            <button type="button" class="btn btn-warning btn-cancel" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span>  @lang('default.cancel')
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


            //$('#myModal').modal('show');
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

            $('#AddModel').modal('show');
        });


        $(document).on('click', '.delete-modal', function() {

            var stuff = $(this).data('info');

            $('#DeleteAlbumID').val(stuff);
            $('#DeleteModel').modal('show');
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