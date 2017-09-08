


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="{{ asset('fullcalendar-3.2.0/fullcalendar.css') }}">
<script src="fullcalendar-3.2.0/lib/jquery.min.js"></script>
<script src="fullcalendar-3.2.0/lib/moment.min.js"></script>
<script src="fullcalendar-3.2.0/fullcalendar.js"></script>

</head>
<body>

 <div class="container"><div id='calendar'></div></div>
	
</body>

<script type="text/javascript">
	$(document).ready(function() {

    // page is now ready, initialize the calendar...

  var date = new Date();   
var d = date.getDate();   
var m = date.getMonth();   
var y = date.getFullYear();   
           
$('#calendar').fullCalendar({   
    header: {   
        left: 'prev,next today',   
        center: 'title',   
        right: 'month,agendaWeek,agendaDay'  
    },   
    editable: true,   
    weekMode: 'variable',
     monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
     monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
      dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
        dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
        today: ["今天"],
         buttonText: {
            today: '今天',
            month: '月',
            week: '周',
            day: '日'
        },
});  

});
</script>