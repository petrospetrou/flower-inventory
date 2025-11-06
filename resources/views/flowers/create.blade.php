@extends('layouts.app')

@section('content')
<h2>Add Flower</h2>
<form method="post" action="{{ route('flowers.store') }}" enctype="multipart/form-data">
  @include('flowers._form', ['submit' => 'Create'])
</form>
@endsection
