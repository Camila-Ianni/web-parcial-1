@extends('admin.layout')

@section('title', 'Editar Post')

@section('content')
<h1>Editar Post</h1>

<div class="tabs">
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
  <a class="btn" href="{{ route('admin.posts.create') }}">Nuevo post</a>
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
</div>

<section class="panel">
  <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    @method('PUT')
    <div>
      <label for="title">Titulo</label>
      <input id="title" name="title" value="{{ old('title', $post->title) }}" required>
    </div>
    <div>
      <label for="slug">Slug</label>
      <input id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
    </div>
    <div>
      <label for="excerpt">Excerpt</label>
      <input id="excerpt" name="excerpt" value="{{ old('excerpt', $post->excerpt) }}" required>
    </div>
    <div>
      <label for="author_name">Autor</label>
      <input id="author_name" name="author_name" value="{{ old('author_name', $post->author_name) }}" required>
    </div>
    <div>
      <label for="category">Categoria</label>
      <input id="category" name="category" value="{{ old('category', $post->category) }}" required>
    </div>
    <div>
      <label for="image">Cambiar Imagen (Archivo, Opcional)</label>
      <input id="image" type="file" name="image" accept="image/*">
      <div style="margin-top: 10px;">
        <span style="font-size: 11px; font-weight: bold; color: #777; display: block; margin-bottom: 4px;">Imagen actual:</span>
        <img src="{{ asset($post->image_path) }}" alt="Imagen actual" style="max-height: 80px; border-radius: 8px; border: 1px solid var(--soft-pink);">
      </div>
    </div>
    <div>
      <label for="published_at">Fecha publicacion</label>
      <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
    </div>
    <div class="checkbox" style="margin-top: 24px;">
      <input id="is_published" type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
      <label for="is_published" style="margin:0;">Publicado</label>
    </div>
    <div class="field-full">
      <label for="content">Contenido</label>
      <textarea id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
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
