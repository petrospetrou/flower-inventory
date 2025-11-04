@extends('layouts.app')

@section('content')
<h2>Categories</h2>

<p><a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a></p>

<table>
  <thead><tr><th>Name</th><th style="width:160px"></th></tr></thead>
  <tbody>
    @forelse($items as $c)
      <tr>
        <td>{{ $c->name }}</td>
        <td class="actions">
          <a class="btn" href="{{ route('categories.edit',$c) }}">Edit</a>
          <form class="inline" method="post" action="{{ route('categories.destroy',$c) }}"
                onsubmit="return confirm('Delete category {{ $c->name }}?');">
            @csrf @method('DELETE')
            <button class="btn" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="2">No categories yet.</td></tr>
    @endforelse
  </tbody>
</table>

<div style="margin-top:.5rem">{{ $items->links() }}</div>
@endsection
