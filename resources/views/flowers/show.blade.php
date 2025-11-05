@extends('layouts.app')

@section('content')
<h2>{{ $flower->name }}</h2>

<div class="panel">
  {{-- optional image on the right if present --}}
  <div class="row" style="align-items:start">
    <div class="col">
      <p><strong>Category:</strong> {{ $flower->category->name }}</p>
      <p><strong>Type:</strong> {{ $flower->type ?: '—' }}</p>
      <p><strong>Price:</strong> {{ number_format($flower->price, 2) }}</p>

      @if($flower->description)
        <div style="margin-top:.75rem">
          <strong>Description:</strong>
          <p class="hint" style="margin:.25rem 0 0 0">{{ $flower->description }}</p>
        </div>
      @endif

      <div style="margin-top:1rem">
        <a class="btn" href="{{ route('flowers.edit',$flower) }}">Edit</a>
        <a class="btn" href="{{ route('flowers.index') }}">Back</a>
        <a class="btn btn-danger" href="{{ route('flowers.confirm-delete',$flower) }}">Delete</a>
      </div>
    </div>

    @if($flower->image_path)
      <div class="col" style="max-width:360px">
        <img src="{{ asset('storage/'.$flower->image_path) }}"
             alt="{{ $flower->name }}" style="width:100%;border-radius:.5rem;border:1px solid var(--line)">
      </div>
    @endif
  </div>
</div>
@endsection
