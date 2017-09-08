        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" /> --}}
        <link href="{{ asset('css/treeview.css')}}" rel="stylesheet">

    <body>
{{--         <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">Manage Category TreeView</div>
                <div class="panel-body">
                    <div class="row"> --}}
              <div class="well">
                <h4>消息分類 Widget</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul id="tree1">
                                @foreach($categories as $category)
                                     <li>
                                     <a href="">{{ $category->title }}</a>
                                     @if(count($category->childs))
                                         @include('category.manageChild',['childs' => $category->childs])
                                     @endif
                                     </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr color="#FF0000">
              </div>
{{--                         <div class="col-md-6">
                            <h3>Add New Category</h3>

                            {!! Form::open(['route'=>'add.category']) !!}

                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    {!! Form::label('Title:') !!}
                                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>

                                <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                    {!! Form::label('Category:') !!}
                                    {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success">Add New</button>
                                </div>

                            {!! Form::close() !!}

                        </div> --}}
{{--                     </div>

                </div>
            </div>
        </div> --}}
        <script src="../js/treeview.js"></script>
        <script >
             /*
                當按下修改按鈕時
            */
            $(document).on('click', '.edit-modal', function() {
               var stuff = $(this).data('info').split(',');
                $('.first').addClass('hide');
                $('.second').removeClass('hide');
                $('#update_action_button').text(" 更新");
                $('#update_action_button').addClass('glyphicon-check');
                $('#update_action_button').removeClass('glyphicon-trash');
                $('.actionBtn').addClass('btn-success');
                $('.actionBtn').removeClass('btn-danger');
                $('.actionBtn').addClass('edit');
                // alert(stuff[1]);
                $.ajax({
                    type: 'post',
                    url: '/MA_News_Edit',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id':stuff[0],
                        'title':stuff[1] ,
                        'action_date':stuff[2] ,
                        'content': stuff[3]       
                            },
                    success: function(data){
                        // alert(data[1].title);
                        $('#news_title').val(data.title);
                        $('#datepicker').val(data.action_date);
                        $('#news_content').val(data.content);
                        $('#timepicker').val(data.action_time);
                        $('#action_postion').val(data.action_postion);
                        $('#news_id').val(data.id);

                        if(data.image==""){
                            $('#edit_photo_text').text(" 新增照片");
                            $('#ShowImg').attr('src','/photo/sample900*300.jpg');
                            $('#spUpdatePhoto').text(" 上傳");

                        }else{
                            
                            $('#ShowImg').attr('src',data.image);
                            $('#edit_photo_text').text(" 更換照片");
                            $('#spUpdatePhoto').text(" 更新");
                            // alert(data[0].image_path);
                        }
                      
                        //alert(data[0].id);
                    }
                });
            });

        </script>
    </body>