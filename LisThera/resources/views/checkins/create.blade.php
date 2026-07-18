@extends('layouts.app')
@section('title', 'Novo Check-in | LisThera')
@section('page-title', 'Novo Check-in')
@section('content')
  <div class="panel" style="margin-bottom:16px"><h2>Triagem de entrada</h2><p>Avalie as condições do praticante antes da sessão.</p></div>
  <form class="form" method="POST" action="{{ route('checkins.store') }}">
    @csrf
    <div class="field"><label>Praticante</label>
      <select name="practitioner_id">
        <option value="1">Maria Silva</option>
        <option value="2">João Pedro</option>
        <option value="3">Ana Luiza</option>
      </select>
    </div>
    <div class="field"><label>Condição geral</label>
      <select name="condition">
        <option>Estável</option>
        <option>Com alerta</option>
        <option>Não apto</option>
      </select>
    </div>
    <div class="field"><label>Observações</label><textarea name="notes" rows="4" placeholder="Observações da triagem..."></textarea></div>
    <button type="submit" class="btn-primary">Confirmar check-in</button>
  </form>
@endsection
