@extends('admin.layout')

@section('title', 'Ficha del Miembro')

@section('content')
<div class="top-row" style="margin-bottom: 20px;">
  <div>
    <span style="font-size: 13px; font-weight: 900; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 4px;">✦ Profile Details ✦</span>
    <h1 style="margin-bottom: 0;">Ficha del Miembro</h1>
  </div>
</div>

<div class="tabs">
  <a class="btn" href="{{ route('admin.dashboard') }}">Dashboard</a>
  <a class="btn" href="{{ route('admin.users.index') }}">← Volver a la lista</a>
</div>

@if (session('status'))
  <div style="background-color: #e6fffa; color: #00875a; padding: 12px 18px; border-radius: 8px; border: 1px solid #ffd3e8; margin-top: 15px; font-weight: bold; font-size: 14px; text-align: left; display: flex; align-items: center; gap: 8px;">
    <span>✨</span> {{ session('status') }}
  </div>
@endif

@if ($errors->any())
  <div style="background-color: #fff5f5; color: #e53e3e; padding: 12px 18px; border-radius: 8px; border: 1px solid #ffd3e8; margin-top: 15px; font-weight: bold; font-size: 14px; text-align: left;">
    @foreach ($errors->all() as $error)
      <p style="margin: 0; display: flex; align-items: center; gap: 8px;"><span>❌</span> {{ $error }}</p>
    @endforeach
  </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 28px; margin-top: 15px; align-items: start;">
  
  <!-- Left Side: Profile Polaroid Card -->
  <div style="display: flex; flex-direction: column; gap: 20px;">
    <!-- Polaroid Frame -->
    <section class="panel" style="background: white; padding: 20px 20px 30px; text-align: center; border: 1px solid #ffd3e8; box-shadow: 0 10px 30px rgba(255, 79, 163, 0.08); border-radius: 12px;">
      <!-- Simulated Profile Photo / Silhouette -->
      <div style="width: 100%; aspect-ratio: 1; background: radial-gradient(circle, #fff3f8 0%, #fde6ef 100%); border: 1px solid #ffd3e8; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 80px; margin-bottom: 18px; position: relative; overflow: hidden;">
        💅
        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(255, 79, 163, 0.1); padding: 4px; font-size: 11px; font-weight: bold; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.1em;">
          @if($user->is_admin) Admin @else Member @endif
        </div>
      </div>
      <h2 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--dark-magenta); margin-bottom: 4px; font-size: 24px;">
        {{ $user->name }}
      </h2>
      <p style="font-size: 13px; color: #888; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; font-family: 'Inter', sans-serif;">
        {{ $user->email }}
      </p>
    </section>

    <!-- Info Detail panel -->
    <section class="panel" style="padding: 20px;">
      <h3 style="font-size: 14px; font-weight: bold; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px; border-bottom: 1px solid var(--soft-pink); padding-bottom: 6px;">Metadatos</h3>
      <div style="display: flex; flex-direction: column; gap: 10px; font-size: 13px;">
        <div style="display: flex; justify-content: space-between;">
          <span style="color: #888; font-weight: bold;">Rango:</span>
          <span style="font-weight: bold; color: var(--dark-magenta);">
            @if($user->is_admin) Administradora @else Miembro Activo @endif
          </span>
        </div>
        <div style="display: flex; justify-content: space-between;">
          <span style="color: #888; font-weight: bold;">Miembro desde:</span>
          <span style="color: #555;">{{ $user->created_at->format('d/m/Y') }}</span>
        </div>
      </div>
      
      <div style="margin-top: 20px; border-top: 1px solid var(--soft-pink); padding-top: 15px; text-align: center;">
        <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" onsubmit="return confirm('¿Estás segura de que deseas cambiar el rol de este usuario?');">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn" style="width: 100%; justify-content: center; background-color: var(--dark-magenta); color: white; border-color: var(--dark-magenta); font-weight: bold; cursor: pointer;">
            @if($user->is_admin)
              💅 Cambiar a Miembro Común
            @else
              👑 Hacer Administradora
            @endif
          </button>
        </form>
      </div>
    </section>
  </div>

  <!-- Right Side: Purchases Table -->
  <section class="panel" style="border-top: 6px solid var(--hot-pink);">
    <h2 style="font-size: 20px; font-family: 'Playfair Display', serif; font-style: italic; color: var(--dark-magenta); margin-bottom: 18px; border-bottom: 1px solid var(--soft-pink); padding-bottom: 8px; display: flex; align-items: center; gap: 8px;">
      <span>🛍️</span> Compras & Servicios Contratados
    </h2>
    
    @if($user->purchases->isEmpty())
      <div style="text-align: center; padding: 60px 40px; color: #888; background: #fffcfd; border-radius: 20px; border: 2px dashed #ffd3e8;">
        <span style="font-size: 54px; display: block; margin-bottom: 12px; filter: grayscale(0.2);">🛍️</span>
        <p style="font-size: 16px; font-weight: bold; color: var(--dark-magenta); margin-bottom: 4px;">Sin compras por el momento</p>
        <p style="font-size: 13px; color: #999;">Este miembro todavía no ha comprado outfits ni contratado servicios de estilismo.</p>
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
                <td style="font-weight: bold; color: #888;">#{{ $purchase->id }}</td>
                <td>
                  <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- Small Thumbnail simulation -->
                    <div style="width: 32px; height: 32px; border-radius: 6px; background: var(--soft-pink); display: flex; align-items: center; justify-content: center; font-size: 14px;">
                      👗
                    </div>
                    <strong style="color: var(--ink);">{{ $purchase->product->name }}</strong>
                  </div>
                </td>
                <td>
                  <span style="font-size: 12px; font-weight: bold; color: #666; background: #f1f5f9; padding: 2px 8px; border-radius: 6px;">
                    {{ $purchase->product->category }}
                  </span>
                </td>
                <td style="font-weight: 900; color: var(--hot-pink); font-size: 15px;">
                  ${{ number_format($purchase->price_paid, 2) }}
                </td>
                <td style="color: #777; font-size: 13px;">{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <!-- Total Spend badge -->
      <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
        <div style="background: var(--soft-pink); border: 1px solid var(--hot-pink); padding: 10px 20px; border-radius: 16px; text-align: right;">
          <span style="font-size: 11px; font-weight: bold; text-transform: uppercase; color: var(--dark-magenta); letter-spacing: 0.05em; display: block; margin-bottom: 2px;">Inversión Total en Estilo</span>
          <span style="font-size: 22px; font-weight: 900; color: var(--hot-pink);">
            ${{ number_format($user->purchases->sum('price_paid'), 2) }}
          </span>
        </div>
      </div>
    @endif
  </section>

</div>
@endsection
