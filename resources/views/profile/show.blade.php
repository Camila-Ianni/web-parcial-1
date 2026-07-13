@extends('layouts.app')

@section('title', 'Mi Perfil - Mean Girls')

@section('content')
<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
  <div style="text-align: center; margin-bottom: 30px;">
    <span style="font-size: 13px; font-weight: 900; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 4px;">✦ My Profile ✦</span>
    <h1 style="font-family: 'Playfair Display', serif; font-style: italic; color: #222; font-size: 36px; margin: 0;">Mi Perfil</h1>
  </div>

  @if(session('status'))
    <div style="background-color: #e6fffa; color: #00875a; padding: 12px 18px; border-radius: 16px; border: 2px solid var(--hot-pink); margin-bottom: 25px; font-weight: bold; font-size: 14px; text-align: left; display: flex; align-items: center; gap: 8px;">
      <span>✨</span> {{ session('status') }}
    </div>
  @endif

  @if($errors->any())
    <div style="background-color: #fff5f5; color: #e53e3e; padding: 12px 18px; border-radius: 16px; border: 2px solid var(--hot-pink); margin-bottom: 25px; font-weight: bold; font-size: 14px; text-align: left;">
      @foreach($errors->all() as $error)
        <p style="margin: 0; display: flex; align-items: center; gap: 8px;"><span>❌</span> {{ $error }}</p>
      @endforeach
    </div>
  @endif

  <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: start; flex-wrap: wrap;">
    
    <!-- Left column: Personal Details Form -->
    <div style="background: white; border-radius: 24px; padding: 24px; border: 2px solid var(--hot-pink); box-shadow: 0 10px 25px rgba(255, 79, 163, 0.05);">
      <h3 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 22px; margin-bottom: 15px; border-bottom: 2px dashed var(--soft-pink); padding-bottom: 8px;">Datos Personales</h3>
      
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="text-align: center; margin-bottom: 20px;">
          @if($user->profile_image)
            <img src="{{ asset($user->profile_image) }}" alt="Foto de perfil" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--hot-pink); display: block; margin: 0 auto 10px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
          @else
            <div style="width: 100px; height: 100px; border-radius: 50%; background: #ffd3e7; color: var(--hot-pink); font-size: 36px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; border: 3px solid var(--hot-pink); box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
              👤
            </div>
          @endif
          
          <label for="profile_image" style="display: inline-block; padding: 6px 12px; background: var(--soft-pink); color: var(--hot-pink); border-radius: 20px; font-size: 11px; font-weight: bold; cursor: pointer; border: 1px solid var(--hot-pink);">
            Subir Foto 📸
          </label>
          <input type="file" name="profile_image" id="profile_image" style="display: none;" onchange="document.getElementById('profile-image-changed-msg').style.display='block';">
          <span id="profile-image-changed-msg" style="display: none; font-size: 11px; color: #00875a; font-weight: bold; margin-top: 4px;">Imagen seleccionada</span>
        </div>

        <div style="margin-bottom: 15px; text-align: left;">
          <label for="name" style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 6px; letter-spacing: 0.05em;">Nombre</label>
          <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 10px 14px; border: 2px solid #ffd3e7; border-radius: 12px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <div style="margin-bottom: 15px; text-align: left;">
          <label for="email" style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 6px; letter-spacing: 0.05em;">Email</label>
          <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 10px 14px; border: 2px solid #ffd3e7; border-radius: 12px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <div style="margin-bottom: 15px; text-align: left;">
          <label for="password" style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 2px; letter-spacing: 0.05em;">Nueva Contraseña</label>
          <span style="font-size: 10px; color: #999; display: block; margin-bottom: 6px;">(Dejar en blanco si no deseas cambiarla)</span>
          <input type="password" name="password" id="password" placeholder="Mínimo 6 caracteres" style="width: 100%; padding: 10px 14px; border: 2px solid #ffd3e7; border-radius: 12px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <div style="margin-bottom: 20px; text-align: left;">
          <label for="password_confirmation" style="display: block; font-size: 11px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 6px; letter-spacing: 0.05em;">Confirmar Contraseña</label>
          <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite la contraseña" style="width: 100%; padding: 10px 14px; border: 2px solid #ffd3e7; border-radius: 12px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, var(--hot-pink) 0%, #ff7bb5 100%); color: white; border: none; border-radius: 50px; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; box-shadow: 0 5px 15px rgba(255, 79, 163, 0.2); transition: 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
          Guardar Cambios 💾
        </button>
      </form>
    </div>

    <!-- Right column: Orders History -->
    <div style="background: white; border-radius: 24px; padding: 24px; border: 2px solid var(--hot-pink); box-shadow: 0 10px 25px rgba(255, 79, 163, 0.05);">
      <h3 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 22px; margin-bottom: 15px; border-bottom: 2px dashed var(--soft-pink); padding-bottom: 8px;">Mis Pedidos</h3>
      
      @if($user->orders->isEmpty())
        <div style="text-align: center; padding: 50px 30px; color: #888; background: #fffcfd; border-radius: 20px; border: 2px dashed #ffd3e8;">
          <span style="font-size: 48px; display: block; margin-bottom: 10px;">📦</span>
          <p style="font-size: 15px; font-weight: bold; color: var(--dark-magenta); margin-bottom: 4px;">Sin compras por el momento</p>
          <p style="font-size: 12px; color: #999;">Cuando compres outfits de la tienda, podrás ver los detalles de tu orden aquí.</p>
        </div>
      @else
        <div style="display: flex; flex-direction: column; gap: 20px;">
          @foreach($user->orders as $order)
            <div style="background: #fffbfe; border: 1px solid #ffe3f0; border-radius: 16px; padding: 16px; border-left: 5px solid @if($order->status === 'paid') #10b981 @elseif($order->status === 'failed') #ef4444 @else #f59e0b @endif ; box-shadow: 0 4px 15px rgba(255, 79, 163, 0.02);">
              
              <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #ffd3e8; padding-bottom: 8px; margin-bottom: 10px; flex-wrap: wrap; gap: 6px;">
                <div>
                  <strong style="color: var(--dark-magenta); font-size: 14px;">Pedido #{{ $order->id }}</strong>
                  <span style="font-size: 11px; color: #888; margin-left: 8px;">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div>
                  @if($order->status === 'paid')
                    <span style="background: #d1fae5; color: #065f46; font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: 20px; text-transform: uppercase;">Pagado ✨</span>
                  @elseif($order->status === 'failed')
                    <span style="background: #fee2e2; color: #991b1b; font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: 20px; text-transform: uppercase;">Error ❌</span>
                  @else
                    <span style="background: #fef3c7; color: #92400e; font-size: 10px; font-weight: 800; padding: 3px 10px; border-radius: 20px; text-transform: uppercase;">Pendiente ⏳</span>
                  @endif
                </div>
              </div>

              <div style="font-size: 12px; color: #666; margin-bottom: 8px; line-height: 1.4;">
                <p>📍 <strong>Envío:</strong> {{ $order->shipping_address }}</p>
                <p>📞 <strong>Teléfono:</strong> {{ $order->contact_phone }}</p>
              </div>

              <div style="background: white; border-radius: 8px; border: 1px solid #f9ebf1; padding: 10px; margin-bottom: 8px;">
                @foreach($order->items as $item)
                  <div style="display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 4px;">
                    <span style="color: #333;">👗 {{ $item->product->name }} <span style="color: #888;">(x{{ $item->quantity }})</span></span>
                    <span style="color: var(--hot-pink); font-weight: bold;">${{ number_format($item->price * $item->quantity, 2) }}</span>
                  </div>
                @endforeach
              </div>

              <div style="text-align: right; font-size: 13px;">
                <span style="color: #666; font-weight: 600;">Total:</span>
                <span style="font-size: 16px; font-weight: 900; color: var(--hot-pink);">${{ number_format($order->total_price, 2) }}</span>
              </div>

            </div>
          @endforeach
        </div>
      @endif
    </div>

  </div>
</div>
@endsection
