<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title> @yield('title') </title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">KU-Merch</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/catalog">Catalog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/">History</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/register">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Log In</a>
                </li>
              </ul>
            </div> 
          </nav>
          <div class="container py-2">
            @yield('content')
          </div>
    </body>
</html>