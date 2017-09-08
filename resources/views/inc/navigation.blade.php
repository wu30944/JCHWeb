<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation
				</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<img class="navbar-img"  alt="Brand" src="../photo/church_logo.png">
			<a class="navbar-brand" href="{{route('index')}}">建成教會</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse "
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
			
				<li class="dropdown" ><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><strong>關於建成</strong> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{url('about')}}">教會資訊</a></li>
						<li><a href="{{url('our_pastor')}}">建成牧師</a></li>
						<li><a href="{{route('elder_deacon')}}">建成長執</a></li>
						<li><a href="{{url('contact')}}">建成同工</a></li>
						<li><a href="{{url('contact')}}">聯絡我們</a></li>
					</ul>
				</li>


								<li>
				<a href=" {{ route('news') }}" role="btn" ><strong>教會消息</strong></a> </li>


				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><strong>主日預告</strong><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href=" {{ url('MeetingInfo') }}">聚會資訊</a>
						</li>
						<li><a href="{{route('inc.adultsunday')}}">活動資訊</a></li>
					</ul>
				</li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><strong>團契生活</strong><b class="caret"></b></a>
					<ul class="dropdown-menu">
					@if (isset($dtfellowship))
						{{-- expr --}}
						@foreach ($dtfellowship as $fellowship)
							{{-- expr --}}
							<li>
							<a href="{{route('fellowship',$fellowship->id)}}">{{$fellowship->NAME}}</a></li>
						@endforeach
					@endif
					</ul>
				</li>

				<li class="dropdown" ><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><strong>影音專區</strong> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{route('more_video','1')}}">華語禮拜影片</a></li>
						<li><a href="{{route('more_video','2')}}">台語禮拜影片</a></li>
						<li><a href="{{route('more_video','3')}}">聖歌隊影片</a></li>
						<li><a href="{{route('more_video','4')}}">敬拜讚美影片</a></li>
					</ul>
				</li>



				<li class="dropdown" style="display:none"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown">Blog <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="blog-home-1.html">Blog Home 1</a></li>
						<li><a href="blog-home-2.html">Blog Home 2</a></li>
						<li><a href="blog-post.html">Blog Post</a></li>
					</ul>
				</li>
				<li class="dropdown" style="display:none"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown">Other Pages <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="full-width.html">Full Width Page</a></li>
						<li><a href="sidebar.html">Sidebar Page</a></li>
						<li><a href="faq.html">FAQ</a></li>
						<li><a href="404.html">404</a></li>
						<li><a href="pricing.html">Pricing Table</a></li>
					</ul></li>
				<li>
					@if(Auth::check())

						<li class="dropdown" {{-- style="display:none" --}}><a href="#" class="dropdown-toggle"
							data-toggle="dropdown">資料維護 <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<li><a href="{{route('MA_MeetingInfo')}}">聚會資訊</a></li>
							<li><a href="{{route('MA_News')}}">最新消息</a></li>
							<li><a href="{{route('MA_Fellowship')}}">團契</a></li>
							<li><a href="{{route('MA_MoreYoutube')}}">禮拜影片</a></li>
							<li><a href="{{route('MA_ActionPhoto')}}">活動照片</a></li>
							{{-- <li><a href="blog-post.html">禮拜影片</a></li> --}}
							<li><a href="{{route('MA_Category')}}">消息分類維護</a></li>
							<li><a href="{{route('MA_Staff')}}">@lang('default.jch_staff')</a></li>
							<li><a href="{{route('MA_About')}}">關於我們</a></li>
							<li><a href="{{route('MA_OurPastor')}}">我們的牧師</a></li>
							<li><a href="blog-post.html">團契生活</a></li>
							</ul>
						</li>
						{{-- {{ Auth::user()->username}} 已登入， --}}
						 <li>
	                        <a href="{{ url('/logout') }}"
	                            onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                            登出
	                        </a>

	                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	                            {{ csrf_field() }}
	                        </form>
	                    </li>
					@endif				
				</li>

			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>
