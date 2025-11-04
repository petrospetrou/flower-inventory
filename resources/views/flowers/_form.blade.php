@csrf
<div class="row">
  <div class="col">
    <label>Category</label>
    <select name="category_id" required>
      <option value="">-- choose --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(old('category_id', $flower->category_id ?? '') == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('category_id') <small style="color:#b00">{{ $message }}</small> @enderror
  </div>
  <div class="col">
    <label>Name</label>
    <input name="name" value="{{ old('name', $flower->name ?? '') }}" required>
    @error('name') <small style="color:#b00">{{ $message }}</small> @enderror
  </div>
</div>

<div class="row">
  <div class="col">
    <label>Type</label>
    <input name="type" value="{{ old('type', $flower->type ?? '') }}">
    @error('type') <small style="color:#b00">{{ $message }}</small> @enderror
  </div>
  <div class="col">
    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $flower->price ?? '') }}" required>
    @error('price') <small style="color:#b00">{{ $message }}</small> @enderror
  </div>
</div>

<div>
  <label>Description</label>
  <textarea name="description" rows="3">{{ old('description', $flower->description ?? '') }}</textarea>
  @error('description') <small style="color:#b00">{{ $message }}</small> @enderror
</div>

{{-- If you do Day 3 uploads, uncomment:
<div>
  <label>Image</label>
  <input type="file" name="image" accept="image/*">
  @error('image') <small style="color:#b00">{{ $message }}</small> @enderror
</div>
--}}

<div style="margin-top:.5rem">
  <button class="btn btn-primary" type="submit">{{ $submit ?? 'Save' }}</button>
  <a class="btn" href="{{ route('flowers.index') }}">Cancel</a>
</div>
