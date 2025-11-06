@extends('layouts.app')

@section('content')
<h2>Delete Flower</h2>

<div class="panel">
  <p>You're about to delete <strong>{{ $flower->name }}</strong>.</p>
  <p class="hint">This action cannot be undone.</p>

  <div class="row" style="margin-top:.5rem">
    <div class="col">
      <p><strong>Category:</strong> {{ $flower->category->name }}</p>
      <p><strong>Type:</strong> {{ $flower->type ?? '—' }}</p>
      <p><strong>Price:</strong> {{ number_format($flower->price,2) }}</p>
    </div>
  </div>

  <form method="post" action="{{ route('flowers.destroy', $flower) }}" style="margin-top:12px">
    @csrf @method('DELETE')
    <button class="btn btn-danger" type="submit">Yes, delete</button>
    <a class="btn" href="{{ route('flowers.index') }}">Cancel</a>
  </form>
</div>
@endsection
