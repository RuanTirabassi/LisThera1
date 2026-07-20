@extends('layouts.app')
@section('title', 'Novo Praticante | LisThera')
@section('page-title', 'Cadastrar Praticante')
@section('content')
<form class="form" method="POST" action="{{ route('practitioners.store') }}">
    @csrf

    <div class="field">
        <label for="name">Nome completo *</label>
        <input type="text" name="name" id="name" required value="{{ old('name') }}">
    </div>

    <div class="field">
        <label for="birth_date">Data de nascimento</label>
        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
    </div>

    <div class="field">
        <label for="gender">Gênero</label>
        <select name="gender" id="gender">
            <option value="">Selecione...</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select>
    </div>

    <div class="field">
        <label for="allergy">Alergias</label>
        <input type="text" name="allergy" id="allergy" value="{{ old('allergy') }}" placeholder="Ex: Penicilina, pólen...">
    </div>

    <div class="field">
        <label for="rfid_tag">Tag RFID</label>
        <input type="text" name="rfid_tag" id="rfid_tag" value="{{ old('rfid_tag') }}" placeholder="Código da pulseira">
    </div>

    <div style="margin-top:16px">
        <button type="submit" class="btn-primary">Salvar praticante</button>
        <a href="{{ route('practitioners.index') }}" class="btn">Cancelar</a>
    </div>
</form>
@endsection
