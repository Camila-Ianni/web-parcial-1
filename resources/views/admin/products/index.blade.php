@extends('admin.layout')

@section('title', 'Gestionar Outfits')

@section('content')
<div class="top-row">
  <h1>Gestionar Outfits</h1>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn primary" href="{{ route('admin.products.create') }}">Nuevo outfit</a>
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
  <a class="btn" href="{{ route('admin.users.index') }}">Gestionar usuarios</a>
</div>

@if(session('status'))
  <p class="status">{{ session('status') }}</p>
@endif

<section class="panel">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Nombre</th><th>Categoria</th><th>Precio</th><th>Stock</th><th>Activo</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      @foreach($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ $product->category->name }}</td>
          <td>{{ $product->formattedPrice() }}</td>
          <td>{{ $product->stock }}</td>
          <td>{{ $product->is_active ? 'Si' : 'No' }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('admin.products.edit', $product) }}">Editar</a>
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Eliminar outfit?')">
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
