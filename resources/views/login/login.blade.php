@extends('TmpView.tmp')

@section('title','登入')

<style type="text/css">
.fail {width:200px; margin: 20px auto; color: red;}
form {font-size:16px; color:#999; font-weight: bold;}
form {width:200px; margin:20px auto; padding: 10px; border:1px dotted #ccc;}
form input[type="text"], form input[type="password"] {margin: 2px 0 20px; color:#999;}
form input[type="submit"] {width: 100%; height: 30px; color:#666; font-size:16px;}
</style>

@section('content')

<section class='container'>
    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
           
            <form action="{{ url('login') }}" name="sentMessage" id="contactForm" method="post" >
             <h3 class="text-center"><label>登入</label></h3>
             <hr>
             <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="ACCOUNT">ACCOUNT:</label>
                        <input type="text" class="form-control" name ="ACCOUNT" required data-validation-required-message="Please enter your Account.">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="PASSOWRD">PASSWORD:</label>
                        <input type="passowrd" class="form-control" name="PASSOWRD" required data-validation-required-message="Please enter your Password.">
                    </div>
                </div>
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary">登入</button>
            </form>
    <!-- /.row -->
</section>
@stop


