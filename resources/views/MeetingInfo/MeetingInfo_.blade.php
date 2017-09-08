@extends('TmpView.tmp')

@section('title','聚會時間')

@section('content')

<section class='container'>
<style>
.table-borderless tbody tr td, .table-borderless tbody tr th,
    .table-borderless thead tr th {
    border: none;
}
</style>

<body>
    <div class="container ">


         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">聚會資訊
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">首頁</a>
                        </li>
                        <li class="active">聚會資訊</li>
                    </ol>

                </div>
        </div>
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
            <table class="table table-borderless table-striped" id="gridview" width="50%">
                {{-- <table id="gridview" class="text-center table-striped" cellspacing="0" width="70%"> --}}
                <thead>
                    <tr>
                        {{-- <th class="text-center">#</th> --}}
                        <th class="hidden"></th>
                        <th class="text-center">團契名稱</th>
                        <th class="text-center">聚會時間</th>
                        <th class="text-center">星期</th>
                        <th class="text-center">樓層</th>
                        @if(Auth::check())
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                @foreach($dtMeetingInfo as $item)
                <tr class="item{{$item->id}}">
                    {{-- <td>{{$item->id}}</td> --}}
                    <td class="hidden">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->meeting_time}}</td>
                    <td>{{$item->day}}</td>
                    <td>{{$item->floor}}</td>
                    @if(Auth::check())
                    <td><button class="edit-modal btn btn-info"
                            data-info="{{$item->name}},{{$item->meeting_time}},{{$item->day}},{{$item->floor}},{{$item->id}}">
                            <span class="glyphicon glyphicon-edit"></span> 修改
                        </button>
                        <button class="delete-modal btn btn-danger"
                            data-info="{{$item->name}},{{$item->meeting_time}},{{$item->day}},{{$item->floor}},{{$item->id}}">
                            <span class="glyphicon glyphicon-trash"></span> 刪除
                        </button></td>
                    @endif
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
                            <label class="control-label col-sm-2" for="fellowship_name">團契名稱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fellowship_name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="meeting_time">聚會時間:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="meeting_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="day">星期:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="day">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="floor">樓層:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="floor">
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
                            <span class='glyphicon glyphicon-remove'></span> 取消
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
                                <label class="control-label col-sm-2" for="Addfellowship_name">團契名稱:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Addfellowship_name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Addmeeting_time">聚會時間:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="Addmeeting_time">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Addday">星期:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="Addday">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Addfloor">樓層:</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" id="Addfloor">
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
                                <span class='glyphicon glyphicon-remove'></span> 取消
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <script>

    function fillmodalData(details){

        $('#fellowship_name').val(details[0]);
        $('#meeting_time').val(details[1]);
        $('#day').val(details[2]);
        $('#floor').val(details[3]);
        $('#id').val(details[4]);
    }

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" 更新");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('修改');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        // $('#fellowship_name').val($(this).data('id'));
        // $('#meeting_time').val($(this).data('name'));
        // $('#day').val($(this).data('name'));
        // $('#floor').val($(this).data('name'));
        var stuff = $(this).data('info').split(',');
        // alert(stuff);
        fillmodalData(stuff);
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/meeting_edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'id':$("#id").val(),
                'fellowship_name': $("#fellowship_name").val(),
                'meeting_time': $('#meeting_time').val(),
                'day': $('#day').val(),
                'floor': $('#floor').val()
            },
            success: function(data) {
             if ((data.errors)){
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors);
                    $('#myModal').modal('show');
                }
                else {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='hidden'>" + data.id + "</td><td>" + data.name + "</td><td>" + data.meeting_time + "</td><td>" + data.day + "</td><td>" + data.floor + "</td><td><button class='edit-modal btn btn-info' data-info='"+ data.name+","+data.meeting_time+","+data.day+","+data.floor+","+ data.id+"' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> 修改</button> <button class='delete-modal btn btn-danger' data-info='"+data.name+","+data.meeting_time+","+data.day+","+data.floor+","+ data.id+"' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");
                }
            }
        });
    });



    /*
        當按下新增按鈕時，會去做的事情
    */
    $(document).on('click', '.btn-primary', function() {
        $('#add_action_button').text("新增");
        $('#add_action_button').addClass('glyphicon-check');
        $('#add_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('新增');
        $('.deleteContent').hide();
        //$('.form-horizontal').show();

        $('#fellowship_name').val('');
        $('#meeting_time').val('');
        $('#day').val('');
        $('#floor').val('');

        $('#AddModel').modal('show');
    });

    $("#addbtn").click(function() {
        // alert('test');
        $.ajax({
            type: 'post',
            url: '/AddItem',
            data: {
                 '_token': $('input[name=_token]').val(),
                'fellowship_name': $("#Addfellowship_name").val(),
                'meeting_time': $('#Addmeeting_time').val(),
                'day': $('#Addday').val(),
                'floor': $('#Addfloor').val()
            },
            success: function(data) {
                if ((data.errors)){
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors);
                }
                else {
                    $('.error').addClass('hidden');
                    $('#table').append("<tr class='item" + data.id + "'><td class='hidden'>" + data.id + "</td><td>" + data.name + "</td><td>" + data.meeting_time + "</td><td>" + data.day + "</td><td>" + data.floor + "</td><td><button class='edit-modal btn btn-info' data-info='"+ data.name+","+data.meeting_time+","+data.day+","+data.floor+","+ data.id+"' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> 修改</button> <button class='delete-modal btn btn-danger' data-info='"+data.name+","+data.meeting_time+","+data.day+","+data.floor+","+ data.id+"' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> 刪除</button></td></tr>");
                }
            },

        });
        $('#name').val('');
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
            url: '/DeleteItem',
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
</body>
</section>@stop