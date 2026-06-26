<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro | Mean Girls</title>
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
  max-width: 440px;
  background: rgba(255, 255, 255, 0.9);
  border: 2px solid var(--hot-pink);
  border-radius: 26px;
  padding: 26px;
  box-shadow: 0 10px 30px rgba(255, 79, 163, 0.15);
}
h1 {
  font-family: 'Playfair Display', serif;
  color: var(--hot-pink);
  font-size: 38px;
  margin-bottom: 6px;
  text-align: center;
}
p.subtitle {
  color: #666;
  margin-bottom: 16px;
  text-align: center;
  font-size: 14px;
}
label { display: block; font-size: 12px; font-weight: 700; color: #555; margin-top: 12px; }
input {
  width: 100%;
  border: 1px solid #e2b0c7;
  border-radius: 10px;
  padding: 10px;
  margin-top: 6px;
  font-size: 14px;
  outline: none;
  transition: border-color 0.2s;
}
input:focus {
  border-color: var(--hot-pink);
}
button {
  width: 100%;
  margin-top: 22px;
  border: none;
  border-radius: 12px;
  padding: 12px;
  font-weight: 900;
  background: var(--hot-pink);
  color: white;
  cursor: pointer;
  font-size: 15px;
  transition: transform 0.1s, opacity 0.2s;
}
button:hover {
  opacity: 0.9;
}
button:active {
  transform: scale(0.98);
}
.error-list {
  background: #fff3f7;
  border: 1px solid #ffccd8;
  border-radius: 10px;
  padding: 12px 16px;
  margin-top: 16px;
  color: #c91c5d;
  font-size: 12px;
  list-style-type: disc;
  list-style-position: inside;
}
.small { margin-top: 18px; font-size: 13px; color: #666; text-align: center; }
a { color: var(--hot-pink); text-decoration: none; font-weight: bold; }
a:hover { text-decoration: underline; }
</style>
</head>
<body>
  <section class="card">
    <h1>Crear Cuenta</h1>
    <p class="subtitle">Únete a The Plastics y curá tus mejores looks.</p>

    <form method="POST" action="{{ route('register.attempt') }}">
      @csrf
      <label for="name">Nombre</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>

      <label for="password">Password</label>
      <input id="password" type="password" name="password" required>

      <label for="password_confirmation">Confirmar Password</label>
      <input id="password_confirmation" type="password" name="password_confirmation" required>

      <button type="submit">Registrarse</button>
    </form>

    @if($errors->any())
      <ul class="error-list">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <p class="small">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    <p class="small" style="margin-top: 8px;"><a href="{{ route('home') }}">Volver al sitio</a></p>
  </section>
</body>
</html>
