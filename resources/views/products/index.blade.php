@extends('layouts.app')

@section('title', 'The Plastics - Dynamic Lookbook')

@push('page-styles')
<style>
/* --- GALERIA ACTUALIZADA (4 por fila) --- */
#gallery-view {
  padding: 60px 40px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  max-width: 1400px;
  margin: 0 auto;
}

.outfit-card {
  background: rgba(255, 255, 255, 0.4);
  border: 2px solid var(--hot-pink);
  border-radius: 35px;
  padding: 15px;
  cursor: pointer;
  transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  text-align: center;
}

.outfit-card:nth-child(odd) { transform: rotate(-3deg); }
.outfit-card:nth-child(even) { transform: rotate(3deg); }

.outfit-card:hover {
  transform: scale(1.05) rotate(0deg) !important;
  background: white;
  box-shadow: 0 20px 50px rgba(255, 79, 163, 0.2);
  z-index: 10;
}

.outfit-card img {
  width: 100%; border-radius: 20px; margin-bottom: 15px;
}

.outfit-card h3 { font-family: 'Playfair Display'; color: var(--hot-pink); font-style: italic; font-size: 18px; }
.outfit-card p { font-size: 11px; color: #888; font-weight: bold; }

/* --- DETALLE --- */
#detail-view {
  display: none;
  position: relative;
  width: 100%;
  height: 1000px;
}

.back-btn {
  position: absolute; top: 25px; left: 30px;
  background: var(--soft-pink); border: 1px solid var(--hot-pink);
  padding: 10px 25px; border-radius: 25px; cursor: pointer;
  color: var(--hot-pink); font-weight: 900; z-index: 10;
}

.interactive-canvas {
  position: relative;
  width: 100%; height: 100%;
  max-width: 900px; margin: 0 auto;
}

.piece {
  position: absolute;
  transition: 0.4s ease;
  cursor: pointer;
}

.interactive-canvas:hover .piece { filter: brightness(0.7) grayscale(0.2); }
.piece:hover {
  filter: brightness(1) grayscale(0) !important;
  transform: scale(1.1) rotate(-2deg);
  z-index: 50;
}

/* --- MODAL --- */
#buy-modal {
  position: fixed; right: -400px; top: 80px;
  width: 320px;
  background: white; border: 3px solid var(--hot-pink);
  border-radius: 30px 0 0 30px;
  padding: 40px; transition: 0.5s ease;
  z-index: 200;
  box-shadow: -10px 10px 40px rgba(0,0,0,0.1);
}

#buy-modal.open { right: 0; }

#buy-modal h2 { font-family: 'Playfair Display'; color: var(--hot-pink); font-size: 28px; font-style: italic; }
#buy-modal p { margin: 15px 0; color: #666; font-size: 14px; }
.price-tag {
  background: var(--hot-pink); color: white; padding: 5px 15px;
  border-radius: 12px; font-weight: 900; font-size: 22px; display: inline-block;
}

.buy-btn {
  width: 100%; padding: 15px; background: var(--hot-pink);
  color: white; border: none; border-radius: 12px;
  font-weight: 900; font-size: 16px; cursor: pointer; margin-top: 25px;
}

/* Responsivo para pantallas mas chicas */
@media (max-width: 1000px) {
  #gallery-view { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush

@section('content')
<div id="gallery-view">
  <div class="hero-header" style="grid-column: 1 / -1; text-align: center; padding: 40px 0 20px; position: relative;">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 80px; color: white; line-height: 0.8; letter-spacing: -2px; text-shadow: 4px 4px 0px rgba(255, 192, 203, 0.5);">OUTFITS</h1>
    <div style="font-family: 'Parisienne', cursive; font-size: 45px; color: var(--hot-pink); position: absolute; top: 80px; left: 50%; transform: translateX(-50%); text-shadow: 2px 2px 0 white;">The Lookbook</div>
  </div>

  <div class="outfit-card" onclick="openOutfit('plastics-01')">
    <img src="{{ asset('img/outfit1.png') }}" alt="Outfit 1">
    <h3>Plastics Signature</h3>
    <p>Wednesday Collection</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('army-pink')">
    <img src="{{ asset('img/outfit2.png') }}" alt="Outfit 2">
    <h3>Pink Army</h3>
    <p>Spring 2026 Edition</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('plastics-01')">
    <img src="{{ asset('img/outfit3.png') }}" alt="Outfit 3">
    <h3>Vintage Pink</h3>
    <p>Limited Release</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('army-pink')">
    <img src="{{ asset('img/outfit 4.png') }}" alt="Outfit 4">
    <h3>Burn Book Chic</h3>
    <p>Class of 2026</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('plastics-01')">
    <img src="{{ asset('img/outfit5.png') }}" alt="Outfit 5">
    <h3>Mall Tour</h3>
    <p>Casual Set</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('army-pink')">
    <img src="{{ asset('img/outfit6.png') }}" alt="Outfit 6">
    <h3>Gretchen's Style</h3>
    <p>Rich & Famous</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('plastics-01')">
    <img src="{{ asset('img/outfit1.png') }}" alt="Outfit 7">
    <h3>Regina's Choice</h3>
    <p>Boss Lady</p>
  </div>

  <div class="outfit-card" onclick="openOutfit('army-pink')">
    <img src="{{ asset('img/outfit2.png') }}" alt="Outfit 8">
    <h3>Karen's Vibes</h3>
    <p>Pink Weather</p>
  </div>
</div>

<section id="detail-view">
  <button class="back-btn" onclick="closeOutfit()">← BACK TO BOOK</button>
  <div class="interactive-canvas" id="outfit-canvas"></div>
</section>

<div id="buy-modal">
  <button onclick="document.getElementById('buy-modal').classList.remove('open')" style="border:none; background:none; cursor:pointer; font-size:20px; float:right;">✕</button>
  <div style="clear:both; margin-top:30px;">
    <h2 id="p-title">Product Name</h2>
    <p id="p-desc">Description of the garment goes here.</p>
    <span class="price-tag" id="p-price">$0.00</span>
    <button class="buy-btn" onclick="addCurrentToCart()">ADD TO CART</button>
  </div>
</div>
@endsection

@push('page-scripts')
<script>
const outfitsData = {
  'plastics-01': [
    { src: "{{ asset('img/shoes1.png') }}", style: 'width:260px; top:20px; left:20px; transform:rotate(-5deg); pointer-events:none;' },
    { src: "{{ asset('img/top1.png') }}", style: 'width:340px; top:100px; left:50%; transform:translateX(-50%);', title: 'Soft Pink Top', desc: 'Exclusive ribbed knit design.', price: '$45.00' },
    { src: "{{ asset('img/pants.png') }}", style: 'width:290px; top:360px; left:50%; transform:translateX(-50%);', title: 'Flare Blue Jeans', desc: 'Classic Y2K denim.', price: '$89.90' },
    { src: "{{ asset('img/bag1.png') }}", style: 'width:230px; top:420px; right:60px; transform:rotate(8deg);', title: 'Rhinestone Bag', desc: 'Sparkly pink crystals.', price: '$65.00' }
  ],
  'army-pink': [
    { src: "{{ asset('img/boots2.png') }}", style: 'width:220px; top:480px; left:50%; transform:translateX(-50%);', title: 'Combat Boots', desc: 'Black leather platform boots.', price: '$110.00' },
    { src: "{{ asset('img/skirt2.png') }}", style: 'width:300px; top:270px; left:50%; transform:translateX(-50%);', title: 'Pink Ruffle Skirt', desc: 'Layered ruffles.', price: '$55.00' },
    { src: "{{ asset('img/top2.png') }}", style: 'width:215px; top:110px; left:50%; transform:translateX(-50%);', title: 'Gray Tube Top', desc: 'Essential basic.', price: '$25.00' },
    { src: "{{ asset('img/jacket2.png') }}", style: 'width:260px; top:40px; right:8%; transform:rotate(10deg);', title: 'Biker Bow Jacket', desc: 'Faux leather with pink bow details.', price: '$120.00' }
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

function openOutfit(id) {
  const canvas = document.getElementById('outfit-canvas');
  canvas.innerHTML = '';
  const items = outfitsData[id];
  items.forEach(item => {
    const img = document.createElement('img');
    img.src = item.src;
    img.className = 'piece';
    img.style.cssText = item.style;
    if (item.title) {
      img.onclick = () => openBuy(item.title, item.desc, item.price, item.src);
    }
    canvas.appendChild(img);
  });
  document.getElementById('gallery-view').style.display = 'none';
  document.getElementById('detail-view').style.display = 'block';
  window.scrollTo(0,0);
}

function closeOutfit() {
  document.getElementById('gallery-view').style.display = 'grid';
  document.getElementById('detail-view').style.display = 'none';
  document.getElementById('buy-modal').classList.remove('open');
}

function openBuy(title, desc, price, image) {
  const modal = document.getElementById('buy-modal');
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

  modal.classList.add('open');
}
</script>
@endpush
