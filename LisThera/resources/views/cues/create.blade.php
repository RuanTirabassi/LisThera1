@extends('layouts.app')
@section('title', 'Novo Memory Cue | LisThera')
@section('page-title', 'Novo Memory Cue Template')
@section('content')
<form class="form" method="POST" action="{{ route('cues.store') }}">
    @csrf

    <div class="field">
        <label for="therapist_id">Terapeuta *</label>
        <select name="therapist_id" id="therapist_id" required>
            <option value="">Selecione...</option>
            @foreach($therapists as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="cue_key">Chave do cue (hotkey) *</label>
        <input type="text" name="cue_key" id="cue_key" required maxlength="50"
               value="{{ old('cue_key') }}" placeholder="Ex: F1, cansaco, queda">
    </div>

    <div class="field">
        <label for="cue_label">Rótulo (exibição) *</label>
        <input type="text" name="cue_label" id="cue_label" required maxlength="20"
               value="{{ old('cue_label') }}" placeholder="Ex: Cansaço">
    </div>

    <div class="field">
        <label for="category">Categoria</label>
        <input type="text" name="category" id="category" maxlength="50" value="{{ old('category') }}"
               placeholder="Ex: Comportamento, Motor">
    </div>

    <div class="field">
        <label for="polarity">Polaridade</label>
        <select name="polarity" id="polarity">
            <option value="">Selecione...</option>
            <option value="positive">Positivo</option>
            <option value="negative">Negativo</option>
            <option value="neutral">Neutro</option>
        </select>
    </div>

    <div class="field">
        <label>
            <input type="checkbox" name="is_active" value="1" checked>
            Ativo
        </label>
    </div>

    <div style="margin-top:16px">
        <button type="submit" class="btn-primary">Salvar cue</button>
        <a href="{{ route('cues.index') }}" class="btn">Cancelar</a>
    </div>
</form>
@endsection
