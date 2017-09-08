@extends('TmpView.tmp')

@section('title','分類資料維護')

@section('content')

<section class='container'>
{{--     <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
        <link href="{{ asset('css/treeview.css')}}" rel="stylesheet">
    </head> --}}

    <head>
        {{-- <title>Laravel Category Treeview Example</title> --}}
{{--         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
        <link href="/css/treeview.css" rel="stylesheet">
    </head>
    <br>
        <div class="content full">
            <div class="panel panel-primary">
                <div class="panel-heading">管理分類樹</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                          <div class="well">
                            <h4>消息分類</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul id="tree1">
                                            @foreach($categories as $category)
                                                 <li>
                                                 <a href="">{{ $category->title }}</a>
                                                 @if(count($category->childs))
                                                     @include('category.manageChild',['childs' => $category->childs])
                                                 @endif
                                                 </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <h3>新增分類</h3>

                            {!! Form::open(['route'=>'add.category']) !!}

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

                                <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                    {!! Form::label('分類:') !!}
                                    {{-- {!!Form::select('select_kind', array('請選擇' => ['year'=>'年份', 'month'=>'月份']));!!} --}}
                                    {!! Form::select('parent_id',$ItemAll, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                </div>


                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    {!! Form::label('Title:') !!}
                                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success">新增</button>
                                </div>

                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="../js/treeview.js"></script>
</section>
@stop