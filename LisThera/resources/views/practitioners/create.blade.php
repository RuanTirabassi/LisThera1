@extends('layouts.app')
@section('title', 'Novo Praticante | LisThera')
@section('page-title', 'Novo Praticante')
@section('content')
  <div class="panel" style="margin-bottom:16px"><h2>Cadastrar praticante</h2><p>Preencha os dados básicos do novo praticante.</p></div>
  <form class="form" method="POST" action="{{ route('practitioners.store') }}">
    @csrf
    <div class="field"><label>Nome completo</label><input type="text" name="name" placeholder="Nome do praticante" required></div>
    <div class="field"><label>Data de nascimento</label><input type="date" name="birthdate" required></div>
    <div class="field"><label>Diagnóstico (CID)</label><input type="text" name="diagnosis" placeholder="Ex: F84.0"></div>
    <div class="field"><label>Responsável</label><input type="text" name="guardian" placeholder="Nome do responsável"></div>
    <button type="submit" class="btn-primary">Salvar praticante</button>
  </form>
@endsection
