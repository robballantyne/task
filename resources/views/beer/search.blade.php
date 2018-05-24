@extends('layout')

@section('content')
    <div class="container search-info">
        <div class="row">
            <div class="col-xs-12">{{ $beers->total() }} search results for '{{ $query }}'</div>
        </div>
    </div>
    @if ($list)
        @include('beer.listloop')

    @else
        @include('beer.gridloop')
    @endif

    @include('beer.pagination')

@endsection