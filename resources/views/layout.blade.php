<!DOCTYPE html>
<html>
    <head>
        <title>Brewtiful</title>
        <meta name="csrf-token" content="{{ Session::token() }}">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/my.css">
        <script src="/js/app.js"></script>
        <script src="/js/my.js"></script>
        <link rel="icon" type="image/png" href="/favicon-64.png" sizes="64x64">
        <link rel="icon" type="image/png" href="/favicon-32.png" sizes="32x32">
    </head>
    <body>
        <div class="jumbotron header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <a href="/"><img src="/logo.png" class="img-responsive" alt=""></a>
                    </div>
                    <div class="col-md-10">
                        <h1>Brewtiful</h1>
                        <p style="margin-bottom: 0;">The DIY BrewDog beer browsing web app.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 account-links">
                        <ul class="list-inline">
                            @guest
                            <li><a href="/login">Sign in</a> / <a href="/register">Register</a></li>
                            @endguest
                            @auth
                                    <li><a href="{{ route('auth.userfavourite') }}">My Favourites</a> / <a href="/logout">Sign out</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('beer.search') }}" method="GET">
            <div class="container">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <input name="query" type="text" class="form-control" placeholder="Search...">
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

        @yield('content')
    </body>
</html>
