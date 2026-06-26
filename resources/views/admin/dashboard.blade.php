@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
  <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
    <div>
      <span style="font-size: 13px; font-weight: 900; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 4px;">✦ Panel Editorial ✦</span>
      <h1 style="margin-bottom: 0;">Dashboard</h1>
    </div>
    <div style="background: rgba(255, 79, 163, 0.1); border: 1px solid rgba(255, 79, 163, 0.2); padding: 8px 16px; border-radius: 16px; font-size: 13px; font-weight: bold; color: var(--dark-magenta);">
      👑 Plastic in Chief: <strong style="color: var(--hot-pink);">{{ auth()->user()->name }}</strong>
    </div>
  </div>

  <!-- Grid of Metrics and Controls -->
  <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    
    <!-- Blog Section Card -->
    <section class="panel" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 6px solid var(--bubblegum);">
      <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <h2>Gossip & Blog</h2>
          <span style="font-size: 28px;">📝</span>
        </div>
        <p style="font-size: 14px; color: #666; margin-bottom: 16px; line-height: 1.5;">
          Redacta los chismes de moda y las novedades semanales. Todas las entradas se muestran de forma dinámica en la web pública.
        </p>
        <div style="background: var(--soft-pink); border-radius: 12px; padding: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <span style="font-size: 13px; font-weight: 800; color: var(--dark-magenta);">Notas Publicadas</span>
          <span style="font-size: 20px; font-weight: 900; color: var(--hot-pink);">{{ $postsCount }}</span>
        </div>
      </div>
      <div class="tabs" style="margin-top: auto; margin-bottom: 0;">
        <a class="btn" style="flex: 1;" href="{{ route('admin.posts.index') }}">Gestionar</a>
        <a class="btn primary" href="{{ route('admin.posts.create') }}">Nuevo</a>
      </div>
    </section>

    <!-- Outfits Section Card -->
    <section class="panel" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 6px solid var(--hot-pink);">
      <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <h2>Outfits Catalog</h2>
          <span style="font-size: 28px;">👗</span>
        </div>
        <p style="font-size: 14px; color: #666; margin-bottom: 16px; line-height: 1.5;">
          Administra la colección de outfits, stock de prendas y precios para el lookbook de la tienda.
        </p>
        <div style="background: var(--soft-pink); border-radius: 12px; padding: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <span style="font-size: 13px; font-weight: 800; color: var(--dark-magenta);">Total Outfits</span>
          <span style="font-size: 20px; font-weight: 900; color: var(--hot-pink);">{{ $productsCount }}</span>
        </div>
      </div>
      <div class="tabs" style="margin-top: auto; margin-bottom: 0;">
        <a class="btn" style="flex: 1;" href="{{ route('admin.products.index') }}">Gestionar</a>
        <a class="btn primary" href="{{ route('admin.products.create') }}">Nuevo</a>
      </div>
    </section>

    <!-- Users Section Card -->
    <section class="panel" style="display: flex; flex-direction: column; justify-content: space-between; border-top: 6px solid var(--dark-magenta);">
      <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <h2>Membresías & Users</h2>
          <span style="font-size: 28px;">💕</span>
        </div>
        <p style="font-size: 14px; color: #666; margin-bottom: 16px; line-height: 1.5;">
          Verifica la base de usuarios registrados, roles activos, y los servicios contratados o compras de outfits realizadas.
        </p>
        <div style="background: var(--soft-pink); border-radius: 12px; padding: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <span style="font-size: 13px; font-weight: 800; color: var(--dark-magenta);">Usuarios Registrados</span>
          <span style="font-size: 20px; font-weight: 900; color: var(--hot-pink);">{{ $usersCount }}</span>
        </div>
      </div>
      <div class="tabs" style="margin-top: auto; margin-bottom: 0;">
        <a class="btn primary" style="flex: 1;" href="{{ route('admin.users.index') }}">Ver Miembros</a>
      </div>
    </section>
  </div>

  <!-- Y2K Interactive elements -->
  <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 24px;">
    <!-- Rules Box -->
    <section class="panel">
      <h2 style="font-size: 20px; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
        <span>💅</span> Reglas del Burn Book de la Moda (Wednesday Rules)
      </h2>
      <ul style="list-style-type: none; display: flex; flex-direction: column; gap: 12px; font-size: 14px; line-height: 1.4;">
        <li style="display: flex; gap: 10px; align-items: flex-start; background: #fffcfd; padding: 10px 14px; border-radius: 12px; border-left: 4px solid var(--hot-pink);">
          <span style="color: var(--hot-pink); font-weight: bold;">1.</span>
          <span><strong>Only Pink on Wednesdays:</strong> Asegúrate de que las fotos de tus posts destaquen colores vivos y glamorosos.</span>
        </li>
        <li style="display: flex; gap: 10px; align-items: flex-start; background: #fffcfd; padding: 10px 14px; border-radius: 12px; border-left: 4px solid var(--bubblegum);">
          <span style="color: var(--bubblegum); font-weight: bold;">2.</span>
          <span><strong>Upload High-Quality Pics:</strong> En la sección del blog, sube archivos reales (`.png`, `.jpg`) usando la nueva funcionalidad de carga del ABM.</span>
        </li>
        <li style="display: flex; gap: 10px; align-items: flex-start; background: #fffcfd; padding: 10px 14px; border-radius: 12px; border-left: 4px solid var(--dark-magenta);">
          <span style="color: var(--dark-magenta); font-weight: bold;">3.</span>
          <span><strong>Check User Services:</strong> Supervisa el listado para ver qué usuario tiene contratado el servicio VIP o compras del lookbook.</span>
        </li>
      </ul>
    </section>

    <!-- Side Sticker box -->
    <section class="panel" style="background: radial-gradient(circle, #fff7fa 0%, #ffeaf4 100%); text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px;">
      <div style="font-size: 48px; margin-bottom: 8px; filter: drop-shadow(2px 4px 6px rgba(255, 79, 163, 0.25)); transform: rotate(-5deg);">💖</div>
      <p style="font-family: 'Parisienne', cursive; font-size: 32px; color: var(--hot-pink); line-height: 1.1;">You're Like, Really Pretty.</p>
      <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #888; font-weight: bold; margin-top: 6px;">Editorial Sticker</p>
    </section>
  </div>
@endsection
