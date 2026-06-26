@extends('admin.layout')

@section('title', 'Gestionar Posts')

@section('content')
<div class="top-row">
  <h1>Gestionar Posts</h1>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn primary" href="{{ route('admin.posts.create') }}">Nuevo post</a>
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
  <a class="btn" href="{{ route('admin.users.index') }}">Gestionar usuarios</a>
</div>

@if(session('status'))
  <p class="status">{{ session('status') }}</p>
@endif

<section class="panel">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Titulo</th><th>Categoria</th><th>Autor</th><th>Publicado</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category }}</td>
          <td>{{ $post->author_name }}</td>
          <td>{{ $post->is_published ? 'Si' : 'No' }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('admin.posts.edit', $post) }}">Editar</a>
            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Eliminar post?')">
              @csrf
              @method('DELETE')
              <button class="btn danger" type="submit">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
