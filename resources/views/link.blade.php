<!DOCTYPE html>
<html>
<head>
    <title>CRUD SYSTEM</title>
 
    <!-- bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- datatables css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css')}}">
 
</head>
<body>
 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
 
                <center><h1 class="page-header">CRUD System <small>DataTables</small> </h1> </center>
 
                <div class="removeMessages"></div>
 
                <button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Member
                </button>
 
                <br /> <br /> <br />
 
                <table class="table" id="manageMemberTable">                  
                    <thead>
                        <tr>
                            <th>團契</th>
                            <th>聚會時間</th>                                                   
                            <th>日</th>
                            <th>樓層</th>                                
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
 
    <!-- add modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
     <div class="modal-dialog" role="document">
     <div class="modal-content">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add Member</h4>
     </div>
     <form class="form-horizontal" action="{{ url('/add_test') }}" method="POST" id="createMemberForm">
 
     <div class="modal-body">
        <div class="messages"></div>
 
             <div class="form-group"> <!--/here teh addclass has-error will appear -->
             <label for="name" class="col-sm-2 control-label">團契</label>
             <div class="col-sm-10"> 
             <input type="text" class="form-control" id="name" name="name" placeholder="團契">
                <!-- here the text will apper -->
             </div>
             </div>
             <div class="form-group">
             <label for="address" class="col-sm-2 control-label">聚會時間</label>
             <div class="col-sm-10">
             <input type="text" class="form-control" id="address" name="address" placeholder="聚會時間">
             </div>
             </div>
             <div class="form-group">
             <label for="contact" class="col-sm-2 control-label">日</label>
             <div class="col-sm-10">
             <input type="text" class="form-control" id="contact" name="contact" placeholder="日">
             </div>
             </div>
             <div class="form-group">
             <label for="active" class="col-sm-2 control-label">樓層</label>
             <div class="col-sm-10">
             <select class="form-control" name="active" id="active">
                <option value="">~~SELECT~~</option>
                <option value="1">Activate</option>
                <option value="2">Deactivate</option>
             </select>
             </div>
             </div>                   
 
     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     <button type="submit" class="btn btn-primary">Save changes</button>
     </div>
     </form> 
     </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /add modal -->
 
    <!-- jquery plugin -->
    <script type="text/javascript" src="../js/jquery.js"></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- datatables js -->
    <script type="text/javascript" src="../js/jquery.datatables.min.js"></script>
    <!-- include custom index.js -->
    {{-- <script type="text/javascript" src="../js/index.js"></script> --}}
    @include('inc.crud')
 
</body>
</html>