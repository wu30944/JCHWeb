@extends('TmpView.tmp')

@section('title','關於我們')

@section('content')

    <section class='container'>

        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">聯絡我們
                        {{-- <small>Subheading</small> --}}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a>
                        </li>
                        <li class="active">聯絡我們</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                     <!-- /.row -->
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

{{--                 <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('group','團體：') !!}
                    {!! Form::select('group_type', ['L'=>'大','M'=>'中','S'=>'小'], 'M', ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div> --}}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('稱呼：') !!}
                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>
                 <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('電話號碼：') !!}
                    {!! Form::text('email', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>

                 <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('E-mail：') !!}
                    {!! Form::text('email', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::label('訊息：') !!}
                    {!! Form::textarea('email', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-success">新增</button>
                </div>

            {!! Form::close() !!}

                </div>
            </div>

           

            <!-- /.row -->

            <!-- /.row -->

            <!-- Contact Form -->
            <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
{{--             <div class="row">
                <div class="col-md-8">
                    <h3><label></label></h3>
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>姓名:</label>
                                <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Phone Number:</label>
                                <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Email Address:</label>
                                <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Message:</label>
                                <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

            </div>
 --}}            <!-- /.row -->

            <hr>
        </div>
    </section>
@stop


