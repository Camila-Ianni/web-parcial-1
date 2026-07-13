@extends('layouts.app')

@section('title', '¡Compra Exitosa! - Mean Girls')

@section('content')
<div style="max-width: 600px; margin: 50px auto; padding: 0 20px;">
  <div style="background: white; border-radius: 30px; border: 3px solid var(--hot-pink); padding: 40px 30px; text-align: center; box-shadow: 0 15px 35px rgba(255, 79, 163, 0.1);">
    
    <div style="font-size: 64px; margin-bottom: 15px; filter: drop-shadow(0 5px 10px rgba(255, 79, 163, 0.25));">👑</div>
    
    <h1 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 32px; margin-bottom: 8px;">¡That's So Fetch!</h1>
    <h2 style="font-size: 18px; color: #222; font-weight: 900; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.05em;">Tu compra se ha registrado con éxito</h2>

    @if($isFallback)
      <div style="background: #fff5f5; border: 2px dashed var(--hot-pink); padding: 15px; border-radius: 16px; font-size: 13px; font-weight: bold; color: #d93838; margin-bottom: 25px; line-height: 1.4; text-align: left;">
        💡 <strong>Pago con MercadoPago simulado aprobado:</strong> Se activó la simulación local porque las credenciales (Access Token) configuradas en el archivo <code>.env</code> son inválidas o expiraron. Para ver la interfaz real de MercadoPago, coloca un <code>MERCADOPAGO_ACCESS_TOKEN</code> válido en tu <code>.env</code>.
      </div>
    @endif

    <div style="background: #faf5f8; border-radius: 20px; padding: 20px; margin-bottom: 25px; text-align: left; border: 1px solid #ffe3f0;">
      <h3 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--dark-magenta); margin-bottom: 12px; font-size: 18px; border-bottom: 1px solid #ffd3e8; padding-bottom: 6px;">Detalle del Pedido #{{ $order->id }}</h3>
      
      <p style="font-size: 13px; color: #555; margin-bottom: 8px;">📍 <strong>Dirección de Envío:</strong> {{ $order->shipping_address }}</p>
      <p style="font-size: 13px; color: #555; margin-bottom: 12px;">📞 <strong>Teléfono de Contacto:</strong> {{ $order->contact_phone }}</p>

      <div style="border-top: 1px dashed #ffd3e8; padding-top: 10px; display: flex; flex-direction: column; gap: 8px; font-size: 13px;">
        @foreach($order->items as $item)
          <div style="display: flex; justify-content: space-between;">
            <span style="color: #333;">{{ $item->product->name }} (x{{ $item->quantity }})</span>
            <span style="font-weight: bold; color: var(--hot-pink);">${{ number_format($item->price * $item->quantity, 2) }}</span>
          </div>
        @endforeach
      </div>

      <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ffd3e8; margin-top: 12px; padding-top: 12px; font-size: 16px; font-weight: 900;">
        <span style="color: var(--dark-magenta);">Total Abonado:</span>
        <span style="color: var(--hot-pink);">${{ number_format($order->total_price, 2) }}</span>
      </div>
    </div>

    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
      <a href="{{ route('products.index') }}" style="text-decoration: none; padding: 12px 24px; background: white; border: 2px solid var(--hot-pink); color: var(--hot-pink); border-radius: 50px; font-weight: 900; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; transition: 0.3s;" onmouseover="this.style.background='var(--soft-pink)'" onmouseout="this.style.background='white'">
        Seguir Comprando 🛍️
      </a>
      <a href="{{ route('profile.show') }}" style="text-decoration: none; padding: 12px 24px; background: linear-gradient(135deg, var(--hot-pink) 0%, #ff7bb5 100%); color: white; border-radius: 50px; font-weight: 900; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; box-shadow: 0 5px 15px rgba(255, 79, 163, 0.2); transition: 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
        Ver mi Historial 👤
      </a>
    </div>

  </div>
</div>
@endsection
