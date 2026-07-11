@extends('layouts.app')

@section('title', 'Finalizar Compra - Mean Girls')

@section('content')
<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
  <div style="text-align: center; margin-bottom: 30px;">
    <span style="font-size: 13px; font-weight: 900; color: var(--hot-pink); text-transform: uppercase; letter-spacing: 0.15em; display: block; margin-bottom: 4px;">✦ Checkout ✦</span>
    <h1 style="font-family: 'Playfair Display', serif; font-style: italic; color: #222; font-size: 36px; margin: 0;">Finalizar Compra</h1>
  </div>

  @if($errors->any())
    <div style="background-color: #fff5f5; color: #e53e3e; padding: 15px; border-radius: 16px; border: 2px solid var(--hot-pink); margin-bottom: 25px; font-weight: bold; font-size: 14px;">
      @foreach($errors->all() as $error)
        <p style="margin: 0; display: flex; align-items: center; gap: 8px;"><span>❌</span> {{ $error }}</p>
      @endforeach
    </div>
  @endif

  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: start; flex-wrap: wrap;">
    
    <!-- Left column: Order Summary -->
    <div class="card-frame" style="background: white; border-radius: 24px; padding: 24px; border: 2px solid var(--hot-pink); box-shadow: 0 10px 25px rgba(255, 79, 163, 0.05);">
      <h3 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 22px; margin-bottom: 15px; border-bottom: 2px dashed var(--soft-pink); padding-bottom: 8px;">Resumen de tu Pedido</h3>
      
      <div style="display: flex; flex-direction: column; gap: 12px; max-height: 250px; overflow-y: auto; padding-right: 5px;">
        @foreach($summary['items'] as $item)
          <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; padding-bottom: 10px; border-bottom: 1px solid #f9ebf1;">
            <div>
              <strong style="color: #333;">{{ $item['name'] }}</strong>
              <div style="color: #777; font-size: 11px;">Cant: {{ $item['quantity'] }}</div>
            </div>
            <div style="font-weight: bold; color: var(--hot-pink);">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
          </div>
        @endforeach
      </div>

      <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; font-size: 18px; font-weight: 900; color: #333; background: var(--soft-pink); padding: 12px; border-radius: 12px;">
        <span style="color: var(--hot-pink);">Total a Pagar</span>
        <span style="color: var(--hot-pink);">${{ number_format($summary['total'], 2) }}</span>
      </div>
    </div>

    <!-- Right column: Shipping Info -->
    <div style="background: white; border-radius: 24px; padding: 24px; border: 2px solid var(--hot-pink); box-shadow: 0 10px 25px rgba(255, 79, 163, 0.05);">
      <h3 style="font-family: 'Playfair Display', serif; font-style: italic; color: var(--hot-pink); font-size: 22px; margin-bottom: 15px; border-bottom: 2px dashed var(--soft-pink); padding-bottom: 8px;">Datos de Envío</h3>
      
      <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 16px; text-align: left;">
          <label for="shipping_address" style="display: block; font-size: 12px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 6px; letter-spacing: 0.05em;">Dirección de Envío</label>
          <input type="text" name="shipping_address" id="shipping_address" placeholder="Ej: Av. del Libertador 1234, CABA" value="{{ old('shipping_address') }}" required style="width: 100%; padding: 12px 16px; border: 2px solid #ffd3e7; border-radius: 14px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <div style="margin-bottom: 24px; text-align: left;">
          <label for="contact_phone" style="display: block; font-size: 12px; font-weight: bold; text-transform: uppercase; color: #555; margin-bottom: 6px; letter-spacing: 0.05em;">Teléfono de Contacto</label>
          <input type="text" name="contact_phone" id="contact_phone" placeholder="Ej: +54 11 5555-5555" value="{{ old('contact_phone') }}" required style="width: 100%; padding: 12px 16px; border: 2px solid #ffd3e7; border-radius: 14px; font-family: inherit; font-size: 13px; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--hot-pink)'" onblur="this.style.borderColor='#ffd3e7'">
        </div>

        <button type="submit" style="width: 100%; padding: 14px; background: linear-gradient(135deg, var(--hot-pink) 0%, #ff7bb5 100%); color: white; border: none; border-radius: 50px; font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; box-shadow: 0 8px 20px rgba(255, 79, 163, 0.3); transition: 0.3s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
          Pagar con MercadoPago 💳
        </button>
      </form>
    </div>

  </div>
</div>
@endsection
