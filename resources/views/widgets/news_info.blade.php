                <div class="panel panel-info">                    
                    <div class="panel-body">

                        <a href="{{ route('news') }}" class="pull-right basic-link">查看全部
                        {{-- <i class="fa fa-angle-right::before"></i> --}}
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                        <h3><i class="fa fa-fw fa-gift"></i> 教會消息</h3>
                        <hr class="sm">
                        @if(count($WidgetNews)>0)
                            @foreach($WidgetNews as $item)
                             <div class="events-listing-content smaller-cont">
                                <div class="event-list-item event-dynamic::before">

                                    <div class="event-list-item-date">
                                        <span class="event-date">
                                            <span class="event-day">{{$item->day}}</span>
                                            <span class="event-month">{{$item->month}} {{$item->tag}}, {{$item->year}}</span>
                                        </span>
                                    </div>
                                    <div class="event-list-item-info::after">
                                        <div class="lined-info">
                                            <h3>
                                                <a href="{{route('news_d',$item->id)}}">{{$item->title}}
                                                <p>
                                                <small>
                                                    {{mb_substr(strip_tags ($item->content),0,20,"utf-8")}}...
                                                </small>
                                                </p>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif

                    </div>
                </div>