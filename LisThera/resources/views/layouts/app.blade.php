<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'LisThera')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">L</div>
      <div><strong>LisThera</strong><p>Protótipo TCC</p></div>
    </div>
    <nav class="nav">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('practitioners.index') }}">Praticantes</a>
      <a href="{{ route('checkins.index') }}">Triagem</a>
      <a href="{{ route('sessions.index') }}">Sessões</a>
      <a href="#">Cues</a>
    </nav>
  </aside>
  <main class="main">
    <header class="topbar">
      <h1>@yield('page-title', 'Dashboard')</h1>
      <div class="topbar-actions">
        <span class="pill">TCC</span>
        <span class="pill muted">Vite</span>
      </div>
    </header>
    <section class="content">@yield('content')</section>
  </main>
</div>
</body>
</html>
