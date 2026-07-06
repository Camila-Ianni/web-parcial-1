<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Mean Girls Edit') - Admin Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,800;1,800&family=Parisienne&family=Inter:wght@400;700;900&family=Outfit:wght@300;600;900&display=swap" rel="stylesheet">
<style>
:root {
  --hot-pink: #ff4fa3;
  --soft-pink: #fde6ef;
  --bubblegum: #ff85c0;
  --dark-magenta: #701c45;
  --ink: #3a223c;
  --glass-bg: rgba(255, 255, 255, 0.85);
  --glass-border: rgba(255, 79, 163, 0.3);
}

* { box-sizing: border-box; margin: 0; padding: 0; }


::-webkit-scrollbar {
  width: 10px;
}
::-webkit-scrollbar-track {
  background: var(--soft-pink);
}
::-webkit-scrollbar-thumb {
  background: var(--hot-pink);
  border-radius: 5px;
}
::-webkit-scrollbar-thumb:hover {
  background: var(--dark-magenta);
}

body {
  font-family: 'Outfit', sans-serif;
  background: 
    radial-gradient(circle at 20% 30%, rgba(255, 230, 240, 0.8) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(251, 194, 235, 0.9) 0%, transparent 60%),
    linear-gradient(135deg, #ffffff 0%, #ffd3e8 100%);
  background-attachment: fixed;
  min-height: 100vh;
  color: var(--ink);
}

header {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  border-bottom: 2px solid var(--soft-pink);
  padding: 16px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 4px 20px rgba(255, 79, 163, 0.08);
}

.logo {
  font-family: 'Playfair Display', serif;
  font-style: italic;
  color: var(--hot-pink);
  font-weight: 900;
  text-decoration: none;
  font-size: 24px;
  text-shadow: 2px 2px 0px rgba(255, 230, 240, 0.8);
  letter-spacing: -0.5px;
  transition: 0.3s;
}
.logo span {
  font-family: 'Parisienne', cursive;
  font-size: 28px;
  color: var(--dark-magenta);
  margin-left: 5px;
}
.logo:hover {
  transform: scale(1.03) rotate(-1deg);
}

main {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px 20px 60px;
}

h1 {
  font-family: 'Playfair Display', serif;
  font-style: italic;
  color: var(--dark-magenta);
  font-size: 52px;
  margin-bottom: 8px;
  text-shadow: 3px 3px 0px white;
  position: relative;
  display: inline-block;
}

h1::after {
  content: ' ✦';
  color: var(--hot-pink);
  font-size: 24px;
  vertical-align: super;
}

h2 {
  font-family: 'Playfair Display', serif;
  font-style: italic;
  color: var(--hot-pink);
  font-size: 24px;
  margin-bottom: 12px;
}

.panel {
  background: var(--glass-bg);
  backdrop-filter: blur(12px);
  border: 2px solid var(--glass-border);
  border-radius: 30px;
  padding: 26px;
  box-shadow: 0 10px 40px rgba(255, 79, 163, 0.12);
  margin-bottom: 24px;
  transition: 0.3s ease;
}
.panel:hover {
  box-shadow: 0 15px 45px rgba(255, 79, 163, 0.18);
  border-color: var(--hot-pink);
}

.tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 24px;
}

.btn,
button.btn,
a.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: 2px solid var(--hot-pink);
  color: var(--hot-pink);
  background: white;
  padding: 10px 20px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 800;
  cursor: pointer;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: 0 4px 10px rgba(255, 79, 163, 0.05);
}

.btn:hover {
  transform: translateY(-2px) scale(1.02);
  background: var(--soft-pink);
  box-shadow: 0 6px 15px rgba(255, 79, 163, 0.15);
}

.btn.primary {
  background: linear-gradient(135deg, var(--hot-pink) 0%, var(--bubblegum) 100%);
  color: white;
  border: none;
}
.btn.primary:hover {
  background: linear-gradient(135deg, var(--bubblegum) 0%, var(--hot-pink) 100%);
}

.btn.danger {
  border-color: #e53e3e;
  color: #e53e3e;
}
.btn.danger:hover {
  background: #fff5f5;
  box-shadow: 0 6px 15px rgba(229, 62, 62, 0.15);
}

.status {
  margin-bottom: 18px;
  color: #2f855a;
  background: #f0fff4;
  border: 1px solid #c6f6d5;
  padding: 12px 18px;
  border-radius: 16px;
  font-weight: bold;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.table-wrap {
  overflow-x: auto;
  border-radius: 20px;
  border: 1px solid #ffd3e8;
}

table {
  width: 100%;
  border-collapse: collapse;
  background: white;
}

th, td {
  padding: 16px 20px;
  text-align: left;
  font-size: 14px;
  border-bottom: 1px solid #fdeef5;
}

th {
  background: var(--soft-pink);
  color: var(--dark-magenta);
  font-weight: 900;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

tr:hover td {
  background: #fffcfd;
}

.actions {
  display: flex;
  gap: 8px;
  align-items: center;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
}

.field-full {
  grid-column: 1 / -1;
}

label {
  display: block;
  font-size: 13px;
  font-weight: 800;
  color: var(--dark-magenta);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

input, textarea, select {
  width: 100%;
  border: 2px solid #ecb8d2;
  border-radius: 14px;
  padding: 12px;
  font-size: 14px;
  font-family: inherit;
  background: #fff;
  transition: 0.2s;
  outline: none;
}

input:focus, textarea:focus, select:focus {
  border-color: var(--hot-pink);
  box-shadow: 0 0 0 4px rgba(255, 79, 163, 0.15);
}

textarea { min-height: 150px; resize: vertical; }

.checkbox {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
}

.checkbox input {
  width: auto;
  cursor: pointer;
}

.errors {
  margin-top: 18px;
  background: #fff5f5;
  border: 1px solid #fed7d7;
  padding: 14px 20px;
  border-radius: 16px;
  color: #c53030;
  font-size: 14px;
  list-style-position: inside;
}

.top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

@media (max-width: 780px) {
  .form-grid { grid-template-columns: 1fr; }
  h1 { font-size: 38px; }
}


.fashion-quote-card {
  background: linear-gradient(135deg, var(--soft-pink) 0%, #fff 100%);
  border: 2px dashed var(--hot-pink);
  border-radius: 24px;
  padding: 20px;
  margin-top: 30px;
  text-align: center;
}
.fashion-quote-card p {
  font-family: 'Playfair Display', serif;
  font-style: italic;
  color: var(--dark-magenta);
  font-size: 18px;
  font-weight: 700;
  line-height: 1.4;
}
.fashion-quote-card span {
  font-family: 'Inter', sans-serif;
  font-size: 11px;
  text-transform: uppercase;
  color: var(--hot-pink);
  font-weight: 900;
  display: block;
  margin-top: 8px;
  letter-spacing: 0.1em;
}
</style>
</head>
<body>
<header>
  <a class="logo" href="{{ route('admin.dashboard') }}">THE PLASTICS<span>edit</span></a>
  <nav style="display: flex; gap: 15px; align-items: center;">
    <a href="{{ route('home') }}" class="btn" style="border-color: var(--bubblegum); color: var(--bubblegum);">Ver sitio</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn" type="submit" style="background: var(--hot-pink); color: white; border: none;">Salir</button>
    </form>
  </nav>
</header>
<main>
  @yield('content')

  
  <div class="fashion-quote-card">
    <p>"On Wednesdays we wear pink, but in this editor panel, we curate the most iconic Y2K fashion trends."</p>
    <span>★ Regina's Rules for plastics editorial board ★</span>
  </div>
</main>
</body>
</html>
