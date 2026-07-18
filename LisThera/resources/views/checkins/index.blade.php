@extends('layouts.app')
@section('title', 'Triagem | LisThera')
@section('page-title', 'Triagem')
@section('content')
  <div class="panel" style="margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
    <div><h2>Check-ins do dia</h2><p>Acompanhe os check-ins antes de cada sessão.</p></div>
    <div class="actions"><a href="{{ route('checkins.create') }}">+ Novo check-in</a></div>
  </div>
  <div class="timeline">
    <div class="event"><div><strong>Maria Silva</strong><p>Entrada confirmada às 08:10</p></div><span class="badge">Apto</span></div>
    <div class="event"><div><strong>João Pedro</strong><p>Em avaliação às 08:25</p></div><span class="badge">Pendente</span></div>
    <div class="event"><div><strong>Ana Luiza</strong><p>Não compareceu</p></div><span class="badge" style="background:#fce8e8;color:#a12c2c">Ausente</span></div>
  </div>
@endsection
