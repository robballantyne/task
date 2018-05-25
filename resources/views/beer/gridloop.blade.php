<div class="container beers-grid">
        <div class="view-switch panel">
            <div class="panel-body">
                <button id="list-view-switch" class="btn view-switch" data-view="list"><i class="glyphicon glyphicon-list"></i></button>
                <button id="grid-view-switch" disabled=disabled class="btn view-switch" data-view="grid"><i class="glyphicon glyphicon-th-large"></i></button>
            </div>
        </div>
    <div class="flex-row row">
        @foreach($beers as $beer)
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="beer-wrapper">
                <a href="{{ route('beer.show', $beer->id) }}">
                    <img class="img-responsive" src="{{ $beer->image_url }}">
                    @auth
                    @if (count($beer->users) > 0)
                        <button class="btn fav-toggle favourite" data-beer-id="{{ $beer->id }}"><i class="glyphicon glyphicon-heart"></i></button>
                    @else
                        <button class="btn fav-toggle" data-beer-id="{{ $beer->id }}"><i class="glyphicon glyphicon-heart"></i></button>
                    @endif
                    @endauth
                </a>
                <div class="info">
                    <p class="title"><a href="{{ route('beer.show', $beer->id) }}">{{ $beer->name }}</a></p>
                    <p class="tagline">{{ $beer->tagline }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>