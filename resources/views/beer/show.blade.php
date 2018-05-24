@extends('layout')

@section('content')
    <div class="container show-beer">
        <div class="panel">
            <div class="panel-body">
                <h1>{{ $beer->name }}</h1>
                <p class="tagline">{{ $beer->tagline }}</p>
                <div class="flex-row row">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <img class="img-responsive" src="{{ $beer->image_url }}">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <div class="info">
                            <table class="table">
                                <tr>
                                    <td>ABV</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li class="list-unstyled">{{ $beer->abv }}%</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hops</td>
                                    <td>
                                        <ul class="list-unstyled">
                                        @foreach($beer->getHops() as $hop)
                                            <li class="list-unstyled">{{ $hop['name'] }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Malt</td>
                                    <td>
                                        <ul class="list-unstyled">
                                        @foreach($beer->getMalt() as $malt)
                                                <li class="list-unstyled">{{ $malt['name'] }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Yeast</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li class="list-unstyled">{{ $beer->getYeast() }}</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p>{{ $beer->description }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection