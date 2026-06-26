@extends('admin.layout')

@section('title', 'Gestionar Usuarios')

@section('content')
<div class="top-row">
  <h1>Gestionar Usuarios</h1>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
  <a class="btn primary" href="{{ route('admin.users.index') }}">Gestionar usuarios</a>
</div>

@if(session('status'))
  <p class="status">{{ session('status') }}</p>
@endif

<section class="panel">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Fecha Registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if($user->is_admin)
              <span style="color: var(--hot-pink); font-weight: bold;">Administrador</span>
            @else
              <span>Usuario Común</span>
            @endif
          </td>
          <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
          <td class="actions">
            <a class="btn" href="{{ route('admin.users.show', $user) }}">Ver Detalle</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
