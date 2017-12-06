@extends('admin.layouts.base')
@section('title','信息預告維護')
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
                <h1 class="page-header">@lang('function_title.MAWorshipPreview')
                    {{-- <small>Subheading</small> --}}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">@lang('default.home')</a>
                    </li>
                    <li class="active">@lang('function_title.MAWorshipPreview')</li>
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


        <div class="form-group row">
            <br>
            <div class="col-md-8">
                @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Search'))
                    <button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btn_add" onclick="Search()">
                        <span class='glyphicon glyphicon-search'> </span> @lang('default.search')
                    </button>
                @endif
                @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Create'))
                    <button class="btn btn-primary" id="add">
                        <span class="glyphicon glyphicon-plus"></span> @lang('default.add')
                    </button>
                @endif
                @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Edit'))
                    {{--<button class="btn btn-info" id="edit">--}}
                        {{--<span class="glyphicon glyphicon-pencil"></span> @lang('default.edit')--}}
                    {{--</button>--}}
                    <button type="button" class="btn btn-warning" data-dismiss="modal" disabled="disabled" id="cancel">
                        <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                    </button>
                @endif
            </div>
        </div>



        <div class="col-lg-12">
            <div class="thumbnail">

                {{-- 搜尋測試區塊 --}}
                {!! Form::open(['route'=>'WorshipPreview.Search','id'=>'form_search','method'=>'GET']) !!}
                <table class="table  site-footer" >
                    <tr>
                        <td class="col-lg-2" align="left">
                            <div style="display: inline;">
                                {!!form::label('video_type',trans('default.language').':')!!}
                            </div>
                        </td>
                        <td>
                            <div style="display: inline;">
                                @if(isset($dtLanguage))
                                    {{Form::hidden('language_type[]','0')}}
                                    @for($i=0;$i<count($dtLanguage);$i++)
{{--                                        {!! Form::checkbox('language_type[]',$dtLanguage[$i]->cod_id,(old('language_type[0]')?ture:false))!!} {{$dtLanguage[$i]->cod_val}}--}}
                                        <input type="checkbox" name="language_type[]" value="{{$dtLanguage[$i]->cod_id}}" @if(isset($arrLanguage_type))
                                                                                                                              @for($j=$i;$j<count($arrLanguage_type);$j++)
                                                                                                                                 @if($dtLanguage[$i]->cod_id == $arrLanguage_type[$j] )
                                                                                                                                     checked="ture"
                                                                                                                                 @else

                                                                                                                                 @endif
                                                                                                                              @endfor
                                                                                                                          @endif>{{$dtLanguage[$i]->cod_val}}
                                    @endfor
                                @endif
                                {{--{!! Form::select('SearchVideoType',$ItemAll,(isset($request))?$request->SearchVideoType:2, ['placeholder'=>'請選擇影片類型','style'=>'width:130px','id'=>'SearchVideoType']) !!}--}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label>@lang('default.subject'):</label>
                        </td>
                        <td>
                            {!!form::text('subject',(isset($subject))?$subject:'',['class'=>'text form-control','id'=>'SearchSubject'])!!}
                            {{-- <input type="text" class="form-control" id="SearchTheme" > --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label>@lang('default.speaker')</label>
                        </td>
                        <td>
                            {!!form::text('speaker',(isset($speaker))?$speaker:'',['class'=>'text form-control','id'=>'SearchSpeaker'])!!}
                            {{-- <input type="text" class="form-control" id="SearchSpeaker" > --}}
                        </td>

                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label >@lang('default.sdate'):</label>
                        </td>
                        <td>
                            {{-- <input type="text" class="form-control search-date-modal" id="SearchSDate" > --}}
                            {!!form::text('sdate',(isset($sdate))?$sdate:'',['class'=>'text form-control search-date-modal','id'=>'SearchSDate'])!!}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2">
                            <label >@lang('default.edate'):</label>
                        </td>
                        <td>
                            {!!form::text('edate',(isset($edate))?$edate:'',['class'=>'text form-control search-date-modal','id'=>'SearchEDate'])!!}
                            {{-- <input type="text" class="form-control search-date-modal" id="SearchEDate" > --}}
                        </td>
                    </tr>
                </table>
                {{-- </form> --}}
                {!! Form::close() !!}
                {{-- 測試區塊 --}}


                @if(count($dtWorshipPreview)===0)
                <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>@lang('message.NoData')</strong>
                </div>
                @endif

                {{ csrf_field() }}
                <div class="table-responsive text-center">
                    <table class="table table-borderless table-striped" id="gridview">
                        <thead>
                        <tr>
                            <th class="text-center">@lang('default.language')</th>
                            <th class="text-center">@lang('default.subject')</th>
                            <th class="text-center">@lang('default.speaker')</th>
                            <th class="text-center">@lang('default.date')</th>
                            {{--<th class="text-center">@lang('default.create_date')</th>--}}
                            @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Edit')
                                or Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Destory'))
                                <th class="text-center">Actions</th>
                            @endif
                        </tr>
                        </thead>
                        @if(isset($dtWorshipPreview))
                            @foreach($dtWorshipPreview as $item)
                                <tr class="item{{$item->id}}">
                                    <td align="center"><p id = "language{{$item->id}}">{{$item->cod_val}}</p></td>
                                    <td align="center"><p id = "subject{{$item->id}}">{{$item->subject}}</p></td>
                                    <td align="center"><p id = "speaker{{$item->id}}">{{$item->speaker}}</p></td>
                                    <td align="center"><p id = "date{{$item->id}}">{{$item->date}}</p></td>
                                    {{--<td><p id = "created_at{{$item->id}}">{{$item->created_at}}</p></td>--}}
                                    <td>
                                        @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Edit'))
                                            <button class="edit-modal btn btn-info"
                                                    data-info="{{$item->id}},{{$item->language_type}},{{$item->subject}},{{$item->speaker}},{{$item->date}}">
                                                <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                                            </button>
                                        @endif
                                        @if(Gate::forUser(auth('admin')->user())->check('admin.WorshipPreview.Destory'))
                                            <button class="delete-modal btn btn-danger"
                                                    data-info="{{$item->id}}">
                                                <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
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
                    <div class="alert alert-block alert-danger hide" id="FailAlter">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>
                            <span ></span>
                            {{--<input  style="background-color:   transparent;   border:   0px" readonly="true" value="@lang('message.SaveFail')" id="FailMsg">--}}
                        </strong>
                    </div>
                    <div class="alert alert-block alert-success hide" id="SuccessAlter">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>
                            <span ></span>
                            {{--<input  style="background-color:   transparent;   border:   0px" readonly="true" value="@lang('message.SaveSuccess')" id="SuccessMsg">--}}
                        </strong>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group hidden">
                            <label class="control-label col-sm-2 " for="id">id:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="language">@lang('default.language'):</label>
                            <div class="col-sm-10">
                                @if(isset($dtLanguage))
                                    @foreach($dtLanguage as $item)
                                        {!! Form::checkbox('language_type[]',$item->cod_id,false,['id'=>'language_type','disabled'=>'disabled'])!!}{{$item->cod_val}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subject">@lang('default.subject'):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subject" name="subject" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="speaker">@lang('default.speaker'):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="speaker" name="speaker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="sunday_date">@lang('default.sunday_date'):</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control date-modal" id="sunday_date">
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                    <p class="error text-center alert alert-danger hidden"></p>

                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="btnUpdate">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        <button type="button" class="btn btn-warning btn-cancel" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove '></span> @lang('default.cancel')
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
                    <h4>@lang('default.add')</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=>'WorshipPreview.Create','id'=>'form_create','files'=>false,'class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="language_type">@lang('default.language')：</label>
                        <div class="col-sm-10">
                            @if(isset($dtLanguage))
                                @foreach($dtLanguage as $item)
                                    {!! Form::checkbox('language_type[]',$item->cod_id,false)!!}{{$item->cod_val}}
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="control-label col-sm-2">@lang('default.subject')：</label>
                        <div class="col-sm-10">
                            {!!form::text('subject','',['class'=>'name form-control','type'=>'text'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="speaker" class="control-label col-sm-2">@lang('default.speaker')：</label>
                        <div class="col-sm-10">
                            {!!form::text('speaker','',['class'=>'name form-control','type'=>'text'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sunday_date" class="control-label col-sm-2">@lang('default.sunday_date')：</label>
                        <div class="col-sm-10">
                            {!!form::text('sunday_date','',['class'=>'name form-control date-modal','type'=>'text'])!!}
                        </div>
                    </div>

                    <div class="add_modal-footer" align="right">
                        <p class="error text-center alert alert-danger hidden"></p>
                        <button type="submit" class='btn btn-success' id="btnSave" >
                            <span class='glyphicon glyphicon-plus'></span>  @lang('default.add')
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

    <div id="DeleteModel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">@lang('default.delete')</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group hidden">
                            <label class="control-label col-sm-2 " for="DeleteID">id:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="DeleteID" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        @lang('message.delete_msg') <span class="dname"></span> ? <span
                                class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <p class="error text-center alert alert-danger hidden"></p>

                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span class='glyphicon glyphicon-trash'></span> @lang('default.delete')
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

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <script>

        $().ready(function() {

            $("#form_create").validate({
                rules: {
                    'language_type[]': {
                        required: true
                    },
                    subject: {
                        required: true,
                        minlength: 3
                    },
                    speaker: {
                        required: true
                    },
                    sunday_date: {
                        required: true,
                        date: true,
                        dateISO: 'YYYY-MM-DD'
                    }
                },
                    messages: {
                        'language_type[]': {
                            required: "請至少勾選一個選項",
                            maxlength: "Check no more than {0} boxes"
                        },
                        subject: "@lang('message.RequiredField')".replace('%','@lang('default.subject')'),
                        speaker: "@lang('message.RequiredField')".replace('%','@lang('default.speaker')'),
                        sunday_date: {
                            required: "@lang('message.RequiredField')".replace('%','@lang('default.sunday_date')'),
                            date: "@lang('message.DateFormat')"
                        }
                    }
            });
        });



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

        $('.search-date-modal').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        });

        $('.date-modal').datetimepicker({
            yearOffset:0,
            lang:'zh-TW',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
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

    });



    /*
        當按下新增按鈕時，會去做的事情
    */
    $(document).on('click', '.btn-primary', function() {
//        $('.error').addClass('hidden');
//        $('#add_action_button').text("新增");
//        $('#add_action_button').addClass('glyphicon-check');
//        $('#add_action_button').removeClass('glyphicon-trash');
//        $('.actionBtn').addClass('btn-success');
//        $('.actionBtn').removeClass('btn-danger');
//        $('.actionBtn').addClass('add');
//        $('.modal-title').text('新增');
//        $('.deleteContent').hide();
//        //$('.form-horizontal').show();

        $('#AddModel').modal('show');
    });

    function fillmodalData(details){

        $('#sunday_date').val(details[4]);
        $('#speaker').val(details[3]);
        $('#subject').val(details[2]);
        $('#id').val(details[0]);

        $(":checkbox[value='"+details[1]+"']").prop('checked',true);

    }

    $('.btn-cancel').click(function(){

        $.each($("input[name='language_type[]']:checked"), function(){
            $(this).prop('checked',false);
        });

        $('.form-control').val("");
    });

    $("#addbtn").click(function() {

    });



    $(document).on('click', '.delete-modal', function() {
        $('#DeleteID').val($(this).data('info'));
        $('#DeleteModel').modal('show');
    });

    $('.modal-footer').on('click', '.delete', function() {

        $.ajax({
            type: 'post',
            url: '{{route('WorshipPreview.Destory')}}',//'/admin/MAVersesDelete',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#DeleteID').val()
            },
            success: function($data) {
                $('.item' + $('#DeleteID').val()).remove();
                $('#SuccessAlter').removeClass('hide');
                $('#SuccessAlter').show();
                $('#SuccessMsg').val($data['Message']);
                $(window).scrollTop(0);
            }
        });
        setTimeout(function () {
            $(".alert-block").hide(3000);
        }, 5000);
    });

    function Search(){
        form_search.submit();
    }

    $('#btnUpdate').on('click',function(){

//        var ArrLanguageType = new Array();
//        $.each($("input[name='language_type[]']:checked"), function(){
//            ArrLanguageType.push($(this).val());
//        });
        var $id=$('#id').val();

        $.ajax({
            type: 'post',
            url: '{{route('WorshipPreview.Update')}}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $id,
                'subject': $('#subject').val(),
                'speaker':$('#speaker').val(),
                'language_type':$('#language_type').val(),
                'sunday_date':$('#sunday_date').val()
            },
            success: function($data) {


                $('#speaker'+$id).text($data['Data'].speaker);
                $('#subject'+$id).text($data['Data'].subject);
                $('#date'+$id).text($data['Data'].date);

                $('#SuccessAlter').removeClass('hide');
                $('#SuccessAlter').show();
                $('#SuccessAlter span').text($data['Message']);
                $(window).scrollTop(0);
                $('#myModal').modal('show');

                setTimeout(function () {
                    $(".alert-block").hide(200);
                    $('#myModal').modal('hide');
                }, 3000);


            },error:function(e)
            {
                var errors=e.responseJSON;

                $('#FailAlter').removeClass('hide');
                $('#FailAlter').show();
//                $('#FailMsg').val(errors.Message);
                $('#FailAlter span').text(errors.Message);
                $(window).scrollTop(0);
                $('#myModal').modal('show');
            }
        });


    });


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