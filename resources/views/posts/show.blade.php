@extends('layouts.app')

@section('title', $post->title . ' | Blog')

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Montserrat:wght@600&family=Be+Vietnam+Pro:wght@400;700&family=Great+Vibes&display=swap');

.post-detail {
  max-width: 1020px;
  margin: 0 auto;
  padding: 30px 20px 70px;
}

.back-link {
  display: inline-block;
  margin-bottom: 18px;
  background: #fff;
  border: 2px solid #ffb1c7;
  border-radius: 999px;
  padding: 8px 14px;
  color: #b3006a;
  font-family: 'Montserrat', sans-serif;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  text-decoration: none;
}

.back-link:hover {
  background: #fff0f6;
}

.post-detail article {
  border-radius: 2.5rem;
  border: 2px solid #ffb1c7;
  box-shadow: 0 10px 35px rgba(179, 0, 106, 0.16);
  overflow: hidden;
  background: #fff;
}

.hero-image {
  position: relative;
  height: min(50vh, 420px);
}

.hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.chip {
  position: absolute;
  left: 18px;
  top: 18px;
  background: #b3006a;
  color: #fff;
  border-radius: 999px;
  padding: 5px 10px;
  font-family: 'Montserrat', sans-serif;
  font-size: 10px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.post-kicker {
  font-family: 'Montserrat', sans-serif;
  font-size: 11px;
  color: #6a364f;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  margin: 0 0 12px;
}

.post-headline {
  margin: 0 0 14px;
  color: #b3006a;
  font-family: 'Syne', sans-serif;
  font-style: italic;
  font-size: clamp(34px, 6vw, 62px);
  line-height: 1.03;
}

.post-content {
  padding: 26px 24px 30px;
}

.meta {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  align-items: center;
  color: #5b3f49;
  font-family: 'Montserrat', sans-serif;
  font-size: 11px;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  margin-bottom: 18px;
}

.dot {
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: #e3bdc8;
}

.body {
  color: #5b3f49;
  font-family: 'Be Vietnam Pro', sans-serif;
  font-size: 16px;
  line-height: 1.8;
}

.body p + p { margin-top: 12px; }

@media (max-width: 720px) {
  .post-content { padding: 20px 18px 24px; }
}
</style>
@endpush

@section('content')
<section class="post-detail" aria-label="Post detail">
  <a class="back-link" href="{{ route('posts.index') }}">← Volver al blog</a>
  <article>
    <div class="hero-image">
      <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
      <span class="chip">{{ $post->category }}</span>
    </div>
    <div class="post-content">
      <header>
        <p class="post-kicker">The Plastics Editorial</p>
        <h1 class="post-headline">{{ $post->title }}</h1>
        <div class="meta">
          <span>{{ $post->author_name }}</span>
          <span class="dot" aria-hidden="true"></span>
          <span>{{ $post->published_at?->format('d/m/Y') }}</span>
          <span class="dot" aria-hidden="true"></span>
          <span>{{ $post->readingTimeMinutes() }} min</span>
        </div>
      </header>
      <div class="body">{!! nl2br(e($post->content)) !!}</div>
    </div>
  </article>
</section>
@endsection
