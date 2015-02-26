<!doctype html>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mapage</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="/css/main.css">
        <link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
    </head>
    <body>
        {{-- Add a development mode warning banner --}}
        @if (app()->environment() !== "production")
        <div class="dev"><div class="dev__banner"></div><div class="dev__displace"></div></div>
        @endif

        <div class="container">
            <div class="row header">
                <h1 class="six columns"><a class="link--stealth" href="/">Mapage</a></h1>
                <div class="six columns user">
                    @if ($user)
                    <span class="user__name">{{ $user->name }}</span>
                    <img class="avatar" src="{{ $user->gravatar }}" />
                    @else
                    <a href="/login">Login</a> / <a href="/signup">Sign Up</a>
                    @endif
                </div>
            </div>
            @yield('content')
        </div>
    </body>
</html>
