@extends('layout')

@section('content')

    @if ($list === true)
        @include('beer.listloop')

    @else
        @include('beer.gridloop')
    @endif

    @include('beer.pagination')

@endsection