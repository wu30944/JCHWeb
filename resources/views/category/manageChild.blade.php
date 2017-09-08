<ul>
    @foreach($childs as $child)
    <li>
        {{-- <a href="">{{ $child->title }} </a> --}}
        {{-- {{route('month_news',$child->value)}} --}}
        <a href="" id="{{$child->value}}">{{ $child->title }}</a>
        {{-- <a href="{{route('fellowship',$fellowship->id)}}">{{ $child->title }}</a> --}}
        @if(count($child->childs))
            @include('category.manageChild',['childs' => $child->childs])
        @endif
           </li>
    @endforeach
</ul>
