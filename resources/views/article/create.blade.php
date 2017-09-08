@extends('TmpView.tmp')

@section('content')
<section class="container">
	<form action="{{ url('article') }}" method="post">
	<br>
	<input type="hidden" name="_token" value="{{ csrf_token()}}">
	<input type="text" name="title" class="form-control">
	<br>
	<textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
	<input type="submit" value="送出" name="" class="btn btn-primary">
</form>
</section>

@stop
