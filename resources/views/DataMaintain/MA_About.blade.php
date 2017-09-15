@extends('TmpView.tmp')

@section('title','關於我們')

@section('content')

    <section class='container'>

        <!-- Page Content -->
        <div class="content full">
            <div class="col-lg-12">
                    <h1 class="page-header text-center">關於建成</h1>
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
             <div class="row">
                {!! Form::open(['route'=>'MA_Update_About','id'=>'form_update']) !!}

                    <div class="col-md-8">
                        <div class="thumbnail">
                            <p>
                                {!!form::label('map','地圖:')!!}
                                {!!form::text('map',$jchinfo['MAP'],['class'=>'name','size'=>'70'])!!}
                            </p>
                        <!-- Embedded Google Map -->
                             <iframe src="{{$jchinfo['MAP']}}"  width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                         </div>
                    </div>

                    <div class="col-md-4 text-center " id="div_add" >
                            <div class="thumbnail">
                                <div class="caption" align="left">
                                    <p>
                                        {!!form::label('cname','教會中文名稱:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('cname',$jchinfo['CNAME'],['size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('ename','教會英文名稱:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('ename',$jchinfo['ENAME'],['class'=>'name','size'=>'30'])!!}
                                    </p>
                                     <p>
                                        {!!form::label('address','教會地址:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('address',$jchinfo['ADDRESS'],['class'=>'address','size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('phone','電話:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('phone',$jchinfo['PHONE'],['class'=>'phone','size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('fex','傳真:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('fex',$jchinfo['FEX'],['class'=>'name','size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('email','E-mail:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('email',$jchinfo['EMAIL'],['class'=>'name','size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::label('uniform_number','統一編號:')!!}
                                        {{-- <label for="name">姓名：</label><br> --}}
                                        {!!form::text('uniform_number',$jchinfo['UNIFORM'],['class'=>'name','size'=>'30'])!!}
                                    </p>
                                    <p>
                                        {!!form::text('id',$jchinfo['ID'],['class'=>'hide'])!!}
                                    </p>
                                    @if(Gate::forUser(auth('admin')->user())->check('admin.permission.edit'))
                                    <div align="right">
                                        <button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btn_add" >
                                            <span class='glyphicon glyphicon-check'> </span> 更新
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
        <link rel="stylesheet" href="{{ asset('css/screen.css')}}" >
        <script src="../js/jquery.datetimepicker.full.js"></script>
        <script src="../js/jquery.validate.js"></script>
        <script>

            $().ready(function() {

                    $("#form_update").validate({
                        rules: {
                            cname:{
                                required: true,
                                minlength: 8
                            },
                            ename:{
                                required: true,
                                minlength: 10
                            },
                            address:{
                                required: true,
                                minlength: 15
                            },
                            phone:{
                                required: true,
                                minlength: 8
                            },
                            fex:{
                                required: true,
                                minlength: 3
                            },
                            email: {
                                required: true,
                                email:true
                            },
                            uniform_number: {
                                required: true,
                                minlength:8
                            }
                        },
                        messages: {
                            cname: {required:"請輸入教會中文名稱",minlength:"輸入的教會名稱可能錯誤"},
                            ename: {required:"請輸入教會英文名稱",minlength:"輸入的教會名稱可能錯誤"},
                            address: {required:"請輸入教會地址",minlength:"輸入的教會地址可能錯誤"},
                            phone: {required:"請輸入教會電話",minlength:"輸入的電話數字太少"},
                            fex: {required:"請輸入傳真",minlength:"輸入的傳真號碼可能錯誤"},
                            email:{required:"請輸入E-mail",email:"輸入的E-mail格式有誤"},
                            uniform_number:{required:"請輸入教會統一編號",minlength:"輸入的統編數字太短"}

                        }
                    });
                });

            $(function () {
              // $(".alert-block").click(function () {
              //   $(".alert-block").slideToggle(200);
              //   setTimeout(function () {
              //     $(".alert-block").hide(200);
              //   }, 3000);
              // });

              setTimeout(function () {
                  $(".alert-block").hide(200);
                }, 3000);
            })
        </script>
    </section>
@stop


