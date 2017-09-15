	@include('inc.public')
<body>
	<!-- navigation為導覽 -->
	@include('inc.navigation')

	@include('inc.loading')
	<!-- content就是我們點選後，要顯示的內容 -->
	@yield('content') 

	@include('inc.footer')
</body>


