@extends('layouts.app')

@section('content')
<h2>Edit Category</h2>
<form method="post" action="{{ route('categories.update', $category) }}">
  @csrf @method('PUT')
  <label>Name</label>
  <input name="name" value="{{ old('name', $category->name) }}" required>
  @error('name') <small style="color:#b00">{{ $message }}</small> @enderror
  <div style="margin-top:.5rem">
    <button class="btn btn-primary" type="submit">Update</button>
    <a class="btn" href="{{ route('categories.index') }}">Cancel</a>
  </div>
</form>
@endsection
