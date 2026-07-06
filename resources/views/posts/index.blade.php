@extends('layouts.app')

@section('title', 'Burn Book | Gossip & Trends')

@section('push-styles')
@endsection

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Permanent+Marker&family=Special+Elite&family=Architects+Daughter&family=Playfair+Display:ital,wght@0,900;1,900&display=swap');

.blog-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px 80px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.book-wrapper {
  perspective: 1500px;
  width: 100%;
  max-width: 1060px;
  margin-top: 20px;
}

.burn-book {
  position: relative;
  width: 530px;
  height: 700px;
  margin: 0 auto;
  transition: transform 1s ease, width 1s ease;
  transform-style: preserve-3d;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
  border-radius: 20px;
}

.burn-book.open {
  width: 1060px;
}

.book-cover {
  position: absolute;
  inset: 0;
  background: #db5686;
  border-radius: 20px;
  box-shadow: 
    inset -5px -5px 15px rgba(0,0,0,0.15), 
    inset 15px 0 25px rgba(0,0,0,0.25), 
    0 15px 35px rgba(0,0,0,0.3);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 10;
  backface-visibility: hidden;
  cursor: pointer;
  transition: transform 0.4s ease, box-shadow 0.3s;
  overflow: hidden;
  border-left: 22px solid #b83d6a;
}

.book-cover:hover {
  transform: scale(1.02) rotate(-1deg);
  box-shadow: 
    inset -5px -5px 15px rgba(0,0,0,0.15), 
    inset 15px 0 25px rgba(0,0,0,0.25), 
    0 20px 45px rgba(219, 86, 134, 0.4);
}

.cover-doodles-svg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 2;
  opacity: 0.85;
}

.ransom-circle-container {
  position: relative;
  width: 440px;
  height: 440px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 3;
  margin-top: -30px;
}

.kiss-mark-center {
  position: absolute;
  width: 130px;
  height: 80px;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 60"><path d="M 10 32 Q 30 14 50 24 Q 70 14 90 32 Q 75 44 50 37 Q 25 44 10 32 Z" fill="%23d81b40"/><path d="M 12 35 Q 32 50 50 44 Q 68 50 88 35 Q 73 60 50 52 Q 27 60 12 35 Z" fill="%23b8112e"/></svg>');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  transform: translate(-5%, -5%) rotate(-8deg);
  filter: drop-shadow(0 2px 4px rgba(216, 27, 64, 0.35));
  z-index: 2;
}

.ransom-piece {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 2px 4px 8px rgba(0,0,0,0.3);
  font-weight: 900;
  text-transform: uppercase;
}

.letter-b1 {
  width: 65px; height: 80px;
  background: #121212;
  color: #ffffff;
  font-family: 'Playfair Display', serif;
  font-style: italic;
  font-size: 58px;
  top: 60px; left: 60px;
  transform: rotate(-18deg);
  clip-path: polygon(4% 6%, 96% 2%, 91% 94%, 8% 90%);
}

.letter-u {
  width: 60px; height: 75px;
  background: #ffffff;
  color: #121212;
  font-family: 'Inter', sans-serif;
  font-size: 50px;
  top: 35px; left: 140px;
  transform: rotate(-8deg);
  border: 2px solid #121212;
  clip-path: polygon(10% 2%, 92% 8%, 95% 92%, 3% 97%);
}

.letter-r {
  width: 62px; height: 78px;
  background: #121212;
  color: #ffffff;
  font-family: 'Special Elite', monospace;
  font-size: 54px;
  top: 38px; right: 145px;
  transform: rotate(6deg);
  clip-path: polygon(2% 10%, 98% 3%, 89% 95%, 7% 92%);
}

.letter-n {
  width: 65px; height: 80px;
  background: #ffffff;
  color: #121212;
  font-family: 'Permanent Marker', cursive;
  font-size: 52px;
  top: 75px; right: 65px;
  transform: rotate(20deg);
  clip-path: polygon(8% 8%, 92% 4%, 97% 91%, 5% 95%);
}

.letter-b2 {
  width: 60px; height: 76px;
  background: #121212;
  color: #ffffff;
  font-family: 'Special Elite', monospace;
  font-size: 50px;
  bottom: 80px; left: 75px;
  transform: rotate(-14deg);
  clip-path: polygon(5% 12%, 95% 6%, 92% 98%, 10% 88%);
}

.letter-o1 {
  width: 60px; height: 75px;
  background: #ffffff;
  color: #121212;
  font-family: 'Playfair Display', serif;
  font-size: 52px;
  bottom: 45px; left: 160px;
  transform: rotate(-4deg);
  border: 1px solid #121212;
  clip-path: polygon(6% 4%, 94% 9%, 92% 94%, 4% 92%);
}

.letter-o2 {
  width: 62px; height: 78px;
  background: #ffffff;
  color: #121212;
  font-family: 'Inter', sans-serif;
  font-size: 54px;
  bottom: 42px; right: 165px;
  transform: rotate(8deg);
  clip-path: polygon(3% 10%, 97% 4%, 94% 96%, 6% 92%);
}

.letter-k {
  width: 65px; height: 80px;
  background: #ffffff;
  color: #121212;
  font-family: 'Permanent Marker', cursive;
  font-size: 54px;
  bottom: 90px; right: 75px;
  transform: rotate(22deg);
  border: 3px double #121212;
  clip-path: polygon(8% 4%, 96% 12%, 91% 95%, 3% 88%);
}

.click-to-open-sticker {
  margin-top: 15px;
  background: #ffffcc;
  color: #222;
  font-family: 'Architects Daughter', cursive;
  font-size: 13px;
  padding: 8px 16px;
  border-radius: 4px;
  transform: rotate(-2deg);
  box-shadow: 2px 4px 10px rgba(0,0,0,0.15);
  border: 1px dashed #d1c86e;
  animation: pulse 1.5s infinite;
  z-index: 4;
}

.book-inside {
  display: none;
  width: 100%;
  height: 100%;
  grid-template-columns: 1fr 1fr;
  background: #fbc2eb;
  border-radius: 20px;
  overflow: hidden;
  border: 8px solid #d82b75;
  box-shadow: inset 0 0 50px rgba(0,0,0,0.3);
}

.burn-book.open .book-cover {
  display: none;
}
.burn-book.open .book-inside {
  display: grid;
}

.book-spine {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 50%;
  width: 24px;
  transform: translateX(-50%);
  background: linear-gradient(to right, rgba(0,0,0,0.15), rgba(0,0,0,0.05) 30%, rgba(255,255,255,0.2) 50%, rgba(0,0,0,0.05) 70%, rgba(0,0,0,0.15));
  border-left: 1px solid rgba(0,0,0,0.1);
  border-right: 1px solid rgba(0,0,0,0.1);
  z-index: 5;
  pointer-events: none;
}

.book-page {
  position: relative;
  background: #fffdf5;
  background-image: linear-gradient(rgba(0,0,0,0) 96%, #b4daf9 96%);
  background-size: 100% 28px;
  padding: 40px 35px;
  overflow-y: auto;
  height: 100%;
  display: flex;
  flex-direction: column;
  cursor: pointer;
  transition: background-color 0.2s;
  flex: 1;
  width: 50%;
}

.book-page:hover {
  background-color: #fffaef;
}

.book-page.left {
  border-right: 1px solid rgba(0,0,0,0.1);
  padding-right: 45px;
}
.book-page.right {
  border-left: 1px solid rgba(0,0,0,0.1);
  padding-left: 45px;
}

.book-page::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0;
  width: 2px;
  background: #ffb1c7;
  z-index: 2;
}
.book-page.left::before { right: 30px; }
.book-page.right::before { left: 30px; }

.page-flip-indicator {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 79, 163, 0.9);
  color: white;
  font-family: 'Architects Daughter', cursive;
  font-size: 13px;
  padding: 8px 16px;
  border-radius: 20px;
  opacity: 0;
  transition: opacity 0.3s, transform 0.3s;
  pointer-events: none;
  z-index: 10;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.left-indicator { left: 20px; transform: translateY(-50%) translateX(-10px); }
.right-indicator { right: 20px; transform: translateY(-50%) translateX(10px); }

.book-page.left:hover .left-indicator { opacity: 0.9; transform: translateY(-50%) translateX(0); }
.book-page.right:hover .right-indicator { opacity: 0.9; transform: translateY(-50%) translateX(0); }

.close-book-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  z-index: 20;
  background: #fff;
  color: var(--hot-pink);
  border: 2px solid var(--hot-pink);
  padding: 4px 10px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 12px;
  font-weight: 900;
  transition: 0.2s;
}
.close-book-btn:hover {
  background: var(--soft-pink);
  transform: scale(1.05);
}

.gossip-spread {
  display: none;
  width: 100%;
  height: 100%;
  grid-column: 1 / -1;
}
.gossip-spread.active {
  display: flex;
}

.page-title {
  font-family: 'Permanent Marker', cursive;
  font-size: 28px;
  color: #111;
  margin-bottom: 24px;
  text-transform: uppercase;
  transform: rotate(-1.5deg);
  text-align: center;
}

.scrapbook-polaroid {
  background: white;
  padding: 12px 12px 30px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  transform: rotate(-3deg);
  width: 240px;
  align-self: center;
  margin-bottom: 20px;
  position: relative;
}
.scrapbook-polaroid img {
  width: 100%;
  aspect-ratio: 1.1;
  object-fit: cover;
  border: 1px solid #eee;
}

.scrapbook-tape {
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%) rotate(-4deg);
  width: 90px;
  height: 26px;
  background: rgba(255, 230, 100, 0.4);
  border-left: 2px dashed rgba(0,0,0,0.1);
  border-right: 2px dashed rgba(0,0,0,0.1);
}

.gossip-author-meta {
  font-family: 'Permanent Marker', cursive;
  font-size: 12px;
  color: var(--hot-pink);
  letter-spacing: 0.1em;
  text-transform: uppercase;
  margin-bottom: 6px;
}

.gossip-headline {
  font-family: 'Permanent Marker', cursive;
  font-size: 26px;
  color: #111;
  line-height: 1.2;
  margin-bottom: 15px;
  transform: rotate(0.5deg);
}

.gossip-body-text {
  font-family: 'Caveat', cursive;
  font-size: 23px;
  line-height: 1.25;
  color: #002fa7;
  word-spacing: 1px;
}

.margin-decor {
  font-size: 11px;
  color: #888;
  font-family: 'Architects Daughter', cursive;
  text-transform: uppercase;
  margin-top: auto;
  padding-top: 20px;
  text-align: center;
  border-top: 1px dashed #ccc;
  user-select: none;
}

@media (max-width: 1080px) {
  .burn-book {
    width: 100% !important;
    max-width: 500px;
    height: auto;
    min-height: 680px;
  }
  .book-inside {
    grid-template-columns: 1fr;
    height: auto;
  }
  .gossip-spread {
    flex-direction: column;
  }
  .book-spine {
    display: none;
  }
  .book-page {
    width: 100% !important;
  }
  .book-page.left {
    border-right: none;
    border-bottom: 8px solid #d82b75;
    height: 380px;
  }
  .book-page.right {
    border-left: none;
    min-height: 480px;
    height: auto;
  }
  .book-page::before {
    display: none;
  }
}

.book-tabs {
  position: absolute;
  right: -35px;
  top: 150px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  z-index: 100;
}

.book-tab {
  width: 35px;
  height: 90px;
  writing-mode: vertical-rl;
  text-orientation: mixed;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Permanent Marker', cursive;
  font-size: 13px;
  border-radius: 0 10px 10px 0;
  cursor: pointer;
  box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.2s, background-color 0.2s, width 0.2s;
  border: 2px solid var(--hot-pink);
  border-left: none;
  letter-spacing: 2px;
  user-select: none;
}

.book-tab:hover {
  transform: translateX(4px);
}

.book-tab.active {
  transform: translateX(8px);
  width: 40px;
}

.book-tab[data-category="fashion"] {
  background: #fde6ef;
  color: var(--hot-pink);
}
.book-tab[data-category="fashion"].active {
  background: #ffc2d4;
}

.book-tab[data-category="gossip"] {
  background: #121212;
  color: var(--hot-pink);
}
.book-tab[data-category="gossip"].active {
  background: #1e1e1e;
  border-color: #ff007f;
}
</style>
@endpush

@section('content')
<section class="blog-page">
  
  <div style="text-align: center; margin-bottom: 30px;">
    <h2 style="font-family: 'Parisienne', cursive; font-size: 56px; color: var(--hot-pink); text-shadow: 2px 2px 0 white; margin-bottom: 4px;">Top Secret</h2>
    <h1 style="font-family: 'Playfair Display', serif; font-size: 42px; color: var(--dark-magenta); margin-bottom: 10px;">El Burn Book de Gossip</h1>
    <p style="font-family: 'Architects Daughter', cursive; color: #555; font-size: 14px;">Solo los miércoles compartimos los secretos más picantes de la escuela.</p>
  </div>

  @if($posts->isEmpty())
    <div class="panel" style="text-align: center; padding: 40px; max-width: 500px; margin: 0 auto;">
      <p style="font-family: 'Architects Daughter', cursive; font-size: 16px; color: var(--dark-magenta);">El libro está totalmente vacío... por ahora.</p>
    </div>
  @else
    <div class="book-wrapper">
      <div id="burn-book" class="burn-book closed">
        
        <div class="book-tabs">
          <div class="book-tab active" data-category="fashion" onclick="selectCategory('fashion', event)">FASHION</div>
          <div class="book-tab" data-category="gossip" onclick="selectCategory('gossip', event)">GOSSIP</div>
        </div>

        <div class="book-cover" onclick="openBook()">
          
          <svg class="cover-doodles-svg" viewBox="0 0 500 680" xmlns="http://www.w3.org/2000/svg">
            <path d="M 50,40 L 90,40 L 90,80 L 50,80 Z" stroke="black" stroke-width="2.5" fill="none"/>
            <path d="M 60,50 L 80,50 L 80,70 L 60,70 Z" stroke="black" stroke-width="1.8" fill="none"/>
            <path d="M 50,40 L 90,80 M 90,40 L 50,80" stroke="black" stroke-width="1.5" fill="none"/>
            <path d="M 95,45 L 110,45 L 110,85 L 120,85 L 120,40 L 140,40 L 140,75 L 160,75 L 160,35" stroke="black" stroke-width="2" fill="none" stroke-linecap="round"/>
            <path d="M 130,90 L 130,110 L 170,110 L 170,90 L 150,90" stroke="black" stroke-width="2.2" fill="none"/>
            <text x="180" y="55" font-family="'Permanent Marker', cursive" font-size="16" fill="black" transform="rotate(3, 180, 55)">STAB</text>
            
            <path d="M 370,55 C 380,45 400,45 405,60 C 410,75 390,90 380,85 C 370,80 375,65 385,68 M 382,75 L 360,95 M 360,95 L 360,85 M 360,95 L 370,95" stroke="black" stroke-width="2.2" fill="none"/>
            <text x="55" y="115" font-family="'Permanent Marker', cursive" font-size="12" fill="black" transform="rotate(-90, 55, 115)">BIG HAIR</text>

            <path d="M 40,540 C 50,530 55,550 65,540 C 75,530 80,550 90,540" stroke="black" stroke-width="2" fill="none"/>
            <path d="M 45,550 C 55,540 60,560 70,550 C 80,540 85,560 95,550" stroke="black" stroke-width="2" fill="none"/>
            <path d="M 100,560 C 100,540 120,540 120,555 C 120,570 105,570 110,560 L 115,550" stroke="black" stroke-width="2.2" fill="none"/>
            <text x="75" y="585" font-family="'Permanent Marker', cursive" font-size="15" fill="black" transform="rotate(-4, 75, 585)">MEAN</text>
            <text x="70" y="605" font-family="'Permanent Marker', cursive" font-size="17" fill="black" transform="rotate(-6, 70, 605)">STAB ME</text>
            <text x="80" y="625" font-family="'Permanent Marker', cursive" font-size="13" fill="black" transform="rotate(3, 80, 625)">STAB</text>

            <text x="260" y="590" font-family="'Permanent Marker', cursive" font-size="17" fill="black" transform="rotate(6, 260, 590)">FAT ME</text>
            <path d="M 255,600 L 320,600" stroke="black" stroke-width="2.5"/>
            <path d="M 80,635 L 280,635 L 280,645 L 80,645" stroke="black" stroke-width="1.8" fill="none"/>
            <text x="350" y="635" font-family="'Permanent Marker', cursive" font-size="14" fill="black" transform="rotate(-2, 350, 635)">LUGABLE</text>
          </svg>

          <div class="ransom-circle-container">
            <div class="kiss-mark-center"></div>
            <span class="ransom-piece letter-b1">B</span>
            <span class="ransom-piece letter-u">U</span>
            <span class="ransom-piece letter-r">R</span>
            <span class="ransom-piece letter-n">N</span>
            <span class="ransom-piece letter-b2">B</span>
            <span class="ransom-piece letter-o1">O</span>
            <span class="ransom-piece letter-o2">O</span>
            <span class="ransom-piece letter-k">K</span>
          </div>

          <div class="click-to-open-sticker">✦ CLICK TO OPEN ✦</div>
        </div>

        <div class="book-inside">
          <button class="close-book-btn" onclick="event.stopPropagation(); closeBook()">✕ Cerrar Libro</button>
          
          <div class="book-spine"></div>

          @foreach($posts as $index => $post)
            <div id="secret-spread-{{ $index }}" class="gossip-spread" data-category="{{ $post->category->slug }}" style="display: none; width: 100%; height: 100%;">
              
              <div class="book-page left" onclick="prevSecret()">
                <div class="page-flip-indicator left-indicator">◀ Anterior</div>
                
                <h3 class="page-title">Regina's Gossip</h3>
                
                <div class="scrapbook-polaroid">
                  <span class="scrapbook-tape"></span>
                  <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
                </div>

                <div class="gossip-author-meta" style="text-align: center; margin-top: 10px;">
                  Por: {{ $post->author_name }} | {{ $post->category->name }}
                </div>
                
                <div class="margin-decor">★ Toca aquí para página anterior ★</div>
              </div>

              <div class="book-page right" onclick="nextSecret()">
                <div class="page-flip-indicator right-indicator">Siguiente ▶</div>

                <h2 class="gossip-headline" style="text-align: center; margin-top: 20px;">
                  {{ $post->title }}
                </h2>

                <div class="gossip-body-text">
                  {!! nl2br(e($post->content)) !!}
                </div>

                <div class="margin-decor" style="margin-top: auto; padding-top: 25px;">
                  Publicado: {{ $post->published_at?->format('d/m/Y') ?? 'Reciente' }}
                </div>
              </div>

            </div>
          @endforeach

          <div id="empty-category-message" class="gossip-spread" style="display: none; width: 100%; height: 100%;">
            <div class="book-page left" onclick="prevSecret()">
              <h3 class="page-title">Regina's Gossip</h3>
              <div style="text-align: center; margin-top: 80px;">
                <span style="font-size: 80px;">🤫</span>
              </div>
              <div class="margin-decor">★ Toca aquí para página anterior ★</div>
            </div>
            <div class="book-page right" onclick="nextSecret()">
              <h2 class="gossip-headline" style="text-align: center; margin-top: 40px;">
                Sin Secretos
              </h2>
              <div class="gossip-body-text" style="text-align: center; font-size: 20px; margin-top: 20px;">
                No hay chismes en esta categoría aún... ¡Sé el primero en subir uno!
              </div>
              <div class="margin-decor" style="margin-top: auto; padding-top: 25px;">
                Burn Book
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  @endif

</section>
@endsection

@push('page-scripts')
<script>
let currentGossipIndex = 0;
let activeCategory = 'fashion';

function openBook() {
  const book = document.getElementById('burn-book');
  if (book.classList.contains('closed')) {
    book.classList.remove('closed');
    book.classList.add('open');
  }
}

function closeBook() {
  const book = document.getElementById('burn-book');
  if (book.classList.contains('open')) {
    book.classList.remove('open');
    book.classList.add('closed');
  }
}

function filterGossips() {
  const spreads = document.querySelectorAll('.gossip-spread');
  let visibleIndex = 0;
  let firstVisibleIndex = -1;
  
  spreads.forEach((spread) => {
    if (spread.id === 'empty-category-message') return;
    
    const cat = spread.getAttribute('data-category');
    if (cat === activeCategory) {
       spread.setAttribute('data-visible-index', visibleIndex);
       if (firstVisibleIndex === -1) {
         firstVisibleIndex = visibleIndex;
       }
       visibleIndex++;
    } else {
       spread.removeAttribute('data-visible-index');
       spread.style.display = 'none';
       spread.classList.remove('active');
    }
  });

  return visibleIndex;
}

function showSecretSpread(visibleIdx) {
  const spreads = document.querySelectorAll('.gossip-spread');
  spreads.forEach((spread) => {
    if (spread.id === 'empty-category-message') return;
    
    const vIdx = spread.getAttribute('data-visible-index');
    if (vIdx !== null && parseInt(vIdx) === visibleIdx) {
      spread.classList.add('active');
      spread.style.display = 'flex';
    } else {
      spread.classList.remove('active');
      spread.style.display = 'none';
    }
  });
}

function nextSecret() {
  const total = filterGossips();
  if (total > 0) {
    currentGossipIndex = (currentGossipIndex + 1) % total;
    showSecretSpread(currentGossipIndex);
  }
}

function prevSecret() {
  const total = filterGossips();
  if (total > 0) {
    currentGossipIndex = (currentGossipIndex - 1 + total) % total;
    showSecretSpread(currentGossipIndex);
  }
}

function selectCategory(category, event) {
  if (event) {
    event.stopPropagation();
  }
  
  activeCategory = category;
  
  document.querySelectorAll('.book-tab').forEach(tab => {
    if (tab.getAttribute('data-category') === category) {
      tab.classList.add('active');
    } else {
      tab.classList.remove('active');
    }
  });
  
  openBook();
  
  currentGossipIndex = 0;
  const total = filterGossips();
  const emptyMsg = document.getElementById('empty-category-message');
  
  if (total > 0) {
    emptyMsg.style.display = 'none';
    emptyMsg.classList.remove('active');
    showSecretSpread(0);
  } else {
    emptyMsg.style.display = 'flex';
    emptyMsg.classList.add('active');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  filterGossips();
  const spreads = document.querySelectorAll('.gossip-spread');
  let firstFashionIndex = -1;
  spreads.forEach((spread, i) => {
    if (spread.getAttribute('data-category') === 'fashion') {
      if (firstFashionIndex === -1) firstFashionIndex = i;
    }
  });
  
  if (firstFashionIndex !== -1) {
    document.getElementById('secret-spread-' + firstFashionIndex).style.display = 'flex';
    document.getElementById('secret-spread-' + firstFashionIndex).classList.add('active');
  }
});
</script>
@endpush
