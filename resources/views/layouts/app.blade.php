<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Backpack Frontend</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="/home">Home</span></a>
      </li>
      <li class="nav-item {{ Request::is('about-us') ? 'active' : '' }}">
        <a class="nav-link" href="/about-us">About Us</span></a>
      </li>
      </li>
    </ul>
  </div>
</nav>

<main role="main" class="container">

  <div class="starter-template">
    <h1>@yield('title')/h1>
    <p class="lead">@yield('content')</p>
  </div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  </body>
</html>
