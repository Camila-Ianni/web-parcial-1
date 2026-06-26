@extends('admin.layout')

@section('title', 'Editar Outfit')

@section('content')
<h1>Editar Outfit</h1>

<div class="tabs">
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
  <a class="btn" href="{{ route('admin.products.create') }}">Nuevo outfit</a>
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
</div>

<section class="panel">
  <form method="POST" action="{{ route('admin.products.update', $product) }}" class="form-grid">
    @csrf
    @method('PUT')
    <div>
      <label for="name">Nombre</label>
      <input id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div>
      <label for="slug">Slug</label>
      <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
    </div>
    <div class="field-full">
      <label for="description">Descripcion</label>
      <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
    </div>
    <div>
      <label for="category">Categoria</label>
      <input id="category" name="category" value="{{ old('category', $product->category) }}" required>
    </div>
    <div>
      <label for="image_path">Image path</label>
      <input id="image_path" name="image_path" value="{{ old('image_path', $product->image_path) }}" required>
    </div>
    <div>
      <label for="price">Precio</label>
      <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
    </div>
    <div>
      <label for="stock">Stock</label>
      <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="checkbox" style="margin-top: 24px;">
      <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
      <label for="is_active" style="margin:0;">Activo</label>
    </div>
    <div class="field-full">
      <button class="btn primary" type="submit">Actualizar</button>
    </div>
  </form>

  @if($errors->any())
    <ul class="errors">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  @endif
</section>
@endsection
