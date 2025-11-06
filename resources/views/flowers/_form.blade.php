@csrf
@php
  // Safely format price for the number input (avoids "2.4" vs "2.40")
  $priceValue = old('price', isset($flower) ? number_format($flower->price, 2, '.', '') : '');
@endphp

<div class="row">
  <div class="col">
    <label for="category_id">Category</label>
    <select id="category_id" name="category_id" required aria-describedby="category_id_hint @error('category_id') category_id_error @enderror">
      <option value="">-- choose --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" @selected(old('category_id', $flower->category_id ?? '') == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    <small id="category_id_hint" class="hint">Pick the group this flower belongs to.</small>
    @error('category_id') <small id="category_id_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
  </div>

  <div class="col">
    <label for="name">Name</label>
    <input id="name" name="name" value="{{ old('name', $flower->name ?? '') }}" required placeholder="e.g., Red Rose" aria-describedby="name_hint @error('name') name_error @enderror">
    <small id="name_hint" class="hint">Short, descriptive (e.g., “Red Rose”).</small>
    @error('name') <small id="name_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
  </div>
</div>

<div class="row">
  <div class="col">
    <label for="type">Type</label>
    <input id="type" name="type" value="{{ old('type', $flower->type ?? '') }}" placeholder="e.g., Hybrid Tea" aria-describedby="type_hint @error('type') type_error @enderror">
    <small id="type_hint" class="hint">Optional subtype (e.g., “Hybrid Tea”).</small>
    @error('type') <small id="type_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
  </div>

  <div class="col">
    <label for="price">Price</label>
    <input id="price" type="number" step="0.01" min="0" inputmode="decimal" name="price"
           value="{{ $priceValue }}" required placeholder="0.00"
           aria-describedby="price_hint @error('price') price_error @enderror">
    <small id="price_hint" class="hint">Numeric only, no currency symbol.</small>
    @error('price') <small id="price_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
  </div>
</div>

<div>
  <label for="description">Description</label>
  <textarea id="description" name="description" rows="3" placeholder="Optional notes about this flower"
            aria-describedby="description_hint @error('description') description_error @enderror">{{ old('description', $flower->description ?? '') }}</textarea>
  <small id="description_hint" class="hint">Shown on the details page.</small>
  @error('description') <small id="description_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
</div>

<div>
  <label for="image">Image</label>
  <input id="image" type="file" name="image" accept="image/*" aria-describedby="@error('image') image_error @enderror">
  @error('image') <small id="image_error" role="alert" style="color:#b00">{{ $message }}</small> @enderror
</div>

@if(isset($flower) && $flower->image_path)
  <div style="margin-top:.5rem">
    <strong>Current image:</strong><br>
    <img src="{{ asset('storage/'.$flower->image_path) }}"
         alt="{{ $flower->name }}"
         style="max-width:160px;height:auto;object-fit:cover;border:1px solid #ddd;border-radius:6px;">
  </div>

  {{-- Hidden input ensures the key posts even when unchecked --}}
  <input type="hidden" name="remove_image" value="0">

  <div style="margin-top:.5rem">
    <label>
      <input type="checkbox" name="remove_image" value="1" {{ old('remove_image') ? 'checked' : '' }}>
      Remove current image
    </label>
  </div>
@endif

<div style="margin-top:.5rem">
  <button class="btn btn-primary" type="submit">{{ $submit ?? 'Save' }}</button>
  <a class="btn" href="{{ route('flowers.index') }}">Cancel</a>
</div>
