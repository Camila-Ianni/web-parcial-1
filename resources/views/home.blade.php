@extends('layouts.app')

@section('title', 'Mean Girls Shop - Home')

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Caveat:wght@700&family=Permanent+Marker&family=Special+Elite&display=swap');

:root {
  --bubblegum: #ff85be;
  --dark-magenta: #701040;
}

/* --- BODY BACKGROUND OVERRIDE --- */
body {
  background-color: #fffcfd !important;
  background-image: 
    linear-gradient(rgba(255, 79, 163, 0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 79, 163, 0.05) 1px, transparent 1px) !important;
  background-size: 20px 20px !important;
}

/* --- NOTEBOOK SPREAD LAYOUT --- */
.notebook-spread {
  position: relative;
  padding: 40px 20px;
  margin: 0 auto;
  max-width: 1100px;
}

.notebook-spread::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0; left: 80px;
  width: 2px;
  background: rgba(255, 79, 163, 0.25);
  pointer-events: none;
  z-index: 2;
}

/* --- HERO SECTION --- */
.hero {
  text-align: center;
  padding: 30px 0 20px;
  position: relative;
  z-index: 10;
}

.badge-on {
  background: var(--hot-pink);
  color: white;
  padding: 4px 16px;
  border-radius: 12px;
  font-family: 'Permanent Marker', cursive;
  font-size: 16px;
  display: inline-block;
  transform: rotate(-5deg);
  box-shadow: 2px 4px 8px rgba(255, 79, 163, 0.25);
}

/* RANSOM WORDS FOR THE HERO */
.hero-ransom-word {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 8px;
  margin: 25px auto 15px;
  filter: drop-shadow(4px 8px 12px rgba(0,0,0,0.18));
  max-width: 90%;
}

.hero-ransom-letter {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 75px;
  height: 100px;
  font-weight: 900;
  font-size: 55px;
  text-transform: uppercase;
  user-select: none;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.hero-ransom-letter:hover {
  transform: translateY(-8px) scale(1.15) rotate(0deg) !important;
  z-index: 10;
}

.hero-ransom-letter:nth-child(1) { transform: rotate(-6deg); }
.hero-ransom-letter:nth-child(2) { transform: rotate(4deg); }
.hero-ransom-letter:nth-child(3) { transform: rotate(-5deg); }
.hero-ransom-letter:nth-child(4) { transform: rotate(7deg); }
.hero-ransom-letter:nth-child(5) { transform: rotate(-3deg); }
.hero-ransom-letter:nth-child(6) { transform: rotate(5deg); }
.hero-ransom-letter:nth-child(7) { transform: rotate(-6deg); }
.hero-ransom-letter:nth-child(8) { transform: rotate(4deg); }
.hero-ransom-letter:nth-child(9) { transform: rotate(-3deg); }
.hero-ransom-letter:nth-child(10) { transform: rotate(6deg); }

/* RANSOM FONTS STYLE */
.rl-black-serif {
  background: #121212;
  color: #ffffff;
  font-family: 'Playfair Display', serif;
  font-style: italic;
  clip-path: polygon(4% 6%, 96% 2%, 91% 94%, 8% 90%);
}
.rl-white-sans {
  background: #ffffff;
  color: #121212;
  font-family: 'Inter', sans-serif;
  border: 2px solid #121212;
  clip-path: polygon(10% 2%, 92% 8%, 95% 92%, 3% 97%);
}
.rl-black-mono {
  background: #121212;
  color: #ffffff;
  font-family: 'Special Elite', monospace;
  clip-path: polygon(2% 10%, 98% 3%, 89% 95%, 7% 92%);
}
.rl-white-marker {
  background: #ffffff;
  color: #121212;
  font-family: 'Permanent Marker', cursive;
  border: 2.5px solid #121212;
  clip-path: polygon(8% 8%, 92% 4%, 97% 91%, 5% 95%);
}
.rl-pink-serif {
  background: var(--hot-pink);
  color: #ffffff;
  font-family: 'Playfair Display', serif;
  clip-path: polygon(5% 12%, 95% 6%, 92% 98%, 10% 88%);
}

.hero .script {
  font-family: 'Parisienne', cursive;
  font-size: 75px;
  color: var(--hot-pink);
  text-shadow: 2px 2px 0 white;
  z-index: 12;
}

/* --- PRODUCT SECTION CONTAINER --- */
.main-container {
  max-width: 1000px;
  margin: 0 auto;
  position: relative;
  height: 980px;
}

/* FETCH SELLERS STICKER */
.fetch-sellers-sticker {
  display: block;
  width: fit-content;
  margin: 80px auto 40px;
  padding: 12px 30px;
  background: var(--hot-pink);
  color: white;
  text-decoration: none;
  font-family: 'Permanent Marker', cursive;
  font-size: 18px;
  border-radius: 50px;
  box-shadow: 0 8px 20px rgba(255, 79, 163, 0.3);
  border: 3px solid white;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  z-index: 25;
}
.fetch-sellers-sticker:hover {
  transform: translateY(-4px) scale(1.06);
  box-shadow: 0 12px 25px rgba(255, 79, 163, 0.45);
  background: var(--dark-magenta);
}

/* --- POLAROID CARDS --- */
.polaroid-card {
  position: absolute;
  background: white;
  border: 1px solid #e2d7c5;
  border-bottom: 30px solid white;
  padding: 12px 12px 6px 12px;
  border-radius: 4px;
  box-shadow: 5px 12px 25px rgba(0,0,0,0.12);
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.polaroid-card:hover {
  transform: scale(1.05) rotate(0deg) !important;
  box-shadow: 8px 20px 40px rgba(255, 79, 163, 0.25);
  z-index: 30;
}

.polaroid-card.polo {
  width: 250px;
  top: 180px;
  left: 100px;
  transform: rotate(-5deg);
  z-index: 5;
}

.polaroid-card.cardigan {
  width: 270px;
  top: 440px;
  right: 120px;
  transform: rotate(4deg);
  z-index: 6;
}

.polaroid-photo-area {
  width: 100%;
  height: 220px;
  background: radial-gradient(circle, #fff0f5 0%, #ffd0e2 100%);
  border-radius: 8px;
  position: relative;
  overflow: hidden;
  border: 1.5px dashed rgba(255, 79, 163, 0.25);
}

.polaroid-hanger {
  position: absolute;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  width: 70px;
  height: 35px;
  opacity: 0.45;
  z-index: 2;
}

.polaroid-photo-area img {
  width: 140%;
  height: auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -42%) rotate(-5deg);
  filter: drop-shadow(8px 12px 18px rgba(0,0,0,0.15));
  z-index: 3;
}

.polaroid-caption {
  width: 100%;
  padding-top: 12px;
  text-align: center;
  font-family: 'Architects Daughter', cursive;
  color: var(--dark-magenta);
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.caption-title {
  font-size: 15px;
  font-weight: 900;
}

.caption-price {
  font-family: 'Permanent Marker', cursive;
  color: var(--hot-pink);
  font-size: 16px;
}

/* SCOTCH TAPE DECORATION */
.tape-deco {
  position: absolute;
  width: 90px;
  height: 25px;
  background: rgba(255, 255, 255, 0.22);
  border-left: 2px dashed rgba(255, 79, 163, 0.25);
  border-right: 2px dashed rgba(255, 79, 163, 0.25);
  box-shadow: 1px 2px 4px rgba(0,0,0,0.03);
  z-index: 10;
}
.tape-deco.top-tape {
  top: -12px;
  left: 50%;
  transform: translateX(-50%) rotate(3deg);
  background: rgba(253, 230, 239, 0.45);
}

/* --- Y2K STICKERS --- */
.y2k-sticker {
  position: absolute;
  font-family: 'Permanent Marker', cursive;
  font-size: 13px;
  padding: 8px 16px;
  border-radius: 6px;
  box-shadow: 2px 5px 10px rgba(0,0,0,0.15);
  text-transform: uppercase;
  z-index: 15;
  transition: all 0.3s;
  user-select: none;
}
.sticker-cant-sit {
  background: #121212;
  color: #ffffff;
  border: 2px dashed var(--hot-pink);
}
.sticker-cant-sit:hover {
  transform: rotate(5deg) scale(1.1) !important;
  background: var(--hot-pink);
  border-color: #ffffff;
}
.sticker-get-in {
  background: var(--hot-pink);
  color: #ffffff;
  border: 2px solid #ffffff;
}
.sticker-get-in:hover {
  transform: rotate(-8deg) scale(1.1) !important;
}
.sticker-sofetch {
  background: #fde6ef;
  color: var(--hot-pink);
  border: 2px solid var(--hot-pink);
}
.sticker-sofetch:hover {
  animation: Y2Kshake 0.3s infinite;
}
@keyframes Y2Kshake {
  0% { transform: rotate(12deg) translate(0, 0); }
  25% { transform: rotate(14deg) translate(-2px, 2px); }
  50% { transform: rotate(10deg) translate(2px, -2px); }
  75% { transform: rotate(13deg) translate(-1px, -1px); }
  100% { transform: rotate(12deg) translate(0, 0); }
}

/* --- STICKY NOTE --- */
.sticky-note {
  position: absolute;
  width: 170px;
  background: #fffdf0;
  border: 1px solid #e8e2b5;
  box-shadow: 4px 8px 15px rgba(0,0,0,0.06);
  padding: 15px;
  border-radius: 2px;
  z-index: 10;
  transition: all 0.3s;
}
.sticky-note:hover {
  transform: rotate(0deg) scale(1.05) !important;
  box-shadow: 6px 12px 20px rgba(0,0,0,0.1);
}
.sticky-pin {
  position: absolute;
  top: -10px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 16px;
  filter: drop-shadow(1px 2px 2px rgba(0,0,0,0.25));
}
.sticky-text {
  font-family: 'Architects Daughter', cursive;
  font-size: 15px;
  color: #443e25;
  text-align: center;
  line-height: 1.2;
}

/* --- CATEGORIES --- */
.categories {
  position: absolute;
  top: 160px;
  right: 80px;
  display: flex;
  gap: 25px;
  z-index: 20;
}

.cat-item {
  text-align: center;
  color: var(--hot-pink);
  font-weight: 800;
  font-family: 'Playfair Display', serif;
  font-size: 14px;
  transition: all 0.3s;
  cursor: pointer;
}

.cat-item:hover {
  transform: scale(1.1) rotate(4deg);
  color: var(--dark-magenta);
}

.circle {
  width: 90px; height: 90px;
  border-radius: 50%;
  border: 2px solid var(--hot-pink);
  background-size: cover;
  background-position: center;
  margin-bottom: 8px;
  box-shadow: inset 0 0 0 1000px rgba(255, 182, 193, 0.3);
  transition: all 0.3s;
}

.cat-item:hover .circle {
  border-color: var(--dark-magenta);
  box-shadow: 0 8px 16px rgba(255, 79, 163, 0.25);
}

/* --- FOOTER CTA --- */
.footer-cta {
  position: absolute;
  bottom: 50px;
  left: 50px;
  background: white;
  border: 2px dashed var(--hot-pink);
  padding: 20px;
  border-radius: 15px;
  box-shadow: 3px 8px 15px rgba(255, 79, 163, 0.1);
  transform: rotate(-2deg);
  z-index: 10;
  transition: all 0.3s;
}
.footer-cta:hover {
  transform: rotate(0deg) scale(1.02);
}

.footer-cta h2 {
  font-family: 'Permanent Marker', cursive;
  font-size: 32px;
  color: var(--hot-pink);
  line-height: 1.1;
  margin-bottom: 8px;
}

.footer-cta p {
  font-family: 'Architects Daughter', cursive;
  color: #666;
  font-size: 14px;
  line-height: 1.3;
}
</style>
@endpush

@section('content')
<div class="notebook-spread">
  <section class="hero">
    <div class="badge-on">ON</div>
    
    <!-- WEDNESDAYS Ransom Word -->
    <div class="hero-ransom-word">
      <span class="hero-ransom-letter rl-black-serif">W</span>
      <span class="hero-ransom-letter rl-white-sans">E</span>
      <span class="hero-ransom-letter rl-black-mono">D</span>
      <span class="hero-ransom-letter rl-white-marker">N</span>
      <span class="hero-ransom-letter rl-pink-serif">E</span>
      <span class="hero-ransom-letter rl-black-serif">S</span>
      <span class="hero-ransom-letter rl-white-sans">D</span>
      <span class="hero-ransom-letter rl-black-mono">A</span>
      <span class="hero-ransom-letter rl-pink-serif">Y</span>
      <span class="hero-ransom-letter rl-white-marker">S</span>
    </div>

    <!-- Hand-drawn style brush stroke under title -->
    <div style="position: relative; display: inline-block;">
      <span class="script">We Wear Pink</span>
      <svg style="position: absolute; bottom: -8px; left: 10%; width: 80%; height: 15px;" viewBox="0 0 100 10" xmlns="http://www.w3.org/2000/svg">
        <path d="M 5,5 Q 50,2 95,6" fill="none" stroke="var(--hot-pink)" stroke-width="3" stroke-linecap="round"/>
      </svg>
    </div>
  </section>

  <div class="main-container">

    <!-- Interactive Doodles & Arrow Vector -->
    <svg class="arrow-doodle" style="position: absolute; top: 110px; left: 190px; width: 60px; height: 60px; transform: rotate(-30deg); z-index: 10;" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
      <path d="M 10,90 Q 30,50 80,20" fill="none" stroke="var(--hot-pink)" stroke-width="4.5" stroke-dasharray="6 3" stroke-linecap="round" />
      <path d="M 55,12 L 83,18 L 73,42" fill="none" stroke="var(--hot-pink)" stroke-width="4.5" stroke-linecap="round" />
    </svg>

    <div class="kiss-doodle" style="position: absolute; top: 25px; right: 280px; transform: rotate(-10deg); width: 75px; height: 45px; pointer-events: none; z-index: 20;">
      <svg viewBox="0 0 100 60" xmlns="http://www.w3.org/2000/svg">
        <path d="M 10 32 Q 30 14 50 24 Q 70 14 90 32 Q 75 44 50 37 Q 25 44 10 32 Z" fill="#ff4fa3" fill-opacity="0.85"/>
        <path d="M 12 35 Q 32 50 50 44 Q 68 50 88 35 Q 73 60 50 52 Q 27 60 12 35 Z" fill="#e03d8d" fill-opacity="0.9"/>
      </svg>
    </div>

    <!-- Y2K Stickers -->
    <div class="y2k-sticker sticker-get-in" style="top: 105px; left: 240px; transform: rotate(10deg);">
      Get In, Loser!
    </div>

    <div class="y2k-sticker sticker-cant-sit" style="top: 260px; right: 480px; transform: rotate(-8deg);">
      You Can't Sit With Us!
    </div>

    <div class="y2k-sticker sticker-sofetch" style="top: 590px; left: 45px; transform: rotate(12deg);">
      That's so fetch!
    </div>

    <!-- Shop CTA button -->
    <a href="{{ route('products.index') }}" class="fetch-sellers-sticker">
      💅 SHOP THE CATALOG ➔
    </a>

    <!-- Categories -->
    <div class="categories" onclick="location.href='{{ route('products.index') }}'">
      <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/sleeves.jpg') }}')"></div>Sleeves</div>
      <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/tops.jpg') }}')"></div>Tops</div>
      <div class="cat-item"><div class="circle" style="background-image:url('{{ asset('img/bottoms.jpg') }}')"></div>Bottoms</div>
    </div>

    <!-- Taped Polaroid 1 -->
    <div class="polaroid-card polo" onclick="location.href='{{ route('products.index') }}'">
      <div class="tape-deco top-tape"></div>
      <div class="polaroid-photo-area">
        <svg viewBox="0 0 100 50" class="polaroid-hanger" xmlns="http://www.w3.org/2000/svg">
          <path d="M 50,15 C 45,15 42,10 42,7 C 42,4 50,1 50,1 C 50,1 58,4 58,7 C 58,10 55,15 50,15 Z" fill="none" stroke="var(--hot-pink)" stroke-width="2" />
          <path d="M 50,7 L 50,15" stroke="var(--hot-pink)" stroke-width="2" />
          <path d="M 22,33 Q 50,22 78,33" stroke="var(--hot-pink)" stroke-width="2.5" fill="none" stroke-linecap="round" />
        </svg>
        <img src="{{ asset('img/shirt.png') }}" alt="Plaid Polo">
      </div>
      <div class="polaroid-caption">
        <span class="caption-title">Plaid Polo</span>
        <span class="caption-price">$8,100</span>
      </div>
    </div>

    <!-- Taped Polaroid 2 -->
    <div class="polaroid-card cardigan" onclick="location.href='{{ route('products.index') }}'">
      <div class="tape-deco top-tape"></div>
      <div class="polaroid-photo-area">
        <svg viewBox="0 0 100 50" class="polaroid-hanger" xmlns="http://www.w3.org/2000/svg">
          <path d="M 50,15 C 45,15 42,10 42,7 C 42,4 50,1 50,1 C 50,1 58,4 58,7 C 58,10 55,15 50,15 Z" fill="none" stroke="var(--hot-pink)" stroke-width="2" />
          <path d="M 50,7 L 50,15" stroke="var(--hot-pink)" stroke-width="2" />
          <path d="M 22,33 Q 50,22 78,33" stroke="var(--hot-pink)" stroke-width="2.5" fill="none" stroke-linecap="round" />
        </svg>
        <img src="{{ asset('img/cardigan.png') }}" alt="Ribbon Cardigan">
      </div>
      <div class="polaroid-caption">
        <span class="caption-title">Ribbon Cardigan</span>
        <span class="caption-price">$1,600</span>
      </div>
    </div>

    <!-- Interactive Sticky Note Easter Egg -->
    <div class="sticky-note" style="top: 720px; left: 420px; transform: rotate(-5deg);">
      <div class="sticky-pin">📌</div>
      <p class="sticky-text">Is butter a carb?</p>
      <div style="display: flex; justify-content: center; gap: 18px; margin-top: 10px; font-family: 'Permanent Marker', cursive; font-size: 15px;">
        <span style="color: var(--hot-pink); cursor: pointer; transition: 0.2s;" onclick="alert('Whatever, I\'m getting cheese fries! 🍟')">✓ Yes</span>
        <span style="color: #666; cursor: pointer; transition: 0.2s;" onclick="alert('Whatever, I\'m getting cheese fries! 🍟')">✗ No</span>
      </div>
    </div>

    <!-- Hand-drawn Star Doodle -->
    <svg class="star-doodle" style="position: absolute; top: 460px; left: 80px; width: 35px; height: 35px; pointer-events: none;" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
      <path d="M 50,10 L 63,38 L 93,38 L 70,55 L 78,85 L 50,68 L 22,85 L 30,55 L 7,38 L 37,38 Z" fill="none" stroke="var(--hot-pink)" stroke-width="5.5" stroke-dasharray="5 2.5" />
    </svg>

    <div class="footer-cta">
      <h2>DRESS-UP AND<br>DREAM BIG ➔</h2>
      <p>disguised as someone else who<br>is not you, but is still hot!</p>
    </div>

  </div>
</div>
@endsection
