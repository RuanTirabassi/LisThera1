@extends('layouts.app')
@section('title', 'Dashboard | LisThera')
@section('page-title', 'Dashboard')
@section('content')
  <div class="hero">
    <div>
      <span class="badge">LisThera</span>
      <h2>Fluxo clínico para equoterapia</h2>
      <p>Protótipo visual para o TCC: cadastro de praticantes, triagem, sessão em arena e observações em tempo real.</p>
    </div>
  </div>
  <div class="grid cards" style="margin-top:20px">
    <article class="card"><h2>Praticantes</h2><p>12 cadastrados</p></article>
    <article class="card"><h2>Sessões hoje</h2><p>4 em andamento</p></article>
    <article class="card"><h2>Check-ins</h2><p>3 aguardando triagem</p></article>
    <article class="card"><h2>Cues registrados</h2><p>47 hoje</p></article>
  </div>
@endsection
