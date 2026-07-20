@extends('layouts.app')
@section('title', 'Nova Triagem | LisThera')
@section('page-title', 'Nova Triagem de Sessão')
@section('content')
<div class="panel" style="margin-bottom:16px">
    <h2>Triagem de entrada</h2>
    <p>Avalie as condições do praticante antes de autorizar a sessão.</p>
</div>

<form class="form" method="POST" action="{{ route('checkins.store') }}">
    @csrf

    <fieldset>
        <legend>Praticante</legend>
        <div class="field">
            <label for="practitioner_id">Praticante</label>
            <select name="practitioner_id" id="practitioner_id" required>
                <option value="">Selecione...</option>
                @foreach($practitioners as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label for="practitioner_height_cm">Altura (cm)</label>
            <input type="number" name="practitioner_height_cm" id="practitioner_height_cm" min="50" max="250">
        </div>
        <div class="field">
            <label for="practitioner_weight_pre">Peso pré-sessão (kg)</label>
            <input type="number" step="0.01" name="practitioner_weight_pre" id="practitioner_weight_pre">
        </div>
        <div class="field">
            <label for="practitioner_pressure_pre">Pressão arterial pré</label>
            <input type="text" name="practitioner_pressure_pre" id="practitioner_pressure_pre" placeholder="120/80">
        </div>
        <div class="field">
            <label for="practitioner_temp_pre">Temperatura pré (°C)</label>
            <input type="number" step="0.1" name="practitioner_temp_pre" id="practitioner_temp_pre">
        </div>
        <div class="field">
            <label for="practitioner_mood_pre">Humor pré-sessão</label>
            <select name="practitioner_mood_pre" id="practitioner_mood_pre">
                <option value="Calmo">Calmo</option>
                <option value="Agitado">Agitado</option>
                <option value="Ansioso">Ansioso</option>
                <option value="Agressivo">Agressivo</option>
                <option value="Sonolento">Sonolento</option>
            </select>
        </div>
        <div class="field">
            <label>
                <input type="checkbox" name="practitioner_use_sensor" value="1">
                Usar sensor (IoT)
            </label>
        </div>
        <div class="field">
            <label for="practitioner_obs">Observações do praticante</label>
            <textarea name="practitioner_obs" id="practitioner_obs" rows="3" placeholder="Observações relevantes..."></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Autorização</legend>
        <div class="field">
            <label for="is_authorized_to_ride">Autorizado para montar?</label>
            <select name="is_authorized_to_ride" id="is_authorized_to_ride">
                <option value="yes">Sim</option>
                <option value="no">Não</option>
            </select>
        </div>
        <div class="field">
            <label for="denial_reason">Motivo da negação (se não autorizado)</label>
            <textarea name="denial_reason" id="denial_reason" rows="2"></textarea>
        </div>
        <div class="field">
            <label for="cancellation_reason">Motivo do cancelamento</label>
            <textarea name="cancellation_reason" id="cancellation_reason" rows="2"></textarea>
        </div>
    </fieldset>

    <div style="margin-top:16px">
        <button type="submit" class="btn-primary">Confirmar triagem</button>
        <a href="{{ route('checkins.index') }}" class="btn">Cancelar</a>
    </div>
</form>
@endsection
