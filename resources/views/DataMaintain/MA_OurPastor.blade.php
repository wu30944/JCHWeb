@extends('admin.layouts.base')
@section('title','職務介紹資料維護')
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
<div class="content full">
     <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">@lang('function_title.MAStaffIntroduction')
                {{-- <small>Subheading</small> --}}
            </h1>
            <div class="lgray-bg ">
                <div class="container:after">
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">@lang('default.home')</a>
                        </li>
                        <li class="active">@lang('function_title.MAStaffIntroduction')</li>
                    </ol>
                </div>    
            </div>
        </div>
    </div>
    {{--此處在畫面顯示成功訊息--}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="first">
         @if(isset($dtPastor) && count($dtPastor)>0)
            <div class="table-responsive text-center">
                <table class="table table-borderless table-striped" id="gridview" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('default.name')</th>
                            @if(Gate::forUser(auth('admin')->user())->check('admin.StaffD.Edit'))
                                <th class="text-center">@lang('default.action')</th>
                            @endif
                        </tr>
                    </thead>

                    @foreach($dtPastor as $item)
                    <tr class="item_{{$item->id}}">
                        <td align="center">{{$item->name}}</td>
                        <td align="center">
                            @if(Gate::forUser(auth('admin')->user())->check('admin.StaffD.Edit'))
                            <button class="edit-modal btn btn-info"
                                data-info="{{$item->name}},{{$item->id}}" id="test">
                                <span class="glyphicon glyphicon-edit"></span> @lang('default.edit')
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
          @else
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>@lang('message.E0001')</strong>
            </div>
          @endif

    </div>

    <div class="row">
        {!! Form::open(['route'=>'StaffD.Update','id'=>'form_edit','class'=>'hide']) !!}
            <div class="thumbnail">
                <div class="caption" align="left">
                    <textarea cols="100" id="editor1" name="editor1" rows="10"></textarea>
                   {!!form::text('staffd_id','',['id'=>'staffd_id','class'=>'hide'])!!}
                </div>
                 <div align="right">                                
                        <button type="submit" class="add-modal btn btn-success submit"  data-dismiss="modal" id="btn_add" onclick="">
                            <span class='glyphicon glyphicon-check'> </span> @lang('default.save')
                        </button>   
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="ctlCANCEL">
                        <span class='glyphicon glyphicon-remove'></span> @lang('default.cancel')
                    </button>

                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div> 
</body>
</section>
@stop
@section('js') 
<script src="../ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor_api.js"></script>
<script src="../js/history.js"></script>

       <script>
            // Replace the <textarea id="editor1"> with an CKEditor instance.
            var objEditor1=CKEDITOR.replace( 'editor1', {
                on: {
                    focus: onFocus,
                    blur: onBlur,

                    // Check for availability of corresponding plugins.
                    pluginsLoaded: function( evt ) {
                        var doc = CKEDITOR.document, ed = evt.editor;
                        if ( !ed.getCommand( 'bold' ) )
                            doc.getById( 'exec-bold' ).hide();
                        if ( !ed.getCommand( 'link' ) )
                            doc.getById( 'exec-link' ).hide();
                    }
                }
            });

          $(document).on('click', '.edit-modal', function() {
           var stuff = $(this).data('info').split(',');
            $('.first').addClass('hide');
            $('#form_edit').removeClass('hide');

             $.ajax({
                    type: 'post',
                    url: '{{route('StaffD.Edit')}}',//''/admin/MA_OurPastor_D',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'name':stuff[0],
                        'id':stuff[1]
                            },
                    success: function(data){


                        if(data['ServerNo']=="200"){
                            // alert(data['data'].content);
                           // $('#editor1').val(data['data']);
                           InsertHTML(objEditor1,data['data'].content);
                           $('#staffd_id').val(data['data'].id);
                        }else{
                            
                        }

                        //alert(data[0].id);
                    }
                });
         });

          $(function(){
    
                var History = window.History;
                
                if (History.enabled) {

                    var page = get_url_value('page');
                    var path = page ? page : 'home';
                    // Load the page
                    load_page_content(path);


                } else {
                    return false;
                }

                // Content update and back/forward button handler
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState(); 
                    // Do ajax
                    load_page_content(State.data.path);
                    // Log the history object to your browser's console
                    History.log(State);
                });

                // // Navigation link handler
                // $('body').on('click', 'tr td button', function(e) {

                //     e.preventDefault();
                    
                //     var urlPath = $(this).attr('href');
                //     var title = $(this).text(); 
                    
                //     History.pushState({path: urlPath}, title, './?page=' + urlPath); // When we do this, History.Adapter will also execute its contents.       
                // });
                // Navigation link handler
                $('#ctlCANCEL').on('click', function(e) {
                    $('.first').removeClass('hide');
                    $('#form_edit').addClass('hide');
                    $('#form_edit').val("");

                    e.preventDefault();
                    
                    var urlPath = $(this).attr('href');
                    var title = $(this).text(); 

                    ClearText(objEditor1);

                    History.pushState({path: urlPath}, title, './?page=' + urlPath); // When we do this, History.Adapter will also execute its contents.      
                });
                
                function load_page_content(page) {
                    // $.ajax({  
                    //     type: 'post',
                    //     url: '/MA_OurPastor',
                    //     data: {},                       
                    //     success: function(response) {
                    //         alert('success');
                    //         // $('.content').html(response);
                    //     }
                    // });
                }
                
                function get_url_value(variable) {
                   var query = window.location.search.substring(1);
                   var vars = query.split("&");
                   for (var i=0;i<vars.length;i++) {
                           var pair = vars[i].split("=");
                           if(pair[0] == variable){return pair[1];}
                   }
                   return(false);
                }
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