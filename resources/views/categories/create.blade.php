@extends('layouts.app')

@section('content')
<h2>Add Category</h2>
<form method="post" action="{{ route('categories.store') }}">
  @csrf
  <label>Name</label>
  <input name="name" value="{{ old('name') }}" required>
  @error('name') <small style="color:#b00">{{ $message }}</small> @enderror
  <div style="margin-top:.5rem">
    <button class="btn btn-primary" type="submit">Create</button>
    <a class="btn" href="{{ route('categories.index') }}">Cancel</a>
  </div>
</form>
@endsection
