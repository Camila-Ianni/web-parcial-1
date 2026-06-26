@extends('admin.layout')

@section('title', 'Detalle de Usuario')

@section('content')
<div class="top-row">
  <h1>Detalle de Usuario</h1>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn" href="{{ route('admin.users.index') }}">← Volver a usuarios</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
  
  <!-- Info Card -->
  <section class="panel">
    <h2 style="margin-bottom: 15px; border-bottom: 1px solid var(--soft-pink); padding-bottom: 6px;">Datos de Usuario</h2>
    <div style="display: flex; flex-direction: column; gap: 10px;">
      <div>
        <strong style="font-size: 12px; color: #7c5367;">NOMBRE:</strong>
        <p style="font-size: 15px; font-weight: bold;">{{ $user->name }}</p>
      </div>
      <div>
        <strong style="font-size: 12px; color: #7c5367;">EMAIL:</strong>
        <p style="font-size: 15px;">{{ $user->email }}</p>
      </div>
      <div>
        <strong style="font-size: 12px; color: #7c5367;">ROL:</strong>
        <p style="font-size: 14px;">
          @if($user->is_admin)
            <span style="color: var(--hot-pink); font-weight: bold; background: var(--soft-pink); padding: 2px 8px; border-radius: 6px;">Administrador</span>
          @else
            <span style="background: #e2e8f0; padding: 2px 8px; border-radius: 6px;">Usuario Común</span>
          @endif
        </p>
      </div>
      <div>
        <strong style="font-size: 12px; color: #7c5367;">REGISTRADO EL:</strong>
        <p style="font-size: 14px; color: #555;">{{ $user->created_at->format('d/m/Y H:i') }}</p>
      </div>
    </div>
  </section>

  <!-- Purchases Card -->
  <section class="panel">
    <h2 style="margin-bottom: 15px; border-bottom: 1px solid var(--soft-pink); padding-bottom: 6px;">Servicios Contratados / Compras</h2>
    
    @if($user->purchases->isEmpty())
      <div style="text-align: center; padding: 30px; color: #888;">
        <span style="font-size: 40px; display: block; margin-bottom: 10px;">🛍️</span>
        Este usuario no tiene servicios contratados ni compras realizadas actualmente.
      </div>
    @else
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID Compra</th>
              <th>Producto/Servicio</th>
              <th>Categoría</th>
              <th>Precio Pagado</th>
              <th>Fecha de Compra</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user->purchases as $purchase)
              <tr>
                <td>#{{ $purchase->id }}</td>
                <td>
                  <strong>{{ $purchase->product->name }}</strong>
                </td>
                <td>{{ $purchase->product->category }}</td>
                <td style="font-weight: bold; color: var(--hot-pink);">
                  ${{ number_format($purchase->price_paid, 2) }}
                </td>
                <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </section>

</div>
@endsection
