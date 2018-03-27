@section('css')
    {{--2018/01/08  相簿資料維護--}}
    {{--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">--}}
    <!-- Generic page styles -->
    {{--<link rel="stylesheet" href="/css/fileupload/style.css">--}}
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/css/fileupload/jquery.fileupload.css">
    <link rel="stylesheet" href="/css/fileupload/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="/css/fileupload/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="/css/fileupload/jquery.fileupload-ui-noscript.css"></noscript>
    {{--2018/01/08  相簿資料維護--}}

@stop
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

                <div class="panel panel-simple marginbottom0">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">@lang('function_title.Album')
                                {{-- <small>Subheading</small> --}}
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="{{url('/')}}">@lang('default.home')</a>
                                </li>
                                <li class="active">
                                    <a href="{{route('Album.Show')}}">@lang('function_title.Album')</a>
                                </li>
                                <li>
                                    {{$AlbumName}}
                                </li>
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
                    <div class="panel-group" id="UploadPart">
                        @if(Gate::forUser(auth('admin')->user())->check('admin.Album.Upload'))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#UploadPart"
                                       href="#collapseOne">
                                        @lang('default.upload_photo')
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-heading success">
                                    <h3 class="panel-title"><i class="fa fa-picture-o"></i> 張貼照片 <span class="panel-under"></span></h3>
                                </div>
                                <form id="post-form" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
                                    <div class="panel-body">
                                        <div class="modal-body " >
                                            <div class="form-group">
                                                <label class="control-label" for="Album">@lang('default.album_name'):</label>
                                                <input type="text" class="form-control" name="AlbumName" id="AlbumName" placeholder="輸入相簿名稱" value="{{$AlbumName}}">
                                            </div>
                                        </div>
                                        <div style="margin-left: 0px;display:none" class="errorMessage" id="Post_image_em_"></div>
                                        <div class="row fileupload-buttonbar marginbottom10">
                                            <div class="col-sm-12 col-xs-14">

                                                <div class="row">
                                                    <div class="col-md-8 col-xs-12">
                                                        <span class="btn btn-success fileinput-button">
                                                            <span>
                                                                <i class="fa fa-upload"></i>@lang('default.select_photo')
                                                            </span>

                                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                            <input type="file" name="fileupload[]" multiple>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary start">
                                                            <i class="glyphicon glyphicon-upload"></i>
                                                            <span>@lang('default.all_upload')</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-16 hidden-sm hidden-xs">
                                                        或者在這裡拖放照片
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-11 col-xs-10 fileupload-progress fade">
                                                <!-- The global progress bar -->
                                                <div class="progress progress-striped active" style="margin: 0;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="bar progress-bar" style="width:0%;">
                                                    </div>
                                                </div>
                                                <!-- The extended global progress information -->
                                            </div>
                                        </div>
                                        <div class="visible-sm visible-xs text-small text-muted">
                                            如果您的設備上傳了有缺陷的圖像，請釋放RAM並逐個向上。
                                        </div>
                                        <!-- The table listing the files available for upload/download -->
                                        <div id="upload-grid">
                                            <table role="presentation" class="table table-striped table-hover table-condensed">
                                                <tbody class="files">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo">
                                        {{$AlbumName}}@lang('default.album_photo')
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))
                                    <button class="delete btn btn-danger"
                                            data-info="">
                                        <span class="glyphicon glyphicon-trash"></span> @lang('default.batch_delete')
                                    </button>
                                @endif
                                <div class="panel-body">
                                    <table id="TestTable">
                                        @if (isset($Images))
                                            @foreach($Images as $item)
                                                <div class="col-md-4 text-center" id="container_{{$item->id}}">
                                                    <div class="thumbnail">
                                                        <input type="checkbox" name="delete" value="{{$item->id}}" class="toggle">
                                                        <hr>
                                                        <img class="img-responsive img-portfolio img-hover" src="{{$item->photo_path}}" alt="" style="width:650px;height:220px;" id="action_photo_link_{{$item->id}}">
                                                        <div class="" align="left">
                                                            @lang('default.file_name')：<input class=""  type="text" id="photo_name_{{$item->id}}" value="{{$item->photo_name}}" style="border-style:none;outline:none" readonly="true" >
                                                            <input  type="text" id="AlbumId" value="{{$item->album_id}}" style="display:none" readonly="true" >
                                                            <div align="right">
                                                                @if(Gate::forUser(auth('admin')->user())->check('admin.Album.DestoryPhoto'))
                                                                    <button class="delete btn btn-danger"
                                                                            data-info="{{$item->id}}">
                                                                        <span class="glyphicon glyphicon-trash"></span> @lang('default.delete')
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        {{$Images->render()}}
                                    </div>
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
                            <div class="modal-body">
                                <div class="deleteContent" >
                                  @lang('default.sure_delete') <span class="name"></span> ? <span
                                            class="hidden did"></span>
                                </div>
                                <div class="modal-footer">
                                    <p class="error text-center alert alert-danger hidden"></p>

                                    <button type="button" class='btn  btn-danger delete-modal'>
                                        <span class='glyphicon glyphicon-trash'></span>  @lang('default.delete')
                                    </button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                                        <span class='glyphicon glyphicon-remove'></span>  取消
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a> <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
    </section>

@stop
@section('js')
        <script>
            var upload_url='{{route('Album.Upload')}}';
            var destory_url='{{route('Album.DestoryPhoto')}}';
        </script>

        <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                <strong class="error text-danger"></strong>
            </td>
            <td>
                <p class="size">Processing...</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            </td>
            <td>
                {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download ">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                {% } else { %}
                    <button class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
    </script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{asset('js/vendor/jquery.ui.widget.js')}}"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{asset('js/JqueryFileUpload/jquery.iframe-transport.js')}}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload.js')}}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-process.js')}}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-image.js')}}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-audio.js')}}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-video.js')}}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-validate.js')}}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{asset('js/JqueryFileUpload/jquery.fileupload-ui.js')}}"></script>
    <!-- The main application script -->
    <script src="{{asset('js/JqueryFileUpload/main.js')}}"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="js/JqueryFileUpload/cors/jquery.xdr-transport.js"></script>
@stop