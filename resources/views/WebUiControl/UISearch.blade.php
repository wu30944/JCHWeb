
 <!--搜尋控制項    Start-->
{!! Form::open(['url'=>'search']) !!} 
 <!-- Blog Search Well -->
    <div class="well">
        <h4>{{ isset($title_name) ? $title_name : '搜尋'}}</h4>
        <div class="input-group">
            {{-- <input type="text" class="form-control"> --}}
            {!! Form::text('value',null,['class'=>'form-control']) !!}
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>
{!! Form::close() !!}
 <!--搜尋控制項    End-->