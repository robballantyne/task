@extends('layout')

@section('content')

    @if ($list === true)
        <div class="favourites">
        @include('beer.listloop')
        </div>
    @else
        <div class="favourites">
        @include('beer.gridloop')
        </div>
    @endif

    @include('beer.pagination')

@endsection