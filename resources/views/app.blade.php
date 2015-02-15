<!doctype html>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        {{-- Add a development mode warning banner --}}
        @if (app()->environment() !== "production")
        <div class="dev"><div class="dev__banner"></div><div class="dev__displace"></div></div>
        @endif

        @yield('content')
    </body>
</html>
