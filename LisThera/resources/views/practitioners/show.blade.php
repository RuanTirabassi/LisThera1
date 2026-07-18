@extends('layouts.app')
@section('title', 'Ficha do Praticante | LisThera')
@section('page-title', 'Ficha do Praticante')
@section('content')
  <div class="grid cards" style="margin-bottom:16px">
    <article class="card"><h2>Praticante</h2><p>Maria Silva</p></article>
    <article class="card"><h2>Idade / CID</h2><p>8 anos • TEA</p></article>
    <article class="card"><h2>Responsável</h2><p>Juliana Silva (mãe)</p></article>
    <article class="card"><h2>Status</h2><p>Pronto para sessão</p></article>
  </div>
  <div class="panel">
    <h2>Histórico clínico</h2>
    <p style="margin-top:8px">Espaço para diagnósticos, histórico, observações e evolução longitudinal por sessão.</p>
  </div>
@endsection
