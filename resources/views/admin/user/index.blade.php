@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')

    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
            @if(Gate::forUser(auth('admin')->user())->check('admin.user.create'))
                <a href="/admin/user/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> @lang('default.add_user')
                </a>
            @endif
        </div>
    </div>
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                @include('admin.partials.errors')
                @include('admin.partials.success')
                <div class="box-body">
                    <table id="tags-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th data-sortable="false" class="hidden-sm"></th>
                            <th class="hidden-sm">@lang('default.user_name')</th>
                            <th class="hidden-sm">@lang('default.email')</th>
                            <th class="hidden-md">@lang('default.create_date')</th>
                            <th class="hidden-md">@lang('default.modify_date')</th>
                            <th data-sortable="false">@lang('default.option')</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        確定要刪除這個用戶嗎?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/user">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>確認
                        </button>
                    </form>
                </div>

            </div>
            @stop

            @section('js')
                <script>
                    $(function () {
                        var table = $("#tags-table").DataTable({
                            language: {
                                "sProcessing": "處理中...",
                                "sLengthMenu": "顯示 _MENU_ 項结果",
                                "sZeroRecords": "沒有符合的結果",
                                "sInfo": "顯示第 _START_ 至 _END_ 項结果，共 _TOTAL_ 項",
                                "sInfoEmpty": "顯示第 0 至 0 項结果，共 0 項",
                                "sInfoFiltered": "(由 _MAX_ 項過濾結果)",
                                "sInfoPostFix": "",
                                "sSearch": "搜尋:",
                                "sUrl": "",
                                "sEmptyTable": "表終資料為空",
                                "sLoadingRecords": "載入中...",
                                "sInfoThousands": ",",
                                "oPaginate": {
                                    "sFirst": "首頁",
                                    "sPrevious": "上頁",
                                    "sNext": "下頁",
                                    "sLast": "末頁"
                                },
                                "oAria": {
                                    "sSortAscending": ": 由小到大排序",
                                    "sSortDescending": ": 由大到小排序"
                                }
                            },
                            order: [[1, "desc"]],
                            serverSide: true,
                            ajax: {
                                url: '/admin/user/index',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            },
                            "columns": [
                                {"data": "id"},
                                {"data": "name"},
                                {"data": "email"},
                                {"data": "created_at"},
                                {"data": "updated_at"},
                                {"data": "action"}
                            ],
                            columnDefs: [
                                {
                                    'targets': -1, "render": function (data, type, row) {
                                    var row_edit = {{Gate::forUser(auth('admin')->user())->check('admin.user.edit') ? 1 : 0}};
                                    var row_delete = {{Gate::forUser(auth('admin')->user())->check('admin.user.destroy') ? 1 :0}};
                                    var str = '';

                                    //编辑
                                    if (row_edit) {
                                        str += '<a style="margin:3px;" href="/admin/user/' + row['id'] + '/edit" class="X-Small btn-xs text-success "><i class="fa fa-edit"></i> 编辑</a>';
                                    }

                                    //删除
                                    if (row_delete) {
                                        str += '<a style="margin:3px;" href="#" attr="' + row['id'] + '" class="delBtn X-Small btn-xs text-danger"><i class="fa fa-times-circle"></i> 删除</a>';
                                    }

                                    return str;
                                }
                                }
                            ]
                        });

                        table.on('preXhr.dt', function () {
                            loadShow();
                        });

                        table.on('draw.dt', function () {
                            loadFadeOut();
                        });

                        table.on('order.dt search.dt', function () {
                            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                cell.innerHTML = i + 1;
                            });
                        }).draw();

                        $("table").delegate('.delBtn', 'click', function () {
                            var id = $(this).attr('attr');
                            $('.deleteForm').attr('action', '/admin/user/' + id);
                            $("#modal-delete").modal();
                        });

                    });
                </script>
@stop