@extends('admin.layouts.base')
@section('title','關於建成')
@section('pageDesc','DashBoard')
@section('content')

    <section class='container box'>

        <!-- Page Content -->
        <div class="content full">

            <!-- Team Members -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">@lang('function_title.JCHAbout')</h1>
                </div>
            </div>

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
            @if(Gate::forUser(auth('admin')->user())->check('admin.JCHAbout.Edit'))
                <button class="btn btn-info" id="btnEdit">
                    <span class="glyphicon glyphicon-pencil"></span> @lang('default.edit')
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" disabled="disabled" id="btnCancel">
                    <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                </button>
            @endif
             <div class="row">
                {!! Form::open(['route'=>'JCHAbout.Update','id'=>'form_update']) !!}

                    <div class="col-md-8">
                        <div class="thumbnail">
                            <p>
                                {!!form::label('map','地圖網址:')!!}
                                {!!form::text('map',$jchinfo['MAP'],['class'=>'name form-control','size'=>'70','disabled'])!!}
                            </p>
                        <!-- Embedded Google Map -->
                             <iframe src="{{$jchinfo['MAP']}}"  width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                         </div>
                    </div>

                    <div class="col-md-4 text-center " id="div_add" >
                            <div class="thumbnail">
                                <div class="caption" align="left">
                                    <p>
                                        {!!form::label('cname',trans('default.church_zh_name'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('cname',$jchinfo['CNAME'],['size'=>'30','class'=>'form-control','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('ename',trans('default.church_en_name'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('ename',$jchinfo['ENAME'],['class'=>'name form-control','size'=>'30','disabled'])!!}
                                    </p>
                                     <p>
                                        {!!form::label('address',trans('default.address'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('address',$jchinfo['ADDRESS'],['class'=>'address form-control','size'=>'30','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('phone',trans('default.phone'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('phone',$jchinfo['PHONE'],['class'=>'phone form-control','size'=>'30','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('fex',trans('default.fax'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('fex',$jchinfo['FEX'],['class'=>'name form-control','size'=>'30','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('email',trans('default.email'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('email',$jchinfo['EMAIL'],['class'=>'name form-control','size'=>'30','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('uniform_number',trans('default.uniform_number'))!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('uniform_number',$jchinfo['UNIFORM'],['class'=>'name form-control','size'=>'30','disabled'])!!}
                                    </p>
                                    <p>
                                        {!!form::text('id',$jchinfo['ID'],['class'=>'hide'])!!}
                                    </p>
                                   @if(Gate::forUser(auth('admin')->user())->check('admin.JCHAbout.Update'))
                                    <div align="right">
                                        <button type="submit" class="add-modal btn btn-success submit hide"  data-dismiss="modal" id="btnUpdate" >
                                            <span class='glyphicon glyphicon-check'> </span> @lang('default.update')
                                        </button>
                                        {{-- <input class="submit" type="submit" value="加入"/> --}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                    </div>
                {{-- </form> --}}
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop
@section('js')
        <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
        <script src="../js/jquery.datetimepicker.full.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <script>

            $(document).ready(function() {

                $("#form_update").validate({
                    rules: {
                        cname: {
                            required: true,
                            minlength: 8
                        },
                        ename: {
                            required: true,
                            minlength: 10
                        },
                        address: {
                            required: true,
                            minlength: 15
                        },
                        phone: {
                            required: true,
                            minlength: 8
                        },
                        fex: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        uniform_number: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        cname: {required: "請輸入教會中文名稱", minlength: "輸入的教會名稱可能錯誤"},
                        ename: {required: "請輸入教會英文名稱", minlength: "輸入的教會名稱可能錯誤"},
                        address: {required: "請輸入教會地址", minlength: "輸入的教會地址可能錯誤"},
                        phone: {required: "請輸入教會電話", minlength: "輸入的電話數字太少"},
                        fex: {required: "請輸入傳真", minlength: "輸入的傳真號碼可能錯誤"},
                        email: {required: "請輸入E-mail", email: "輸入的E-mail格式有誤"},
                        uniform_number: {required: "請輸入教會統一編號", minlength: "輸入的統編數字太短"}

                    }
                });
            });

            /*
            * 按下編輯後
            * */
            $('#btnEdit').on('click',function()
            {
                $('.form-control').removeAttr('disabled');
                $('#btnEdit').attr('disabled','true');
                $('#btnCancel').removeAttr("disabled");
                $('#btnUpdate').removeClass('hide');
            });

            /*
            * 按下取消後
            * */
            $('#btnCancel').on('click',function()
            {
                $('#btnCancel').removeAttr('disabled');
                $('.form-control').attr('disabled','true');
                $('#btnEdit').removeAttr('disabled');
                $('#btnUpdate').addClass('hide');

            });



            $(function () {
                $(".alert-block").click(function () {
                    $(".alert-block").slideToggle(200);
                    setTimeout(function () {
                        $(".alert-block").hide(200);
                    }, 3000);
                });

                // setTimeout(function () {
                //     $(".alert-test").hide(200);
                //   }, 3000);
            });

        </script>
@stop


