<div class="panel panel-info">
    <div class="panel-body">
        <a href="{{ route('album.Index') }}" class="pull-right basic-link">查看全部
            {{-- <i class="fa fa-angle-right::before"></i> --}}
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
        <h3><i class="fa fa-fw fa-gift"></i> 活動照片</h3>
        <hr class="sm">

        <div id="myTabContent" class="tab-content col-md-12">
            @if(isset($objAlbumSet))
                @foreach($objAlbumSet as $dtAlbum)
                    @if(count($dtAlbum)>0)
                        <div class="col-md-4 text-center" >
                            <div class="thumbnail">
                                <div class="caption" align="center">
                                    <p>
                                    <div align="center" class="SlideShow">
                                        @foreach($dtAlbum as $item)
                                             <img class="img-responsive  img-portfolio img-hover"  alt="" src="{{$item->photo_path}}" style="width: 250px; height: 250px;">
                                        @endforeach
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
