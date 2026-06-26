@extends('layouts.app')

@section('title', 'Burn Book | Gossip & Trends')

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Permanent+Marker&family=Special+Elite&family=Architects+Daughter&display=swap');

.blog-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px 80px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* --- BURN BOOK CONTAINER --- */
.book-wrapper {
  perspective: 1500px;
  width: 100%;
  max-width: 1060px;
  margin-top: 20px;
}

.burn-book {
  position: relative;
  width: 530px; /* Width of single page/cover */
  height: 700px;
  margin: 0 auto;
  transition: transform 1s ease, width 1s ease;
  transform-style: preserve-3d;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
  border-radius: 20px;
}

/* When the book is open, it doubles in width */
.burn-book.open {
  width: 1060px;
}

/* Cover Styling */
.book-cover {
  position: absolute;
  inset: 0;
  background: #e83e8c;
  border: 10px solid #d82b75;
  border-radius: 20px;
  padding: 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 10;
  backface-visibility: hidden;
  cursor: pointer;
  transition: transform 1s ease, box-shadow 0.3s;
  box-shadow: inset 0 0 40px rgba(0,0,0,0.2), 0 10px 25px rgba(0,0,0,0.2);
}

.book-cover:hover {
  transform: scale(1.02) rotate(-1deg);
  box-shadow: inset 0 0 40px rgba(0,0,0,0.2), 0 15px 35px rgba(216, 43, 117, 0.4);
}

/* Doodles drawn on cover */
.doodle-txt {
  position: absolute;
  font-family: 'Permanent Marker', cursive;
  color: #111;
  opacity: 0.85;
  font-size: 15px;
  user-select: none;
}
.doodle-txt.d1 { top: 40px; left: 50px; transform: rotate(-8deg); font-size: 18px; }
.doodle-txt.d2 { top: 50px; right: 50px; transform: rotate(10deg); }
.doodle-txt.d3 { bottom: 50px; left: 60px; transform: rotate(5deg); }
.doodle-txt.d4 { bottom: 60px; right: 70px; transform: rotate(-12deg); font-size: 20px; }
.doodle-txt.d5 { top: 180px; left: 30px; transform: rotate(-15deg); }

/* Ransom letter styling */
.ransom-row {
  display: flex;
  gap: 8px;
  margin: 15px 0;
}
.ransom-row.r1 { transform: rotate(-4deg); }
.ransom-row.r2 { transform: rotate(4deg); }

.ransom-letter {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 65px;
  height: 75px;
  font-family: 'Special Elite', monospace;
  font-size: 52px;
  font-weight: 900;
  text-transform: uppercase;
  box-shadow: 3px 5px 8px rgba(0,0,0,0.4);
  user-select: none;
}

.ransom-letter.dark {
  background: #111;
  color: #fff;
  transform: rotate(-5deg) translateY(5px);
  border: 1px solid #fff;
}
.ransom-letter.light {
  background: #fff;
  color: #111;
  transform: rotate(6deg) translateY(-4px);
  border: 1px solid #111;
}
.ransom-letter.skew1 { transform: rotate(12deg) translateY(2px) scale(1.1); }
.ransom-letter.skew2 { transform: rotate(-8deg) translateY(-6px) scale(0.95); }

/* Lipstick Mark */
.kiss-mark {
  width: 140px;
  height: 80px;
  margin: 20px 0;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 60"><path d="M 10 30 Q 30 15 50 25 Q 70 15 90 30 Q 75 42 50 35 Q 25 42 10 30 Z" fill="%23dc3545"/><path d="M 12 33 Q 32 48 50 42 Q 68 48 88 33 Q 73 58 50 50 Q 27 58 12 33 Z" fill="%23c82333"/></svg>');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.4));
  transform: rotate(-5deg);
  transition: 0.3s;
}
.kiss-mark:hover {
  transform: rotate(5deg) scale(1.08);
}

.open-instructions {
  margin-top: 30px;
  background: rgba(255,255,255,0.9);
  padding: 6px 14px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: bold;
  text-transform: uppercase;
  color: var(--hot-pink);
  border: 1px solid var(--hot-pink);
  animation: pulse 1.5s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

/* --- INSIDE BOOK LAYOUT --- */
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
  display: none; /* Hide cover when open */
}
.burn-book.open .book-inside {
  display: grid;
}

/* Center Spine of the Binder */
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
}

/* Lined Pages */
.book-page {
  position: relative;
  background: #fffdf5; /* Lined notebook paper tone */
  background-image: linear-gradient(rgba(0,0,0,0) 96%, #b4daf9 96%);
  background-size: 100% 28px;
  padding: 40px 35px;
  overflow-y: auto;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.book-page.left {
  border-right: 1px solid rgba(0,0,0,0.1);
  padding-right: 45px;
}
.book-page.right {
  border-left: 1px solid rgba(0,0,0,0.1);
  padding-left: 45px;
}

/* Page margin line */
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

/* Control buttons inside the book */
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

/* --- LEFT PAGE: INDEX --- */
.page-title {
  font-family: 'Permanent Marker', cursive;
  font-size: 28px;
  color: #111;
  margin-bottom: 24px;
  text-transform: uppercase;
  transform: rotate(-1.5deg);
  text-align: center;
}

.gossip-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 15px;
}

.gossip-item-btn {
  background: none;
  border: none;
  width: 100%;
  text-align: left;
  font-family: 'Architects Daughter', cursive;
  font-size: 16px;
  font-weight: bold;
  color: #222;
  padding: 10px;
  cursor: pointer;
  border-bottom: 1px dashed rgba(255, 79, 163, 0.2);
  transition: all 0.2s;
  display: flex;
  align-items: center;
  gap: 8px;
}
.gossip-item-btn:hover,
.gossip-item-btn.active {
  color: var(--hot-pink);
  background: rgba(255, 79, 163, 0.05);
  transform: translateX(4px);
  border-bottom-color: var(--hot-pink);
}

/* --- RIGHT PAGE: CONTENT --- */
.gossip-page-content {
  display: none;
  flex-direction: column;
  height: 100%;
  animation: pageFadeIn 0.4s ease forwards;
}
.gossip-page-content.active {
  display: flex;
}

@keyframes pageFadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Polaroid image card */
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

/* Tapes holding things */
.scrapbook-tape {
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%) rotate(-4deg);
  width: 90px;
  height: 26px;
  background: rgba(255, 230, 100, 0.4); /* Washi tape simulation */
  border-left: 2px dashed rgba(0,0,0,0.1);
  border-right: 2px dashed rgba(0,0,0,0.1);
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
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
  color: #002fa7; /* Blue pen ink */
  word-spacing: 1px;
}

/* Scrapbook Margin Doodles */
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

/* Responsive book */
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
  .book-spine {
    display: none;
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
        
        <!-- COVER PAGE -->
        <div class="book-cover" onclick="openBook()">
          <!-- Decorative Doodles -->
          <span class="doodle-txt d1">STAB ME!</span>
          <span class="doodle-txt d2">BIG HAIR!</span>
          <span class="doodle-txt d3">FAT ME...</span>
          <span class="doodle-txt d4">STAB!</span>
          <span class="doodle-txt d5">UGLY SKIRT</span>

          <!-- Ransom Row 1: BURN -->
          <div class="ransom-row r1">
            <span class="ransom-letter dark skew1">B</span>
            <span class="ransom-letter light skew2">U</span>
            <span class="ransom-letter dark">R</span>
            <span class="ransom-letter light skew1">N</span>
          </div>

          <!-- Lipstick Kiss SVG -->
          <div class="kiss-mark"></div>

          <!-- Ransom Row 2: BOOK -->
          <div class="ransom-row r2">
            <span class="ransom-letter light skew2">B</span>
            <span class="ransom-letter dark">O</span>
            <span class="ransom-letter light skew1">O</span>
            <span class="ransom-letter dark skew2">K</span>
          </div>

          <div class="open-instructions">Haz clic para abrir el libro...</div>
        </div>

        <!-- INSIDE BOOK PAGES -->
        <div class="book-inside">
          <button class="close-book-btn" onclick="closeBook()">✕ Cerrar Libro</button>
          
          <!-- Central Spine -->
          <div class="book-spine"></div>

          <!-- Left Page: Index of Secrets -->
          <div class="book-page left">
            <h3 class="page-title">Índice de Secretos</h3>
            <ul class="gossip-list">
              @foreach($posts as $index => $post)
                <li>
                  <button id="gossip-btn-{{ $index }}" class="gossip-item-btn {{ $index === 0 ? 'active' : '' }}" onclick="showSecret({{ $index }})">
                    💋 {{ $post->title }}
                  </button>
                </li>
              @endforeach
            </ul>
            <div class="margin-decor">★ Regina's Rules Apply ★</div>
          </div>

          <!-- Right Page: Secret Content -->
          <div class="book-page right">
            @foreach($posts as $index => $post)
              <div id="secret-content-{{ $index }}" class="gossip-page-content {{ $index === 0 ? 'active' : '' }}">
                
                <!-- Polaroid Photo Card -->
                <div class="scrapbook-polaroid">
                  <span class="scrapbook-tape"></span>
                  <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
                </div>

                <!-- Editorial Meta -->
                <div class="gossip-author-meta">
                  Por: {{ $post->author_name }} | {{ $post->category }}
                </div>

                <!-- Headline -->
                <h2 class="gossip-headline">
                  {{ $post->title }}
                </h2>

                <!-- Handwritten Body -->
                <div class="gossip-body-text">
                  {!! nl2br(e($post->content)) !!}
                </div>

                <!-- Footer Decor -->
                <div class="margin-decor" style="margin-top: 30px;">
                  Publicado: {{ $post->published_at?->format('d/m/Y') ?? 'Reciente' }}
                </div>
              </div>
            @endforeach
          </div>

        </div>

      </div>
    </div>
  @endif

</section>
@endsection

@push('page-scripts')
<script>
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

function showSecret(index) {
  // Hide all gossip contents
  const contents = document.querySelectorAll('.gossip-page-content');
  contents.forEach(content => {
    content.classList.remove('active');
  });

  // Deactivate all list buttons
  const buttons = document.querySelectorAll('.gossip-item-btn');
  buttons.forEach(btn => {
    btn.classList.remove('active');
  });

  // Activate selected content and button
  document.getElementById('secret-content-' + index).classList.add('active');
  document.getElementById('gossip-btn-' + index).classList.add('active');
}
</script>
@endpush
