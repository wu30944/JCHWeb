<script>
$(document).ready(function() {
			
    $('#gridview').DataTable(
        {
        	@if (isset($dtControl))
	        	@foreach ($dtControl as $Item)
	        		"bAutoWidth": {{$Item->AUTO_WIDTH}} ,
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


    	 "oLanguage": {//国际语言转化
                   "oAria": {
                       "sSortAscending": " - click/return to sort ascending",
                       "sSortDescending": " - click/return to sort descending"
                   },
                   "sLengthMenu": "显示 _MENU_ 记录",
                   "sZeroRecords": "对不起，查询不到任何相关数据",
                   "sEmptyTable": "未有相关数据",
                   "sLoadingRecords": "正在加载数据-请等待...",
                   "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录。",
                   "sInfoEmpty": "当前显示0到0条，共0条记录",
                   "sInfoFiltered": "（数据库中共为 _MAX_ 条记录）",
                   "sProcessing": "<img src='../resources/user_share/row_details/select2-spinner.gif'/> 正在加载数据...",
                   "sSearch": "查詢 ：",
                   "sUrl": "",
                   //多语言配置文件，可将oLanguage的设置放在一个txt文件中，例：Javascript/datatable/dtCH.txt
                   "oPaginate": {
                       "sFirst": "首頁",
                       "sPrevious": " 上一頁 ",
                       "sNext": " 下一頁 ",
                       "sLast": " 尾頁 "
                   }
               },
 

        });
     //添加索引列
           table.on('order.dt search.dt',
                   function () {
                       table.column(0, {
                           search: 'applied',
                           order: 'applied'
                       }).nodes().each(function (cell, i) {
                           cell.innerHTML = i + 1;
                       });
                   }).draw();
} )

</script>

	<!--訂定版面上要什麼字體，定義在下方-->
  <!-- Styles -->
{{-- <style type="text/css">
	  body{
	    font-family: Microsoft JhengHei;
	  }
</style> --}}

