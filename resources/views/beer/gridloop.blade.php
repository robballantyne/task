<div class="container beers-grid">
    <div class="flex-row row">
        @foreach($beers as $beer)
        <div class="col-sm-6 col-lg-4">
            <div class="beer-wrapper">
                <a href="{{ route('beer.show', $beer->id) }}">
                    <img class="img-responsive" src="{{ $beer->image_url }}">
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