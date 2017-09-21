@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                 <div class="box">
                    <input class="date-modal" size="16" type="text" id="datepicker">
                </div>
            </div>
        </div>

@stop
@section('js')
        <script type="text/javascript">
            
          $('.date-modal').datetimepicker({
                yearOffset:0,  
                lang:'zh-TW',
                timepicker:false,
                format:'Y-m-d',
                formatDate:'Y-m-d'
          });

        </script>
@stop