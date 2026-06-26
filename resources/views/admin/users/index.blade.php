@extends('admin.layout')

@section('title', 'Gestionar Miembros')

@section('content')
<div class="top-row" style="margin-bottom: 20px;">
  <div>
    <span style="font-size: 13px; font-weight: 900; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 4px;">✦ Plastics Member Registry ✦</span>
    <h1 style="margin-bottom: 0;">Gestionar Miembros</h1>
  </div>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
  <a class="btn primary" href="{{ route('admin.users.index') }}">Gestionar usuarios</a>
</div>

@if(session('status'))
  <p class="status"><span>✨</span> {{ session('status') }}</p>
@endif

<section class="panel">
  <h2 style="font-size: 18px; margin-bottom: 16px; font-family: 'Outfit', sans-serif; font-weight: 600; color: var(--dark-magenta); display: flex; align-items: center; gap: 8px;">
    <span>👥</span> Lista de Miembros Registrados
  </h2>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre del Miembro</th>
          <th>Email</th>
          <th>Rango / Rol</th>
          <th>Fecha de Ingreso</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td style="font-weight: bold; color: #888;">#{{ $user->id }}</td>
          <td>
            <div style="font-weight: 900; color: var(--ink);">{{ $user->name }}</div>
          </td>
          <td style="color: #666;">{{ $user->email }}</td>
          <td>
            @if($user->is_admin)
              <span style="color: white; font-weight: bold; background: linear-gradient(135deg, var(--hot-pink) 0%, var(--bubblegum) 100%); padding: 4px 12px; border-radius: 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block;">
                Admin Plastica 👑
              </span>
            @else
              <span style="color: #555; font-weight: 600; background: #e2e8f0; padding: 4px 12px; border-radius: 20px; font-size: 11px; text-transform: uppercase; display: inline-block;">
                Usuario Común
              </span>
            @endif
          </td>
          <td style="color: #888; font-size: 13px;">{{ $user->created_at->format('d/m/Y H:i') }}</td>
          <td class="actions">
            <a class="btn" style="padding: 6px 14px; font-size: 11px;" href="{{ route('admin.users.show', $user) }}">Ver Ficha</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</section>
@endsection
