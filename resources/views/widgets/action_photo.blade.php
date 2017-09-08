        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">活動照片</h2>
            </div>
             @if (isset($photo_link))
                {{-- expr --}}
                @foreach($photo_link->chunk(3) as $item)
                    <div class="row" >
                    @foreach ($item as $link)
                        <div class="col-xs-6 col-sm-4" align="center">
                            <a href="{{$link->photo_link}}">
                                <img class="img-responsive img-portfolio img-hover" src="{{$link->photo_link}}" alt="" style="height:220">
                            </a>
                        </div>
                    @endforeach
                    </div><!-- end row -->
                @endforeach
            @endif
{{--             <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://scontent.ftpe1-2.fna.fbcdn.net/v/t31.0-8/19221529_10212020778490764_3118883228326342688_o.jpg?oh=2d9e0ee3f1ec4bd6a0d702f425e4d6e7&oe=59CDF92D" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://scontent.ftpe1-2.fna.fbcdn.net/v/t31.0-8/19221882_10212020778450763_6213656274434331250_o.jpg?oh=77d900259fca13f9599f4e99c89d02ba&oe=59D15910" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="https://scontent.ftpe1-2.fna.fbcdn.net/v/t1.0-9/18765639_10206776374247538_727435249959036302_n.jpg?oh=612b6d1d0feb7c0f43bd5fe2fa660cbb&oe=59D307EC" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
                </a>
            </div> --}}
        </div>

        <!-- /.row -->