        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" /> --}}
        <link href="{{ asset('css/treeview.css')}}" rel="stylesheet">

    <body>
          <div class="well">
            <h4>消息分類</h4>
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
                {{--<hr color="#FF0000">--}}
          </div>
    </body>
