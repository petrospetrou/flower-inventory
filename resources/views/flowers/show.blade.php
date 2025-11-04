@extends('layouts.app')

@section('content')
<h2>{{ $flower->name }}</h2>

<p><strong>Category:</strong> {{ $flower->category->name }}</p>
<p><strong>Type:</strong> {{ $flower->type ?? '—' }}</p>
<p><strong>Price:</strong> {{ number_format($flower->price,2) }}</p>
@if($flower->description)
  <p><strong>Description:</strong> {{ $flower->description }}</p>
@endif

@if($flower->image_path)
  <p><img src="{{ asset('storage/'.$flower->image_path) }}" alt="{{ $flower->name }}" style="max-width:300px"></p>
@endif

<p class="actions">
  <a class="btn" href="{{ route('flowers.edit',$flower) }}">Edit</a>
  <a class="btn" href="{{ route('flowers.index') }}">Back</a>
</p>
@endsection
