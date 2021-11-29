@extends('fe.layout')
@section('mt-description')
@if($category)
{{$category->name}}
@endif
@endsection

@section('mt-keyword')
@if($category)
{{$category->name}}
@endif
@endsection
@section('content')
<div class="grid grid-cols-10 mt-10 md:mx-10">
    <div class="col-span-1 border-2 rounded-lg mr-5">
        <ul class="font-semibold ml-2">
            <li>
            <li>
                <a href="{{route('fe.category',['id'=>-1])}}">Tất cả</a>
            </li>
            </li>
            @foreach($allCategory as $cat)
            <li>
                <a href="{{route('fe.category',['id'=>$cat->id])}}">{{$cat->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="col-span-9">
        <h4 class="font-bold text-2xl">
            @if($category)
            {{$category->name}}
            @else
            Tất cả
            @endif
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-5">
            @foreach($products as $item)
            @include('fe.products.card',['item'=>$item])
            @endforeach
        </div>
    </div>
</div>
@endsection