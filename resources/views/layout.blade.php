<!DOCTYPE html>
<html>
    <head>
        <title>Brewtiful</title>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/app.js"></script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <div class="col-md-2">
                    <a href="/"><img src="/logo.png" class="img-responsive" alt=""></a>
                </div>
                <div class="col-md-10">
                    <h1>Brewtiful</h1>
                    <p style="margin-bottom: 0;">The DIY BrewDog beer browsing web app.</p>
                </div>
            </div>
        </div>

        @yield('content')
    </body>
</html>
