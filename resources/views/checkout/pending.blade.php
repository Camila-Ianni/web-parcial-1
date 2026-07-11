@extends('layouts.app')

@section('title', 'Pago Pendiente - Mean Girls')

@section('content')
<div style="max-width: 600px; margin: 50px auto; padding: 0 20px;">
  <div style="background: white; border-radius: 30px; border: 3px solid var(--hot-pink); padding: 40px 30px; text-align: center; box-shadow: 0 15px 35px rgba(255, 79, 163, 0.1);">
    
    <div style="font-size: 64px; margin-bottom: 15px; filter: drop-shadow(0 5px 10px rgba(255, 79, 163, 0.25));">⏳</div>
    
    <h1 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 32px; margin-bottom: 8px;">Is Butter a Carb?</h1>
    <h2 style="font-size: 18px; color: #222; font-weight: 900; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.05em;">Tu pago está pendiente de aprobación</h2>

    <p style="font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.5;">El pago del pedido #{{ $order->id }} está siendo procesado por MercadoPago. En cuanto se confirme la acreditación, actualizaremos el estado en tu perfil.</p>

    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
      <a href="{{ route('products.index') }}" style="text-decoration: none; padding: 12px 24px; background: white; border: 2px solid var(--hot-pink); color: var(--hot-pink); border-radius: 50px; font-weight: 900; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; transition: 0.3s;" onmouseover="this.style.background='var(--soft-pink)'" onmouseout="this.style.background='white'">
        Ver Catálogo 🛍️
      </a>
      <a href="{{ route('profile.show') }}" style="text-decoration: none; padding: 12px 24px; background: linear-gradient(135deg, var(--hot-pink) 0%, #ff7bb5 100%); color: white; border-radius: 50px; font-weight: 900; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; box-shadow: 0 5px 15px rgba(255, 79, 163, 0.2); transition: 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
        Ver mi Historial 👤
      </a>
    </div>

  </div>
</div>
@endsection
