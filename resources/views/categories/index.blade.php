@extends('layouts.app')

@section('content')
<h2>Categories</h2>

<div class="panel">
  <div class="toolbar">
    <div><strong>All Categories</strong></div>
    <div><a class="btn btn-primary" href="{{ route('categories.create') }}">Add Category</a></div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th style="width:160px"></th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $c)
        <tr>
          <td>{{ $c->name }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('categories.edit',$c) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('categories.confirm-delete',$c) }}">Delete</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="2">No categories yet. <a href="{{ route('categories.create') }}">Add one</a>.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div style="margin-top:.5rem">
    {{ $items->links() }}
  </div>
</div>
@endsection
