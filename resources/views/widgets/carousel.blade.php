<!-- Header Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<header id="myCarousel" class="carousel slide">
<div class="content full">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<div class="fill">
					<img class="img-responsive"  alt="" id="preview" src="/photo/carousel/測試.png" >
				</div>
			<div class="carousel-caption">
				{{-- <h2>Caption 1 Test</h2> --}}
			</div>
		</div>
		<div class="item">
			<div class="fill">
					<img class="img-responsive"  alt="" id="preview" src="/photo/carousel/測試.png" >
				</div>
			<div class="carousel-caption">
				{{-- <h2>Caption 2</h2> --}}
			</div>
		</div>
		<div class="item">
			<div class="fill">
				<img class="img-responsive"  alt="" id="preview" src="/photo/carousel/測試.png" >
			</div>
			<div class="carousel-caption">
				{{-- <h2>Caption 3</h2> --}}
			</div>
		</div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"></span>
	</a> 
	<a class="right carousel-control" href="#myCarousel"
		data-slide="next"> <span class="icon-next"></span>
	</a>
	</div>
</header>