@extends('layouts.app')

@section('content')
<h2>Delete Category</h2>

<div class="panel">
  <p>You're about to delete <strong>{{ $category->name }}</strong>.</p>
  <p class="hint">This action cannot be undone.</p>

  <form method="post" action="{{ route('categories.destroy', $category) }}" style="margin-top:12px">
    @csrf @method('DELETE')
    <button class="btn btn-danger" type="submit">Yes, delete</button>
    <a class="btn" href="{{ route('categories.index') }}">Cancel</a>
  </form>
</div>
@endsection
