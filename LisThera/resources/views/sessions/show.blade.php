@extends('layouts.app')
@section('title', 'Sessão Ativa | LisThera')
@section('page-title', 'Sessão em Arena')
@section('content')
  <div class="grid cards" style="margin-bottom:16px">
    <article class="card"><h2>Praticante</h2><p>Maria Silva</p></article>
    <article class="card"><h2>Terapeuta</h2><p>Dra. Camila</p></article>
    <article class="card"><h2>Cavalo</h2><p>Estrela</p></article>
    <article class="card"><h2>Arena</h2><p>Arena 1</p></article>
  </div>
  <div class="panel">
    <h2 style="margin-bottom:12px">Memory cues registrados</h2>
    <div class="timeline">
      <div class="event"><div><strong>Postura ajustada</strong><p>Alinhamento corporal observado</p></div><span class="badge">10:12</span></div>
      <div class="event"><div><strong>Contato visual</strong><p>Resposta ativa ao comando verbal</p></div><span class="badge">10:18</span></div>
      <div class="event"><div><strong>Fadiga aparente</strong><p>Pausa recomendada pelo terapeuta</p></div><span class="badge" style="background:#fce8e8;color:#a12c2c">10:26</span></div>
    </div>
  </div>
@endsection
