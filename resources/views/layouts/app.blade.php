<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Flower Inventory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,sans-serif;max-width:1000px;margin:2rem auto;padding:0 1rem;}
    header,nav{display:flex;gap:1rem;align-items:center;justify-content:space-between;}
    a{color:#0a58ca;text-decoration:none} a:hover{text-decoration:underline}
    .btn{display:inline-block;padding:.5rem .75rem;border:1px solid #ccc;border-radius:.5rem}
    .btn-primary{border-color:#0a58ca;background:#0a58ca;color:#fff}
    .flash{background:#e6ffed;border:1px solid #b7f5c8;padding:.5rem .75rem;border-radius:.5rem;margin:.5rem 0}
    table{width:100%;border-collapse:collapse;margin-top:1rem}
    th,td{border-bottom:1px solid #eee;padding:.5rem;text-align:left}
    form.inline{display:inline}
    .actions a,.actions button{margin-right:.25rem}
    .row{display:flex;gap:1rem;flex-wrap:wrap}
    .col{flex:1 1 280px}
    input,select,textarea{width:100%;padding:.5rem;border:1px solid #ccc;border-radius:.4rem}
    .filters{display:flex;gap:.5rem;flex-wrap:wrap;margin:.5rem 0}
  </style>
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
