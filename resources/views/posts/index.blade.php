@extends('layouts.app')

@section('title', 'Blog | Mean Girls Shop')

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Montserrat:wght@600&family=Be+Vietnam+Pro:wght@400;700&family=Great+Vibes&display=swap');

.blog-page {
  max-width: 1280px;
  margin: 0 auto;
  padding: 28px 20px 60px;
}

.hero {
  position: relative;
  background: rgba(255, 255, 255, 0.95);
  border: 2px solid #fff;
  border-radius: 2rem;
  box-shadow: 0 10px 40px rgba(179, 0, 106, 0.1);
  padding: 40px 24px;
  margin-bottom: 34px;
  text-align: center;
  overflow: hidden;
}

.silver-tape {
  position: absolute;
  width: 120px;
  height: 26px;
  background: linear-gradient(135deg, #e0e0e0 0%, #fff 50%, #bdbdbd 100%);
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.tape-a { top: -10px; left: -14px; transform: rotate(-44deg); }
.tape-b { bottom: -10px; right: -14px; transform: rotate(-44deg); }

.hero-bg {
  font-family: 'Syne', sans-serif;
  font-weight: 800;
  font-size: clamp(76px, 20vw, 210px);
  line-height: 0.9;
  margin: 0;
  color: transparent;
  -webkit-text-stroke: 1px #ffb0cd;
  opacity: 0.35;
  user-select: none;
}

.hero-main {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  gap: 8px;
}

.hero-main h1 {
  font-family: 'Great Vibes', cursive;
  color: #b3006a;
  font-size: clamp(42px, 8vw, 88px);
  margin: 0;
}

.hero-main p {
  max-width: 760px;
  color: #7a435c;
  font-family: 'Great Vibes', cursive;
  font-size: clamp(23px, 3.8vw, 42px);
  line-height: 1.3;
  margin: 0;
}

.posts-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
}

.post-card {
  background: #fff;
  border-radius: 2.5rem;
  border: 2px solid #ffb1c7;
  box-shadow: 0 8px 30px rgba(179, 0, 106, 0.1);
  overflow: hidden;
  transition: transform 0.45s ease, box-shadow 0.45s ease;
}

.post-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 45px rgba(179, 0, 106, 0.22);
}

.post-media {
  height: 240px;
  overflow: hidden;
  position: relative;
}

.post-media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.7s ease;
}

.post-card:hover .post-media img { transform: scale(1.08); }

.chip {
  position: absolute;
  right: 14px;
  top: 14px;
  background: #b3006a;
  color: #fff;
  font-family: 'Montserrat', sans-serif;
  font-size: 10px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  border-radius: 999px;
  padding: 5px 10px;
}

.post-body { padding: 20px; }

.post-meta {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px;
  color: #5b3f49;
  font-family: 'Montserrat', sans-serif;
  font-size: 11px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.dot {
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: #e3bdc8;
}

.post-body h2 {
  margin: 14px 0 12px;
  color: #b3006a;
  font-family: 'Syne', sans-serif;
  font-style: italic;
  font-size: 30px;
  line-height: 1.12;
}

.post-body p {
  margin: 0 0 20px;
  color: #5b3f49;
  font-family: 'Be Vietnam Pro', sans-serif;
  line-height: 1.55;
  font-size: 15px;
}

.read-link {
  display: inline-block;
  background: linear-gradient(180deg, #e00086 0%, #b3006a 100%);
  color: #fff;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 4px 15px rgba(224, 0, 134, 0.2);
  border-radius: 999px;
  padding: 11px 18px;
  text-decoration: none;
  font-family: 'Montserrat', sans-serif;
  font-size: 11px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.empty-state {
  border: 2px dashed #e3bdc8;
  border-radius: 1.5rem;
  padding: 30px;
  text-align: center;
  color: #6a364f;
  background: rgba(255, 255, 255, 0.65);
}

@media (max-width: 1024px) {
  .posts-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 720px) {
  .posts-grid { grid-template-columns: 1fr; }
  .hero { padding: 30px 18px; }
}
</style>
@endpush

@section('content')
<section class="blog-page" aria-label="Blog posts">
  <header class="hero">
    <span class="silver-tape tape-a" aria-hidden="true"></span>
    <span class="silver-tape tape-b" aria-hidden="true"></span>
    <h2 class="hero-bg">BLOG</h2>
    <div class="hero-main">
      <h1>Pink, Gossip & Trends</h1>
      <p>Inspiración de looks, novedades de temporada y tips para verte iconic todos los miércoles.</p>
    </div>
  </header>

  @if ($posts->isEmpty())
    <div class="empty-state">Todavía no hay notas publicadas.</div>
  @else
    <section class="posts-grid">
      @foreach ($posts as $post)
        <article class="post-card">
          <div class="post-media">
            <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
            @if ($loop->first)
              <span class="chip">New</span>
            @endif
          </div>
          <div class="post-body">
            <div class="post-meta">
              <span>{{ $post->category }}</span>
              <span class="dot" aria-hidden="true"></span>
              <span>{{ $post->author_name }}</span>
              <span class="dot" aria-hidden="true"></span>
              <span>{{ $post->readingTimeMinutes() }} min</span>
            </div>
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->excerpt }}</p>
            <a class="read-link" href="{{ route('posts.show', $post) }}">Leer nota</a>
          </div>
        </article>
      @endforeach
    </section>
  @endif
</section>
@endsection
