@extends('layouts.app')

@section('title', 'The Plastics - Dynamic Lookbook')

@push('page-styles')
<style>
/* --- GALERIA ACTUALIZADA (4 por fila) --- */
#gallery-view {
  padding: 60px 40px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 40px 30px;
  max-width: 1400px;
  margin: 0 auto;
}

.outfit-card {
  position: relative;
  background: rgba(255, 255, 255, 0.75);
  border: 3px solid #ffc2d4;
  border-radius: 28px;
  padding: 16px;
  cursor: pointer;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  text-align: center;
  box-shadow: 0 10px 25px rgba(255, 79, 163, 0.1);
  overflow: visible;
}

.outfit-card::after {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 28px;
  border: 1px solid rgba(255, 255, 255, 0.6);
  pointer-events: none;
}

.outfit-card:nth-child(odd) { transform: rotate(-2deg); }
.outfit-card:nth-child(even) { transform: rotate(2deg); }

.outfit-card:hover {
  transform: scale(1.06) rotate(0deg) !important;
  background: white;
  border-color: var(--hot-pink);
  box-shadow: 0 20px 45px rgba(255, 79, 163, 0.35);
  z-index: 10;
}

.outfit-card img {
  width: 100%;
  border-radius: 18px;
  margin-bottom: 15px;
  border: 2px solid rgba(255, 182, 193, 0.3);
  object-fit: cover;
  transition: transform 0.4s ease;
}

.outfit-card:hover img {
  transform: scale(1.02);
}

.outfit-card h3 {
  font-family: 'Playfair Display', serif;
  color: var(--hot-pink);
  font-style: italic;
  font-size: 20px;
  font-weight: 900;
  margin-top: 5px;
  margin-bottom: 5px;
}

.outfit-card p {
  font-family: 'Architects Daughter', cursive;
  font-size: 13px;
  color: var(--dark-magenta);
  font-weight: bold;
}

/* Y2K Card Stickers */
.card-sticker {
  position: absolute;
  font-family: 'Permanent Marker', cursive;
  font-size: 11px;
  padding: 6px 14px;
  border-radius: 4px;
  box-shadow: 2px 4px 8px rgba(0,0,0,0.15);
  text-transform: uppercase;
  z-index: 5;
  transition: 0.3s;
}

.sticker-sofetch {
  background: #ff007f;
  color: white;
  top: -10px;
  left: -5px;
  transform: rotate(-12deg);
}

.sticker-wednesday {
  background: #ffff33;
  color: black;
  top: -8px;
  right: -5px;
  transform: rotate(10deg);
  border: 2px dashed #000;
}

.sticker-limited {
  background: #b026ff;
  color: white;
  bottom: 25px;
  left: -10px;
  transform: rotate(15deg);
}

.sticker-classic {
  background: #000000;
  color: #00ff00;
  top: -12px;
  left: 20px;
  transform: rotate(-4deg);
}

.sticker-cute {
  background: #ffcc00;
  color: black;
  top: 15px;
  right: -12px;
  transform: rotate(15deg);
}

.sticker-rich {
  background: linear-gradient(135deg, #ffd700, #ffa500);
  color: white;
  border: 1px solid #ff8c00;
  top: -8px;
  left: -8px;
  transform: rotate(-8deg);
}

.sticker-queen {
  background: #ff69b4;
  color: white;
  top: -10px;
  right: 15px;
  transform: rotate(6deg);
}

.sticker-omg {
  background: #00ffff;
  color: black;
  bottom: 20px;
  right: -10px;
  transform: rotate(-15deg);
}

.outfit-card:hover .card-sticker {
  transform: scale(1.1) rotate(0deg);
  box-shadow: 3px 6px 12px rgba(0,0,0,0.25);
}

/* --- NEW DETALLE GRID LAYOUT --- */
#detail-view {
  display: none;
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px 80px;
}

.detail-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 35px;
  border-bottom: 3px double var(--hot-pink);
  padding-bottom: 20px;
  position: relative;
}

.back-btn {
  background: white;
  border: 2px solid var(--hot-pink);
  padding: 10px 24px;
  border-radius: 20px;
  cursor: pointer;
  color: var(--hot-pink);
  font-family: 'Permanent Marker', cursive;
  font-size: 14px;
  box-shadow: 2px 4px 8px rgba(255, 79, 163, 0.15);
  transition: 0.3s;
}

.back-btn:hover {
  background: var(--soft-pink);
  transform: scale(1.05) translateY(-2px);
  box-shadow: 3px 6px 12px rgba(255, 79, 163, 0.25);
}

.outfit-title-y2k {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: var(--dark-magenta);
  font-style: italic;
  font-weight: 900;
  text-shadow: 2px 2px 0px white;
}

.detail-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 40px;
  align-items: start;
}

/* Left Column: Canvas Container */
.canvas-container {
  position: relative;
  background: radial-gradient(circle, #ffe3ec 0%, #ffc5d9 100%);
  border: 4px solid var(--hot-pink);
  border-radius: 40px;
  padding: 20px;
  box-shadow: 0 15px 40px rgba(255, 79, 163, 0.2);
  overflow: hidden;
  height: 650px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.canvas-mirror-glow {
  position: absolute;
  inset: 12px;
  border: 2px dashed rgba(255, 255, 255, 0.7);
  border-radius: 30px;
  pointer-events: none;
}

.interactive-canvas {
  position: relative;
  width: 100%;
  height: 100%;
}

.mannequin-silhouette {
  position: absolute;
  left: 50%;
  top: 40px;
  width: 320px;
  height: 550px;
  transform: translateX(-50%);
  z-index: 1;
  opacity: 0.85;
}

/* Dressing Garments */
.piece {
  position: absolute;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  filter: drop-shadow(0 6px 12px rgba(0,0,0,0.15));
  z-index: 5;
}

.clickable-piece {
  cursor: pointer;
}

.clickable-piece:hover {
  transform: scale(1.08) !important;
  filter: drop-shadow(0 12px 20px rgba(255, 79, 163, 0.4)) brightness(1.05);
}

.selected-piece {
  transform: scale(1.08) !important;
  filter: drop-shadow(0 0 10px var(--hot-pink)) drop-shadow(0 0 20px var(--hot-pink)) brightness(1.08) !important;
}

/* Right Column: Wardrobe Panel */
.wardrobe-panel {
  background: white;
  border: 4px solid var(--hot-pink);
  border-radius: 40px;
  padding: 40px 30px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.08);
  min-height: 480px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.wardrobe-panel::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; height: 12px;
  background: repeating-linear-gradient(45deg, var(--hot-pink), var(--hot-pink) 10px, white 10px, white 20px);
}

.wardrobe-state {
  display: none;
  width: 100%;
  height: 100%;
  animation: fadeIn 0.4s ease;
}

.wardrobe-state.active {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.fitting-room-sticker {
  font-family: 'Permanent Marker', cursive;
  font-size: 18px;
  background: #ffeff5;
  color: var(--hot-pink);
  padding: 8px 16px;
  border-radius: 20px;
  border: 2px solid var(--hot-pink);
  margin-bottom: 25px;
}

.sparkle-icon {
  font-size: 50px;
  animation: float 2s infinite ease-in-out;
  margin-bottom: 20px;
}

@keyframes float {
  0%, 100% { transform: translateY(0) scale(1); }
  50% { transform: translateY(-10px) scale(1.1); }
}

.instruction-text {
  font-family: 'Architects Daughter', cursive;
  font-size: 16px;
  color: var(--dark-magenta);
  text-align: center;
  line-height: 1.6;
  max-width: 250px;
}

.wardrobe-decor-hangers {
  margin-top: 30px;
}

.mini-hanger {
  width: 60px;
  height: 35px;
  opacity: 0.3;
}

/* Active detail state: Price Tag Style */
.price-tag-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}

.price-tag-string {
  width: 4px;
  height: 40px;
  background: #c5a580;
  border-radius: 2px;
  position: relative;
  margin-bottom: -5px;
  z-index: 10;
}

.price-tag-string::after {
  content: '';
  position: absolute;
  top: -5px; left: 50%;
  transform: translateX(-50%);
  width: 12px; height: 12px;
  border: 2px solid #c5a580;
  border-radius: 50%;
}

.price-tag-card {
  width: 100%;
  background: #fffdf5;
  border: 2px solid #e2d7c5;
  border-radius: 16px;
  padding: 35px 24px;
  box-shadow: 5px 5px 20px rgba(0,0,0,0.06);
  position: relative;
  text-align: center;
}

.price-tag-card::before {
  content: '';
  position: absolute;
  top: 10px; left: 50%;
  transform: translateX(-50%);
  width: 10px; height: 10px;
  background: white;
  border: 2px solid #e2d7c5;
  border-radius: 50%;
}

.barcode {
  font-family: 'Special Elite', monospace;
  font-size: 11px;
  color: #aaa;
  letter-spacing: 2px;
  margin-top: 10px;
  margin-bottom: 20px;
}

.tag-title {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  color: #222;
  font-weight: 900;
  margin-bottom: 12px;
}

.tag-desc {
  font-family: 'Caveat', cursive;
  font-size: 20px;
  color: #002fa7;
  line-height: 1.3;
  margin-bottom: 25px;
}

.tag-footer {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.price-tag-value {
  background: var(--hot-pink);
  color: white;
  padding: 8px 24px;
  border-radius: 12px;
  font-family: 'Permanent Marker', cursive;
  font-size: 24px;
  box-shadow: 2px 4px 10px rgba(255, 79, 163, 0.3);
  transform: rotate(-2deg);
  display: inline-block;
}

.buy-btn-y2k {
  width: 100%;
  padding: 15px;
  background: #000;
  color: #fff;
  border: 2px solid #000;
  border-radius: 14px;
  font-family: 'Permanent Marker', cursive;
  font-size: 16px;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.buy-btn-y2k:hover {
  background: var(--hot-pink);
  color: white;
  border-color: var(--hot-pink);
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(255, 79, 163, 0.4);
}

/* Responsivo para pantallas mas chicas */
@media (max-width: 1000px) {
  #gallery-view { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 991px) {
  .detail-grid {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  .canvas-container {
    height: 520px;
  }
  .mannequin-silhouette {
    top: 20px;
    height: 450px;
    width: 260px;
  }
}
</style>
@endpush

@section('content')
<div id="gallery-view">
  <div class="hero-header" style="grid-column: 1 / -1; text-align: center; padding: 40px 0 20px; position: relative;">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 80px; color: white; line-height: 0.8; letter-spacing: -2px; text-shadow: 4px 4px 0px rgba(255, 192, 203, 0.5);">OUTFITS</h1>
    <div style="font-family: 'Parisienne', cursive; font-size: 45px; color: var(--hot-pink); position: absolute; top: 80px; left: 50%; transform: translateX(-50%); text-shadow: 2px 2px 0 white;">The Lookbook</div>
  </div>

  <div class="outfit-card" onclick="openOutfit('plastics-01', 'Plastics Signature')">
    <span class="card-sticker sticker-sofetch">So Fetch</span>
    <img src="{{ asset('img/outfit1.png') }}" alt="Outfit 1">
    <h3>Plastics Signature</h3>
    <p>Wednesday Collection</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('army-pink', 'Pink Army')">
    <span class="card-sticker sticker-wednesday">Wednesday</span>
    <img src="{{ asset('img/outfit2.png') }}" alt="Outfit 2">
    <h3>Pink Army</h3>
    <p>Spring 2026 Edition</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('vintage-pink', 'Vintage Pink')">
    <span class="card-sticker sticker-limited">Limited</span>
    <img src="{{ asset('img/outfit3.png') }}" alt="Outfit 3">
    <h3>Vintage Pink</h3>
    <p>Limited Release</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('burn-book-chic', 'Burn Book Chic')">
    <span class="card-sticker sticker-classic">Classic</span>
    <img src="{{ asset('img/outfit 4.png') }}" alt="Outfit 4">
    <h3>Burn Book Chic</h3>
    <p>Class of 2026</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('mall-tour', 'Mall Tour')">
    <span class="card-sticker sticker-cute">Cute!</span>
    <img src="{{ asset('img/outfit5.png') }}" alt="Outfit 5">
    <h3>Mall Tour</h3>
    <p>Casual Set</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('gretchen-style', 'Gretchen\'s Style')">
    <span class="card-sticker sticker-rich">Rich</span>
    <img src="{{ asset('img/outfit6.png') }}" alt="Outfit 6">
    <h3>Gretchen's Style</h3>
    <p>Rich & Famous</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('regina-choice', 'Regina\'s Choice')">
    <span class="card-sticker sticker-queen">Queen</span>
    <img src="{{ asset('img/outfit1.png') }}" alt="Outfit 7">
    <h3>Regina's Choice</h3>
    <p>Boss Lady</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('karen-vibes', 'Karen\'s Vibes')">
    <span class="card-sticker sticker-omg">OMG!</span>
    <img src="{{ asset('img/outfit2.png') }}" alt="Outfit 8">
    <h3>Karen's Vibes</h3>
    <p>Pink Weather</p>
  </div>
</div>

<section id="detail-view">
  <div class="detail-header">
    <button class="back-btn" onclick="closeOutfit()">← BACK TO LOOKBOOK</button>
    <h2 id="outfit-detail-title" class="outfit-title-y2k">Outfit Signature</h2>
  </div>

  <div class="detail-grid">
    <!-- Left Column: The Dresser / Interactive Mannequin Canvas -->
    <div class="canvas-container">
      <div class="canvas-mirror-glow"></div>
      <div class="interactive-canvas" id="outfit-canvas"></div>
    </div>

    <!-- Right Column: The Wardrobe Panel / Product Tag -->
    <div class="wardrobe-panel">
      <!-- Default view when nothing is selected -->
      <div id="wardrobe-default" class="wardrobe-state active">
        <div class="fitting-room-sticker">✦ FITTING ROOM ✦</div>
        <div class="sparkle-icon">✨</div>
        <p class="instruction-text">
          Haz clic sobre las prendas del outfit para probártelas, ver el precio y agregarlas al carrito.
        </p>
        <div class="wardrobe-decor-hangers">
          <svg viewBox="0 0 100 50" class="mini-hanger">
            <path d="M 50,15 C 45,15 42,10 42,7 C 42,4 50,1 50,1 C 50,1 58,4 58,7 C 58,10 55,15 50,15 Z" fill="none" stroke="var(--hot-pink)" stroke-width="2" />
            <path d="M 50,7 L 50,15" stroke="var(--hot-pink)" stroke-width="2" />
            <path d="M 15,30 Q 50,20 85,30 Q 80,45 50,45 Q 20,45 15,30 Z" fill="none" stroke="var(--hot-pink)" stroke-width="2" />
          </svg>
        </div>
      </div>

      <!-- Detail view when a garment is selected -->
      <div id="wardrobe-active-detail" class="wardrobe-state">
        <div class="price-tag-container">
          <div class="price-tag-string"></div>
          <div class="price-tag-card">
            <div class="barcode">||||| | |||| |||</div>
            <h3 id="p-title" class="tag-title">Product Name</h3>
            <p id="p-desc" class="tag-desc">Description of the garment.</p>
            <div class="tag-footer">
              <span class="price-tag-value" id="p-price">$0.00</span>
              <button class="buy-btn-y2k" onclick="addCurrentToCart()">ADD TO BAG 🛍️</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('page-scripts')
<script>
let currentItem = null;

const outfitsData = {
  'plastics-01': [
    { src: "{{ asset('img/shoes1.png') }}", style: 'width:210px; top:490px; left:15%; transform:rotate(-5deg);', title: 'Chic Pink Mules', desc: 'Glossy retro slingbacks with kitten heel.', price: '$75.00' },
    { src: "{{ asset('img/top1.png') }}", style: 'width:340px; top:100px; left:40.5%; transform:translateX(-50%);', title: 'Soft Pink Top', desc: 'Exclusive ribbed knit design.', price: '$45.00' },
    { src: "{{ asset('img/pants.png') }}", style: 'width:295px; top:330px; left:59.5%; transform:translateX(-50%);', title: 'Flare Blue Jeans', desc: 'Classic Y2K denim.', price: '$89.90' },
    { src: "{{ asset('img/bag1.png') }}", style: 'width:200px; top:250px; right:12%; transform:rotate(8deg);', title: 'Rhinestone Bag', desc: 'Sparkly pink crystals.', price: '$65.00' }
  ],
  'army-pink': [
    { src: "{{ asset('img/boots2.png') }}", style: 'width:225px; top:480px; left:52%; transform:translateX(-50%);', title: 'Combat Boots', desc: 'Black leather platform boots.', price: '$110.00' },
    { src: "{{ asset('img/skirt2.png') }}", style: 'width:300px; top:270px; left:55%; transform:translateX(-50%);', title: 'Pink Ruffle Skirt', desc: 'Layered ruffles.', price: '$55.00' },
    { src: "{{ asset('img/top2.png') }}", style: 'width:215px; top:110px; left:46.5%; transform:translateX(-50%);', title: 'Gray Tube Top', desc: 'Essential basic.', price: '$25.00' },
    { src: "{{ asset('img/jacket2.png') }}", style: 'width:260px; top:40px; right:12%; transform:rotate(10deg);', title: 'Biker Bow Jacket', desc: 'Faux leather with pink bow details.', price: '$120.00' }
  ],
  'vintage-pink': [
    { src: "{{ asset('img/shoes1.png') }}", style: 'width:210px; top:485px; left:50%; transform:translateX(-50%);', title: 'Pink Kitten Heels', desc: 'Cute patent leather slingbacks.', price: '$75.00' },
    { src: "{{ asset('img/jeans3.png') }}", style: 'width:260px; top:310px; left:59.5%; transform:translateX(-50%);', title: 'Low Rise Denim', desc: 'Stretched vintage low waist jeans.', price: '$95.00' },
    { src: "{{ asset('img/top3.png') }}", style: 'width:260px; top:110px; left:45.5%; transform:translateX(-50%);', title: 'Vintage Logo Tee', desc: 'Printed graphic cotton tee.', price: '$38.00' },
    { src: "{{ asset('img/necklace3.png') }}", style: 'width:130px; top:45px; left:48%; transform:translateX(-50%);', title: 'Choker Star', desc: 'Rhinestone star choker necklace.', price: '$28.00' }
  ],
  'burn-book-chic': [
    { src: "{{ asset('img/boots3.png') }}", style: 'width:240px; top:460px; left:53.5%; transform:translateX(-50%);', title: 'Knee High Pink Boots', desc: 'Pointy toe glossy high boots.', price: '$145.00' },
    { src: "{{ asset('img/skirt2.png') }}", style: 'width:300px; top:280px; left:55%; transform:translateX(-50%);', title: 'Plissée Pink Skirt', desc: 'Pleated micro skirt.', price: '$48.00' },
    { src: "{{ asset('img/cardigan.png') }}", style: 'width:270px; top:100px; left:43.5%; transform:translateX(-50%);', title: 'Preppy Pink Cardigan', desc: 'Cozy cropped knit cardigan.', price: '$68.00' },
    { src: "{{ asset('img/bag1.png') }}", style: 'width:180px; top:200px; right:14%; transform:rotate(-8deg);', title: 'Gossip Rhinestone Clutch', desc: 'Small sparkling rhinestone bag.', price: '$65.00' }
  ],
  'mall-tour': [
    { src: "{{ asset('img/shoes1.png') }}", style: 'width:200px; top:490px; left:50%; transform:translateX(-50%);', title: 'Platform Slides', desc: 'Fluffy pink sandals.', price: '$45.00' },
    { src: "{{ asset('img/pants.png') }}", style: 'width:290px; top:300px; left:59.5%; transform:translateX(-50%);', title: 'Pink Sweatpants', desc: 'Comfy cotton jogger pants.', price: '$60.00' },
    { src: "{{ asset('img/shirt.png') }}", style: 'width:235px; top:110px; left:44.5%; transform:translateX(-50%);', title: 'Baby Doll Tee', desc: 'Fitted cropped doll tee.', price: '$32.00' },
    { src: "{{ asset('img/bag1.png') }}", style: 'width:190px; top:220px; left:12%; transform:rotate(12deg);', title: 'Pink Shoulder Bag', desc: 'Mini baguette handbag.', price: '$50.00' }
  ],
  'gretchen-style': [
    { src: "{{ asset('img/boots3.png') }}", style: 'width:245px; top:460px; left:53.5%; transform:translateX(-50%);', title: 'Suede Thigh Boots', desc: 'Luxury high boots in baby pink.', price: '$150.00' },
    { src: "{{ asset('img/skirt2.png') }}", style: 'width:300px; top:280px; left:55%; transform:translateX(-50%);', title: 'Plaid Pleated Skirt', desc: 'Classic academy pleated style.', price: '$59.00' },
    { src: "{{ asset('img/top1.png') }}", style: 'width:340px; top:110px; left:40.5%; transform:translateX(-50%);', title: 'Regina Knit Corset', desc: 'Off-shoulder structured pink top.', price: '$55.00' },
    { src: "{{ asset('img/jacket2.png') }}", style: 'width:260px; top:40px; right:12%; transform:rotate(10deg);', title: 'Chic Biker Jacket', desc: 'Pink faux leather biker jacket.', price: '$120.00' }
  ],
  'regina-choice': [
    { src: "{{ asset('img/boots3.png') }}", style: 'width:245px; top:460px; left:53.5%; transform:translateX(-50%);', title: 'Leather Platform Boots', desc: 'High platform shiny pink boots.', price: '$130.00' },
    { src: "{{ asset('img/jeans3.png') }}", style: 'width:265px; top:315px; left:59.5%; transform:translateX(-50%);', title: 'Glitter Pocket Jeans', desc: 'Denim pants with rhinestone back pockets.', price: '$110.00' },
    { src: "{{ asset('img/top3.png') }}", style: 'width:260px; top:120px; left:45.5%; transform:translateX(-50%);', title: 'Queen Tiara Tee', desc: 'Crown graphic fitted tee.', price: '$40.00' },
    { src: "{{ asset('img/bag1.png') }}", style: 'width:190px; top:200px; left:10%; transform:rotate(-15deg);', title: 'Metallic Bow Bag', desc: 'Glamorous silver-pink handbag.', price: '$85.00' }
  ],
  'karen-vibes': [
    { src: "{{ asset('img/boots2.png') }}", style: 'width:220px; top:480px; left:52%; transform:translateX(-50%);', title: 'Karen Platform Booties', desc: 'Comfy chunky suede booties.', price: '$95.00' },
    { src: "{{ asset('img/pants.png') }}", style: 'width:290px; top:310px; left:59.5%; transform:translateX(-50%);', title: 'Pink Satin Pants', desc: 'Smooth flowing wide-leg trousers.', price: '$80.00' },
    { src: "{{ asset('img/cardigan.png') }}", style: 'width:270px; top:100px; left:43.5%; transform:translateX(-50%);', title: 'Fluffy Pink Knit', desc: 'Super soft oversized crop knit.', price: '$72.00' },
    { src: "{{ asset('img/necklace3.png') }}", style: 'width:130px; top:45px; left:48%; transform:translateX(-50%);', title: 'Crystal Heart Pendant', desc: 'Large silver heart necklace.', price: '$35.00' }
  ]
};

function slugify(text) {
  return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
}

function parsePrice(priceString) {
  return Number(String(priceString).replace(/[^0-9.]/g, ''));
}

async function addCurrentToCart() {
  if (!currentItem) {
    return;
  }

  const cart = await cartRequest(cartRoutes.add, currentItem);
  renderCart(cart);
  document.getElementById('cart-panel').classList.add('open');
}

function openOutfit(id, outfitName) {
  // Update detail title
  document.getElementById('outfit-detail-title').innerText = outfitName || 'Outfit Details';

  const canvas = document.getElementById('outfit-canvas');
  canvas.innerHTML = '';
  
  // Add mannequin silhouette
  const mannequin = document.createElement('div');
  mannequin.className = 'mannequin-silhouette';
  mannequin.innerHTML = `
    <svg viewBox="0 0 100 200" style="width:100%; height:100%;" xmlns="http://www.w3.org/2000/svg">
      <!-- Hook -->
      <path d="M 50,22 Q 45,22 43,15 Q 43,8 50,8 Q 57,8 57,15" fill="none" stroke="rgba(255, 79, 163, 0.4)" stroke-width="2.5" stroke-linecap="round" />
      <!-- Hanger arms -->
      <path d="M 15,48 Q 50,30 85,48" stroke="rgba(255, 79, 163, 0.5)" stroke-width="3" fill="none" stroke-linecap="round" />
      <!-- Body form outline -->
      <path d="M 30,55 C 32,80 38,98 40,115 C 41,120 35,124 33,128 C 36,130 64,130 67,128 C 65,124 59,120 60,115 C 62,98 68,80 70,55 Z" fill="rgba(255, 192, 203, 0.12)" stroke="rgba(255, 79, 163, 0.3)" stroke-width="2" />
      <line x1="50" y1="128" x2="50" y2="190" stroke="rgba(255, 79, 163, 0.4)" stroke-width="3.5" />
      <path d="M 35,190 L 65,190 M 42,190 L 50,180 L 58,190" stroke="rgba(255, 79, 163, 0.4)" stroke-width="3.5" fill="none" stroke-linejoin="round" />
    </svg>
  `;
  canvas.appendChild(mannequin);

  const items = outfitsData[id];
  if (items) {
    items.forEach((item, index) => {
      const img = document.createElement('img');
      img.src = item.src;
      img.className = 'piece';
      img.style.cssText = item.style;
      
      // Make active pieces highlightable
      if (item.title) {
        img.classList.add('clickable-piece');
        img.onclick = (e) => {
          e.stopPropagation();
          
          // Remove active class from other pieces
          document.querySelectorAll('.piece').forEach(p => p.classList.remove('selected-piece'));
          img.classList.add('selected-piece');
          
          openBuy(item.title, item.desc, item.price, item.src);
        };
      }
      canvas.appendChild(img);
    });
  }

  // Set right column to default state
  document.getElementById('wardrobe-default').classList.add('active');
  document.getElementById('wardrobe-active-detail').classList.remove('active');

  document.getElementById('gallery-view').style.display = 'none';
  document.getElementById('detail-view').style.display = 'grid';
  window.scrollTo(0, 0);
}

function closeOutfit() {
  document.getElementById('gallery-view').style.display = 'grid';
  document.getElementById('detail-view').style.display = 'none';
  // Remove selected highlights
  document.querySelectorAll('.piece').forEach(p => p.classList.remove('selected-piece'));
}

function openBuy(title, desc, price, image) {
  // Update active card content
  document.getElementById('p-title').innerText = title;
  document.getElementById('p-desc').innerText = desc;
  document.getElementById('p-price').innerText = price;

  currentItem = {
    sku: slugify(title),
    name: title,
    description: desc,
    price: parsePrice(price),
    image: image,
  };

  // Toggle wardrobe panel states
  document.getElementById('wardrobe-default').classList.remove('active');
  document.getElementById('wardrobe-active-detail').classList.add('active');
}
</script>
@endpush
