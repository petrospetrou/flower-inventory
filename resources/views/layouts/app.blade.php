<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Flower Inventory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <header>
    <h1><a href="{{ route('home') }}">🌸 Flower Inventory</a></h1>
    <nav>
      <a href="{{ route('flowers.index') }}">Flowers</a>
      <a href="{{ route('categories.index') }}">Categories</a>
      <a class="btn btn-primary" href="{{ route('flowers.create') }}">Add Flower</a>
    </nav>
  </header>
  @if(session('ok')) <div class="flash">{{ session('ok') }}</div> @endif
  @yield('content')
</body>
</html>
