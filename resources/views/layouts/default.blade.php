<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Rabbits🐇 Planet') - by SIYU</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('layouts._header')


    <div class="container">
        <div class="col-md-offset-1 col-md-10">
             @yield('shared._messages')
             @yield('content')
             @include('layouts._footer')
        </div>
    </div>
  </body>
</html>