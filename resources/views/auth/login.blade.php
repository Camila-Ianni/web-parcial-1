<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,800;1,800&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
<style>
:root { --hot-pink: #ff4fa3; --soft-pink: #fde6ef; }
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Inter', sans-serif;
  background: radial-gradient(circle, #ffffff 0%, #fbc2eb 100%);
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: 20px;
}
.card {
  width: 100%;
  max-width: 420px;
  background: rgba(255, 255, 255, 0.9);
  border: 2px solid var(--hot-pink);
  border-radius: 26px;
  padding: 26px;
}
h1 {
  font-family: 'Playfair Display', serif;
  color: var(--hot-pink);
  font-size: 42px;
  margin-bottom: 10px;
}
p { color: #666; margin-bottom: 16px; }
label { display: block; font-size: 12px; font-weight: 700; color: #555; margin-top: 12px; }
input {
  width: 100%;
  border: 1px solid #e2b0c7;
  border-radius: 10px;
  padding: 10px;
  margin-top: 6px;
}
button {
  width: 100%;
  margin-top: 18px;
  border: none;
  border-radius: 12px;
  padding: 12px;
  font-weight: 900;
  background: var(--hot-pink);
  color: white;
  cursor: pointer;
}
.error { color: #c91c5d; font-size: 12px; margin-top: 8px; }
.small { margin-top: 10px; font-size: 12px; color: #666; }
a { color: var(--hot-pink); text-decoration: none; }
</style>
</head>
<body>
  <section class="card">
    <h1>Admin Login</h1>
    <p>Ingresa para gestionar blog y outfits.</p>

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>

      <label for="password">Password</label>
      <input id="password" type="password" name="password" required>

      <button type="submit">Ingresar</button>

      @error('email')
        <p class="error">{{ $message }}</p>
      @enderror
    </form>

    <p class="small">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
    <p class="small">Volver al sitio: <a href="{{ route('home') }}">Home</a></p>
  </section>
</body>
</html>
