<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Mean Girls Shop')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,800;1,800&family=Parisienne&family=Inter:wght@400;900&display=swap" rel="stylesheet">
<style>
:root {
  --hot-pink: #ff4fa3;
  --soft-pink: #fde6ef;
  --text-dark: #333;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Inter', sans-serif;
  background: radial-gradient(circle, #ffffff 0%, #fbc2eb 100%);
  min-height: 100vh;
  overflow-x: hidden;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background: white;
  border-bottom: 1px solid var(--soft-pink);
  position: sticky;
  top: 0;
  z-index: 100;
}

.logo {
  font-weight: 900;
  color: var(--hot-pink);
  font-size: 14px;
  text-decoration: none;
}

.nav-links {
  display: flex;
  gap: 18px;
  align-items: center;
}

.nav-links a {
  text-decoration: none;
  color: #555;
  font-weight: bold;
  font-size: 12px;
  text-transform: uppercase;
  transition: 0.3s;
}

.nav-links a:hover,
.nav-links a.active {
  color: var(--hot-pink);
}

.page-wrap {
  width: 100%;
}

.badge-pill {
  background: var(--soft-pink);
  color: var(--hot-pink);
  border: 1px solid var(--hot-pink);
  border-radius: 25px;
  display: inline-block;
  font-size: 12px;
  font-weight: 800;
  padding: 6px 14px;
}

.card-frame {
  background: rgba(255, 255, 255, 0.4);
  border: 2px solid var(--hot-pink);
  border-radius: 25px;
  padding: 14px;
}

/* --- CART PANEL STYLES --- */
#cart-panel {
  position: fixed;
  right: -360px;
  top: 80px;
  width: 340px;
  background: white;
  border: 3px solid var(--hot-pink);
  border-radius: 30px 0 0 30px;
  padding: 20px;
  z-index: 190;
  transition: 0.5s ease;
  box-shadow: -10px 10px 40px rgba(0,0,0,0.1);
  color: var(--text-dark);
}

#cart-panel.open {
  right: 0;
}

.cart-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.cart-head h3 {
  color: var(--hot-pink);
  font-family: 'Playfair Display';
  font-style: italic;
}

.cart-list {
  max-height: 320px;
  overflow-y: auto;
}

.cart-item {
  border: 1px solid #ffd3e7;
  border-radius: 12px;
  padding: 8px;
  margin-bottom: 8px;
  text-align: left;
}

.cart-item p {
  margin: 3px 0;
  font-size: 12px;
  color: #333;
}

.tiny-btn {
  border: 1px solid var(--hot-pink);
  color: var(--hot-pink);
  background: white;
  border-radius: 8px;
  padding: 4px 8px;
  cursor: pointer;
  font-size: 11px;
  font-weight: bold;
}

#cart-toggle {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--hot-pink);
  font-weight: 900;
  font-size: 14px;
}
</style>
@stack('page-styles')
</head>
<body>
<header>
  <a href="{{ route('home') }}" class="logo">MEAN GIRLS</a>
  <nav class="nav-links" aria-label="Main navigation">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Outfits</a>
    <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Blog</a>
    
    @auth
      @if(auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" style="color: var(--hot-pink); font-weight: 900;">Admin</a>
      @endif
      <span style="font-size: 11px; font-weight: bold; color: #777; text-transform: uppercase;">
        {{ auth()->user()->name }}
      </span>
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Salir
      </a>
      <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
      </form>
    @else
      <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Ingresar</a>
      <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Registro</a>
    @endauth
  </nav>
  
  <button id="cart-toggle" class="logo">🛒 <span id="cart-count">0</span></button>
</header>

<main class="page-wrap">
  @yield('content')
</main>

<!-- GLOBAL CART PANEL -->
<aside id="cart-panel" aria-label="Cart panel">
  <div class="cart-head">
    <h3>Tu Carrito</h3>
    <button class="tiny-btn" onclick="clearCart()">Vaciar</button>
  </div>
  <div id="cart-list" class="cart-list"></div>
  <p style="margin-top:10px; font-weight:900; color:var(--hot-pink); text-align: left;">Total: <span id="cart-total">$0.00</span></p>
</aside>

<script>
const cartRoutes = {
  summary: "{{ route('cart.summary') }}",
  add: "{{ route('cart.add') }}",
  remove: "{{ route('cart.remove') }}",
  clear: "{{ route('cart.clear') }}",
};

function formatPrice(price) {
  return '$' + Number(price).toFixed(2);
}

async function cartRequest(url, payload = null) {
  const options = {
    method: payload ? 'POST' : 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  };

  if (payload) {
    options.body = JSON.stringify(payload);
  }

  const response = await fetch(url, options);
  return response.json();
}

function renderCart(cart) {
  document.getElementById('cart-count').innerText = cart.count;
  document.getElementById('cart-total').innerText = formatPrice(cart.total);

  const list = document.getElementById('cart-list');
  if (!cart.items.length) {
    list.innerHTML = '<p style="font-size:12px; color:#777;">Tu carrito está vacío.</p>';
    return;
  }

  list.innerHTML = cart.items.map(item => `
    <div class="cart-item">
      <p><strong>${item.name}</strong></p>
      <p>Cant: ${item.quantity}</p>
      <p>${formatPrice(item.price)} c/u</p>
      <button class="tiny-btn" style="margin-top: 5px;" data-remove="${item.sku}">Quitar</button>
    </div>
  `).join('');
}

async function loadCart() {
  const cart = await cartRequest(cartRoutes.summary);
  renderCart(cart);
}

async function removeFromCart(sku) {
  const cart = await cartRequest(cartRoutes.remove, { sku });
  renderCart(cart);
}

async function clearCart() {
  const cart = await cartRequest(cartRoutes.clear, {});
  renderCart(cart);
}

document.getElementById('cart-toggle').addEventListener('click', () => {
  document.getElementById('cart-panel').classList.toggle('open');
});

document.getElementById('cart-list').addEventListener('click', (event) => {
  const sku = event.target.getAttribute('data-remove');
  if (sku) {
    removeFromCart(sku);
  }
});

// Load cart on load
loadCart();
</script>
@stack('page-scripts')
</body>
</html>
