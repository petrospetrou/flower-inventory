@extends('layouts.app')

@section('content')
<h2>Flowers</h2>

<form method="get" class="filters">
  <input name="q" value="{{ request('q') }}" placeholder="Search name or type">
  <select name="category_id">
    <option value="">All categories</option>
    @foreach($categories as $c)
      <option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ $c->name }}</option>
    @endforeach
  </select>
  <select name="sort">
    <option value="name" @selected(request('sort')=='name')>Sort by Name</option>
    <option value="price" @selected(request('sort')=='price')>Sort by Price</option>
    <option value="created_at" @selected(request('sort')=='created_at')>Newest</option>
  </select>
  <select name="dir">
    <option value="asc" @selected(request('dir')=='asc')>Asc</option>
    <option value="desc" @selected(request('dir')=='desc')>Desc</option>
  </select>
  <button class="btn" type="submit">Apply</button>
  <a class="btn" href="{{ route('flowers.index') }}">Reset</a>
</form>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Type</th>
      <th>Price</th>
      <th style="width:160px"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($items as $f)
      <tr>
        <td><a href="{{ route('flowers.show',$f) }}">{{ $f->name }}</a></td>
        <td>{{ $f->category->name }}</td>
        <td>{{ $f->type }}</td>
        <td>{{ number_format($f->price, 2) }}</td>
        <td class="actions">
          <a class="btn" href="{{ route('flowers.edit',$f) }}">Edit</a>
          <form class="inline" action="{{ route('flowers.destroy',$f) }}" method="post"
                onsubmit="return confirm('Delete {{ $f->name }}?');">
            @csrf @method('DELETE')
            <button class="btn" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">No flowers found.</td></tr>
    @endforelse
  </tbody>
</table>

<div style="margin-top:.5rem">
  {{ $items->withQueryString()->links() }}
</div>
@endsection
