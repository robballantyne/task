@extends('layout')

@section('content')
    <form action="{{ route('beer.search') }}" method="POST">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('beer.random') }}" class="btn btn-block btn-default"><span class="glyphicon glyphicon-refresh"></span> Random</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="container">
        <div class="row">
            @foreach($beers as $beer)
                <div class="col-md-4">
                    <p><a href="{{ route('beer.show', $beer->id) }}">{{ $beer->name }}</a></p>
                </div>
            @endforeach
        </div>
    </div>
@endsection