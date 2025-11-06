@extends('layouts.app')

@section('content')
<h2>Edit Flower</h2>
<form method="post" action="{{ route('flowers.update', $flower) }}" enctype="multipart/form-data">
  @method('PUT')
  @include('flowers._form', ['submit' => 'Update', 'flower' => $flower])
</form>
@endsection
