@extends('layouts.app')

@section('title', $post->title . ' | Gossip Detail')

@push('page-styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Permanent+Marker&family=Architects+Daughter&display=swap');

.post-detail-page {
  max-width: 760px;
  margin: 40px auto 80px;
  padding: 0 20px;
}

.back-link-tag {
  display: inline-block;
  margin-bottom: 20px;
  background: white;
  border: 2px solid var(--hot-pink);
  border-radius: 50px;
  padding: 8px 18px;
  color: var(--hot-pink);
  font-family: 'Architects Daughter', cursive;
  font-size: 13px;
  font-weight: bold;
  text-decoration: none;
  transition: 0.2s;
  box-shadow: 0 4px 10px rgba(255, 79, 163, 0.1);
}
.back-link-tag:hover {
  background: var(--soft-pink);
  transform: translateX(-3px);
}


.scrapbook-page {
  position: relative;
  background: #fffdf5;
  background-image: linear-gradient(rgba(0,0,0,0) 96%, #b4daf9 96%);
  background-size: 100% 28px;
  padding: 50px 40px;
  border: 8px solid #d82b75;
  border-radius: 20px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
  display: flex;
  flex-direction: column;
}


.scrapbook-page::before {
  content: '';
  position: absolute;
  top: 0; bottom: 0;
  left: 30px;
  width: 2px;
  background: #ffb1c7;
  z-index: 2;
}


.scrapbook-polaroid {
  background: white;
  padding: 12px 12px 30px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  transform: rotate(-2deg);
  width: 280px;
  align-self: center;
  margin-bottom: 30px;
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
  width: 100px;
  height: 26px;
  background: rgba(255, 230, 100, 0.4);
  border-left: 2px dashed rgba(0,0,0,0.1);
  border-right: 2px dashed rgba(0,0,0,0.1);
}

.gossip-meta {
  font-family: 'Permanent Marker', cursive;
  font-size: 12px;
  color: var(--hot-pink);
  letter-spacing: 0.15em;
  text-transform: uppercase;
  margin-bottom: 8px;
  text-align: center;
}

.gossip-title {
  font-family: 'Permanent Marker', cursive;
  font-size: 32px;
  color: #111;
  line-height: 1.2;
  margin-bottom: 20px;
  text-align: center;
  transform: rotate(-0.5deg);
}

.gossip-body {
  font-family: 'Caveat', cursive;
  font-size: 26px;
  line-height: 1.3;
  color: #002fa7; 
  word-spacing: 1px;
  margin-top: 10px;
}

.margin-decor {
  font-size: 11px;
  color: #888;
  font-family: 'Architects Daughter', cursive;
  text-transform: uppercase;
  margin-top: 40px;
  padding-top: 20px;
  text-align: center;
  border-top: 1px dashed #ccc;
  user-select: none;
}
</style>
@endpush

@section('content')
<section class="post-detail-page">
  
  <a class="back-link-tag" href="{{ route('posts.index') }}">← Volver al Burn Book</a>

  <article class="scrapbook-page">
    
    
    <div class="scrapbook-polaroid">
      <span class="scrapbook-tape"></span>
      <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}">
    </div>

    
    <div class="gossip-meta">
      Secret por: {{ $post->author_name }} | {{ $post->category->name }}
    </div>

    
    <h1 class="gossip-title">
      {{ $post->title }}
    </h1>

    
    <div class="gossip-body">
      {!! nl2br(e($post->content)) !!}
    </div>

    
    <div class="margin-decor">
      Publicado: {{ $post->published_at?->format('d/m/Y') ?? 'Reciente' }}
    </div>

  </article>

</section>
@endsection
