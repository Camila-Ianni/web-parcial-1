<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Panel')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,800;1,800&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
<style>
:root {
  --hot-pink: #ff4fa3;
  --soft-pink: #fde6ef;
  --ink: #4f4450;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Inter', sans-serif;
  background: radial-gradient(circle, #ffffff 0%, #fbc2eb 100%);
  min-height: 100vh;
  color: var(--ink);
}
header {
  background: white;
  border-bottom: 1px solid var(--soft-pink);
  padding: 14px 22px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.logo {
  color: var(--hot-pink);
  font-weight: 900;
  text-decoration: none;
}
main {
  max-width: 1040px;
  margin: 0 auto;
  padding: 28px 20px 40px;
}
h1 {
  font-family: 'Playfair Display', serif;
  color: var(--hot-pink);
  font-size: 46px;
  margin-bottom: 14px;
}
h2 {
  color: var(--hot-pink);
  font-size: 20px;
  margin-bottom: 8px;
}
.panel {
  background: rgba(255, 255, 255, 0.85);
  border: 2px solid var(--hot-pink);
  border-radius: 22px;
  padding: 18px;
}
.tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 16px;
}
.btn,
button.btn,
a.btn {
  display: inline-block;
  border: 1px solid var(--hot-pink);
  color: var(--hot-pink);
  background: white;
  padding: 9px 14px;
  border-radius: 11px;
  text-decoration: none;
  font-weight: 800;
  cursor: pointer;
  font-size: 13px;
  transition: 0.2s ease;
}
.btn:hover { transform: translateY(-1px); }
.btn.primary {
  background: var(--hot-pink);
  color: white;
}
.btn.danger {
  border-color: #d73f77;
  color: #d73f77;
}
.status {
  margin-bottom: 12px;
  color: #1f7a4b;
  font-weight: 700;
}
.table-wrap {
  overflow-x: auto;
  border-radius: 14px;
}
table {
  width: 100%;
  border-collapse: collapse;
  background: white;
}
th, td {
  border-bottom: 1px solid #f3d7e6;
  padding: 10px;
  text-align: left;
  font-size: 14px;
}
th {
  color: var(--hot-pink);
  font-weight: 900;
  font-size: 12px;
  text-transform: uppercase;
}
.actions {
  display: flex;
  gap: 8px;
  align-items: center;
}
.form-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.field-full {
  grid-column: 1 / -1;
}
label {
  display: block;
  font-size: 12px;
  font-weight: 800;
  color: #7c5367;
  margin-bottom: 5px;
}
input, textarea {
  width: 100%;
  border: 1px solid #ecb8d2;
  border-radius: 10px;
  padding: 10px;
  font-size: 14px;
  background: #fff;
}
textarea { min-height: 110px; }
.checkbox {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
}
.errors {
  margin-top: 12px;
  color: #b02158;
  font-size: 13px;
  padding-left: 18px;
}
.top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
@media (max-width: 780px) {
  .form-grid { grid-template-columns: 1fr; }
  h1 { font-size: 34px; }
}
</style>
</head>
<body>
<header>
  <a class="logo" href="{{ route('admin.dashboard') }}">ADMIN PANEL</a>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn" type="submit">Cerrar sesion</button>
  </form>
</header>
<main>
  @yield('content')
</main>
</body>
</html>
