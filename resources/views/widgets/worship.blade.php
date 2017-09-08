            <div class="col-md-8">
                <div class="panel panel-info">
{{--                     <div class="panel-heading">
                        <h3><i class="fa fa-fw fa-check"></i> 華語禮拜</h3>
                    </div> --}}
                    <div class="panel-body">
                    <a href="{{ route('more_youtube') }}" class="pull-right basic-link">@lang('default.more')
                        {{-- <i class="fa fa-angle-right::before"></i> --}}
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>

                     <h3><i class="fa fa-fw fa-check"></i> @lang('default.chinese_worship')</h3>
                     <hr class="sm">
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe class="embed-responsive-item" src="{{$NewVideo->link}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="latest-sermon-content">
                            <p>
                                <h3>@lang('default.subject'): {{$NewVideo->theme}}</h3>
                            </p>
                            <p>
                                <small>@lang('default.speaker'): {{$NewVideo->name}}</small>
                                                        
                            </p>
                        </div>
                        
                       {{--  <labal><a href="{{route('more_youtube')}}" class="btn btn-default pull-right">更多</a> </labal> --}}
                    </div>
                </div>
            </div>