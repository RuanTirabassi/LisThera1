@extends('layouts.app')
@section('title', 'Praticantes | LisThera')
@section('page-title', 'Praticantes')
@section('content')
  <div class="panel" style="margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
    <div><h2>Lista de praticantes</h2><p>Visão geral de todos os praticantes cadastrados.</p></div>
    <div class="actions"><a href="{{ route('practitioners.create') }}">+ Novo praticante</a></div>
  </div>
  <div class="list">
    <div class="row">
      <div><strong>Maria Silva</strong><span>TEA • 8 anos • check-in pronto</span></div>
      <div class="actions"><a href="#">Ver ficha</a></div>
    </div>
    <div class="row">
      <div><strong>João Pedro</strong><span>PC • 10 anos • em triagem</span></div>
      <div class="actions"><a href="#">Ver ficha</a></div>
    </div>
    <div class="row">
      <div><strong>Ana Luiza</strong><span>TDAH • 12 anos • sessão concluída</span></div>
      <div class="actions"><a href="#">Ver ficha</a></div>
    </div>
  </div>
@endsection
