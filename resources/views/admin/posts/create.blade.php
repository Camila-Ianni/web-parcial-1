@extends('admin.layout')

@section('title', 'Nuevo Post')

@section('content')
<h1>Nuevo Post</h1>

<div class="tabs">
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
  <a class="btn primary" href="{{ route('admin.posts.create') }}">Nuevo post</a>
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
</div>

<section class="panel">
  <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    <div>
      <label for="title">Titulo</label>
      <input id="title" name="title" value="{{ old('title') }}" required>
    </div>
    <div>
      <label for="slug">Slug</label>
      <input id="slug" name="slug" value="{{ old('slug') }}">
    </div>
    <div>
      <label for="excerpt">Excerpt</label>
      <input id="excerpt" name="excerpt" value="{{ old('excerpt') }}" required>
    </div>
    <div>
      <label for="author_name">Autor</label>
      <input id="author_name" name="author_name" value="{{ old('author_name') }}" required>
    </div>
    <div>
      <label for="category_id">Categoria</label>
      <select id="category_id" name="category_id" required style="background: white;">
        <option value="">-- Seleccionar Categoría --</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div>
      <label for="image">Imagen (Archivo)</label>
      <input id="image" type="file" name="image" required accept="image/*">
    </div>
    <div>
      <label for="published_at">Fecha publicacion</label>
      <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at') }}">
    </div>
    <div class="checkbox" style="margin-top: 24px;">
      <input id="is_published" type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
      <label for="is_published" style="margin:0;">Publicado</label>
    </div>
    <div class="field-full">
      <label for="content">Contenido</label>
      <textarea id="content" name="content" required>{{ old('content') }}</textarea>
    </div>
    <div class="field-full">
      <button class="btn primary" type="submit">Guardar</button>
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
