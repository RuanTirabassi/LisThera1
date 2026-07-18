@extends('layouts.app')
@section('title', 'Nova Sessão | LisThera')
@section('page-title', 'Nova Sessão')
@section('content')
  <div class="panel" style="margin-bottom:16px"><h2>Iniciar sessão</h2><p>Selecione praticante, terapeuta, cavalo e arena para a sessão.</p></div>
  <form class="form" method="POST" action="{{ route('sessions.store') }}">
    @csrf
    <div class="field"><label>Praticante</label><select name="practitioner_id"><option>Maria Silva</option><option>João Pedro</option></select></div>
    <div class="field"><label>Terapeuta</label><select name="therapist_id"><option>Dra. Camila</option><option>Dr. Lucas</option></select></div>
    <div class="field"><label>Cavalo</label><select name="horse_id"><option>Estrela</option><option>Trovão</option></select></div>
    <div class="field"><label>Arena</label><select name="arena_id"><option>Arena 1</option><option>Arena 2</option></select></div>
    <button type="submit" class="btn-primary">Iniciar sessão</button>
  </form>
@endsection
