@extends('layouts.app')
@section('title', 'Memory Cues | LisThera')
@section('page-title', 'Memory Cues')
@section('content')
  <div class="panel" style="margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
    <div><h2>Eventos da sessão</h2><p>Observações rápidas registradas durante a sessão.</p></div>
    <div class="segmented"><span class="active">Hoje</span><span>Sessão</span><span>Histórico</span></div>
  </div>
  <div class="cue-grid">
    <div class="cue"><div><strong>Postura ajustada</strong><p>08:12 • Alinhamento corporal</p></div><span class="badge">Positivo</span></div>
    <div class="cue"><div><strong>Contato visual</strong><p>08:18 • Resposta ao comando</p></div><span class="badge">Positivo</span></div>
    <div class="cue"><div><strong>Fadiga aparente</strong><p>08:26 • Pausa recomendada</p></div><span class="badge" style="background:#fce8e8;color:#a12c2c">Atenção</span></div>
  </div>
@endsection
