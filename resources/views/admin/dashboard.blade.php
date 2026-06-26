@extends('admin.layout')

@section('title', 'Admin Panel')

@section('content')
  <h1>Dashboard</h1>
  <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px;">
    <section class="panel">
      <h2>Blog</h2>
      <p>Total de posts: {{ $postsCount }}</p>
      <div class="tabs" style="margin-top: 10px; margin-bottom: 0;">
        <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
        <a class="btn primary" href="{{ route('admin.posts.create') }}">Nuevo post</a>
      </div>
    </section>

    <section class="panel">
      <h2>Outfits</h2>
      <p>Total de outfits: {{ $productsCount }}</p>
      <div class="tabs" style="margin-top: 10px; margin-bottom: 0;">
        <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
        <a class="btn primary" href="{{ route('admin.products.create') }}">Nuevo outfit</a>
      </div>
    </section>

    <section class="panel">
      <h2>Usuarios</h2>
      <p>Total de usuarios: {{ $usersCount }}</p>
      <div class="tabs" style="margin-top: 10px; margin-bottom: 0;">
        <a class="btn" href="{{ route('admin.users.index') }}">Gestionar usuarios</a>
      </div>
    </section>
  </div>
@endsection
