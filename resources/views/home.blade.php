@extends('layouts.app')

@section('title', 'Mean Girls Shop - Home')

@push('page-styles')
<style>
/* --- HERO SECTION --- */
.hero {
  text-align: center;
  padding-top: 40px;
  position: relative;
  z-index: 10;
}

.badge-on {
  background: var(--hot-pink);
  color: white;
  padding: 2px 12px;
  border-radius: 10px;
  font-weight: bold;
  font-size: 14px;
  display: inline-block;
}

.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 120px;
  color: white;
  line-height: 0.8;
  letter-spacing: -2px;
  text-shadow: 4px 4px 0px rgba(255, 192, 203, 0.5);
  margin-top: 10px;
}

.hero .script {
  font-family: 'Parisienne', cursive;
  font-size: 70px;
  color: var(--hot-pink);
  position: absolute;
  top: 140px;
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  text-shadow: 2px 2px 0 white;
}

/* --- PRODUCT SECTION --- */
.main-container {
  max-width: 1000px;
  margin: 0 auto;
  position: relative;
  height: 950px;
}

/* FETCH SELLERS - Con margen extra para despegar del titulo */
.fetch-sellers {
  background: var(--soft-pink);
  color: var(--hot-pink);
  padding: 10px 30px;
  border-radius: 25px;
  width: fit-content;
  margin: 100px auto 50px;
  border: 1px solid var(--hot-pink);
  font-weight: bold;
  display: block;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  transition: transform 0.2s;
}

.fetch-sellers:hover { transform: scale(1.05); }

/* --- CARDS (Inclinadas y limpias) --- */
.card {
  position: absolute;
  background: rgba(255, 255, 255, 0.4);
  border: 2px solid var(--hot-pink);
  border-radius: 25px;
  padding: 10px;
  overflow: visible;
}

.card.polo {
  width: 260px;
  height: 310px;
  top: 180px;
  left: 100px;
  transform: rotate(4deg);
  z-index: 5;
}

.card.cardigan {
  width: 290px;
  height: 340px;
  top: 440px;
  right: 120px;
  transform: rotate(-4deg);
  z-index: 6;
}

/* --- PNGs (Rotacion contraria para desborde dinamico) --- */
.card img {
  width: 155%;
  height: auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-8deg);
  filter: drop-shadow(15px 15px 25px rgba(0,0,0,0.15));
  z-index: 1;
}

/* --- PRODUCT LABELS --- */
.product-label {
  position: absolute;
  font-family: 'Playfair Display', serif;
  font-style: italic;
  color: var(--hot-pink);
  z-index: 20;
}

.product-label b {
  background: var(--hot-pink);
  color: white;
  padding: 3px 10px;
  border-radius: 12px;
  font-size: 12px;
  font-style: normal;
  display: inline-block;
  margin-top: 8px;
  box-shadow: 0 4px 10px rgba(255, 79, 163, 0.2);
}

/* --- CATEGORIES --- */
.categories {
  position: absolute;
  top: 160px;
  right: 80px;
  display: flex;
  gap: 25px;
}

.cat-item {
  text-align: center;
  color: #b03060;
  font-weight: bold;
  font-family: 'Playfair Display', serif;
  font-size: 14px;
}

.circle {
  width: 90px; height: 90px;
  border-radius: 50%;
  border: 1px solid var(--hot-pink);
  background-size: cover;
  background-position: center;
  margin-bottom: 8px;
  box-shadow: inset 0 0 0 1000px rgba(255, 182, 193, 0.4);
}

/* --- FOOTER --- */
.footer-cta {
  position: absolute;
  bottom: 50px;
  left: 50px;
}

.footer-cta h2 {
  font-family: 'Inter', sans-serif;
  font-weight: 900;
  font-style: italic;
  font-size: 45px;
  color: var(--hot-pink);
  line-height: 1;
}

.footer-cta p {
  color: #888;
  font-style: italic;
  font-size: 13px;
  margin-top: 10px;
}
</style>
@endpush

@section('content')
<section class="hero">
  <div class="badge-on">ON</div>
  <h1>WEDNESDAYS</h1>
  <div class="script">We Wear Pink</div>
</section>

<div class="main-container">

  <a href="{{ route('products.index') }}" class="fetch-sellers">Fetch-sellers</a>

  <div class="categories">
    <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/sleeves.jpg') }}')"></div>Sleeves</div>
    <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/tops.jpg') }}')"></div>Tops</div>
    <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/bottoms.jpg') }}')"></div>Bottoms</div>
  </div>

  <div class="card polo">
    <img src="{{ asset('img/shirt.png') }}" alt="Plaid Polo">
  </div>
  <p class="product-label" style="top: 520px; left: 110px;">
    Plaid Buttoned-up Polo <br>
    <b>$8,100</b>
  </p>

  <div class="card cardigan">
    <img src="{{ asset('img/cardigan.png') }}" alt="Ribbon Cardigan">
  </div>
  <p class="product-label" style="top: 820px; right: 140px; text-align: right;">
    Ribbon Cardigan <br>
    <b>$1,600</b>
  </p>

  <div class="footer-cta">
    <h2>DRESS-UP AND<br>DREAM BIG ➔</h2>
    <p>disguised as someone else who<br>is not you, but is still hot!</p>
  </div>

</div>
@endsection
