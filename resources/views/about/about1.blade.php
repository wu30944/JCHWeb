@extends('TmpView.tmp')

@section('title','關於我們')

@section('content')

<section class='container'>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">關於我們
                    {{-- <small>Subheading</small> --}}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
        <i class="icon-search icon-white">123</i>
            <!-- Map Column -->
            <div class="col-md-8">
                <!-- Embedded Google Map -->
   <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1807.228812782555!2d121.51763905898459!3d25.0524740633006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3442a9695326e913%3A0xf29e7a188a747283!2z5Lit5bGxIDEwM-WPsOWMl-W4guWkp-WQjOWNgA!3m2!1d25.0529451!2d121.5203157!4m5!1s0x3442a96c13549c9d%3A0xd82620e3eacb830f!2zMTAz5Y-w5YyX5biC5aSn5ZCM5Y2A5om_5b636Lev5LiA5q61Nzflt7cyOeiZn-iZn-W7uuaIkOWfuuedo-mVt-iAgeaVmeacgw!3m2!1d25.05211!2d121.518452!5e0!3m2!1szh-TW!2stw!4v1487992864680" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                {{-- <iframe width="100%" height="400px" frameborder="0" scrolling="no" 
                marginheight="0" marginwidth="0" 
                src="http://maps.google.com/maps?hl=zh-TW&amp;ie=UTF8&amp;ll=25.0521101,121.5183149,&amp;spn=25.0521101,121.5183149,&amp;t=m&amp;z=4&amp;output=embed"></iframe> --}}
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3>{{$JCH_INFO['CNAME']}}</h3>
                <p>地址：{{$JCH_INFO['ADDRESS']}}
                </p>
                <p><i class="icon-home"></i> 
                   電話:{{$JCH_INFO['PHONE']}} </p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E-mail</abbr>: <a href="mailto:name@example.com">{{$JCH_INFO['EMAIL']}}</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h3>與我們聯絡</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
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
        <!-- /.row -->

        <hr>
    </div>

@stop


