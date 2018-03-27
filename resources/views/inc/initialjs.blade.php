<script>
    //輪播
    $('.carousel').carousel({
        interval: 4000 //changes the speed
    })
	    
      $(document).ready(function() {
			
    $('#gridview').DataTable(
        {
        	@if (isset($dtControl))
	        	@foreach ($dtControl as $Item)
	        		/*"bAutoWidth": $Item->AUTO_WIDTH ,*/
	        		"bFilter": {{$Item->FILTER}} ,
	        		"bInfo": {{$Item->UNDER_INFO}} ,
	        		"bJQueryUI": {{$Item->JQUERY_UI}} ,
	        		"bLengthChange": {{$Item->LENGTH_CHANGE}} ,
	        		"bPaginate": {{$Item->PAGINATE}} ,
	        		"bProcessing": {{$Item->PROCESSING}} ,
	        		"bSort": {{$Item->SORT}} ,
	        		"bStateSave": {{$Item->STATE_SAVE}} 
	        	@endforeach  
        	@endif
        });
    } )

     $('div.alert').not('.alert-important').delay(3000).slideUp(300);

     
     $(function() {

            //alert(fellowship.length);

            // NavJson.fellowship.push()

        });
        $(window).load(function() {
            //$( "#dialog" ).dialog();
            //alert("load event!");
        });


</script>

	<!--訂定版面上要什麼字體，定義在下方-->
  <!-- Styles -->
{{-- <style type="text/css">
	  body{
	    font-family: Microsoft JhengHei;
	  }
</style> --}}

