<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Portal</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css" >
</head>
    <body>

        <nav id="banner">
            <div id="logo"><a href="/">SMS Portal</a></div>
            <ul id="navigation">
                <li class="nav-item"><a class="nav-link" href="/">Create message</a></li>
                <li class="nav-item"><a class="nav-link" href="/messages">Messages</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/signup">Signup</a></li>
            </ul>
        </nav>

        @yield('content')
    </body>
</html>