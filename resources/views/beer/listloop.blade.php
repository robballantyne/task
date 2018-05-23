<div class="container beers-list">
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
                    <blockquote>{{ $beer->tagline }}</blockquote>
                </div>
            </div>

        @endforeach
    </div>
</div>