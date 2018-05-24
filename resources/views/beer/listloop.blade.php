<div class="container beers-list">
    <div class="view-switch panel">
        <div class="panel-body">
            <button id="list-view-switch" disabled=disabled class="btn view-switch" data-view="list"><i class="glyphicon glyphicon-list"></i></button>
            <button id="grid-view-switch" class="btn view-switch" data-view="grid"><i class="glyphicon glyphicon-th-large"></i></button>
        </div>
    </div>
    <div class="flex-row row">
        @foreach($beers as $beer)
            <div class="col-sm-4 col-md-3">
                <a href="{{ route('beer.show', $beer->id) }}">
                    <div class="img-wrap">
                        <img class="img-responsive" src="{{ $beer->image_url }}">
                    </div>
                </a>
            </div>

            <div class="col-sm-8 col-md-9">
                <div class="info">
                    <h2>{{ $beer->name }}</h2>
                    <blockquote class="tagline">{{ $beer->tagline }}</blockquote>
                </div>
            </div>

        @endforeach
    </div>
</div>