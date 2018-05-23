@extends('layout')

@section('content')
    @if ($list)
        @include('beer.listloop')

    @else
        @include('beer.gridloop')
    @endif

    @include('beer.pagination')

@endsection