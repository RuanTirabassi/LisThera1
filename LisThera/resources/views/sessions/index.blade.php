@extends('layouts.app')
@section('title', 'Sessões | LisThera')
@section('page-title', 'Sessões')
@section('content')
  <div class="panel" style="margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
    <div><h2>Sessões de hoje</h2><p>Acompanhe o andamento das sessões na arena.</p></div>
    <div class="actions"><a href="{{ route('sessions.create') }}">+ Nova sessão</a></div>
  </div>
  <div class="timeline">
    <div class="event"><div><strong>Maria Silva + Dra. Camila + Estrela</strong><p>Arena 1 • 08:00–08:45</p></div><span class="badge">Concluída</span></div>
    <div class="event"><div><strong>João Pedro + Dr. Lucas + Trovão</strong><p>Arena 2 • 09:00–09:45</p></div><span class="badge" style="background:#fff3e0;color:#a05a00">Em andamento</span></div>
  </div>
@endsection
