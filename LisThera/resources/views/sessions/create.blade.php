@extends('layouts.app')
@section('title', 'Nova Sessão em Arena | LisThera')
@section('page-title', 'Iniciar Sessão em Arena')
@section('content')
<div class="panel" style="margin-bottom:16px">
    <h2>Sessão em Arena</h2>
    <p>Vincule uma triagem autorizada a uma arena para iniciar a sessão.</p>
</div>

<form class="form" method="POST" action="{{ route('sessions.store') }}">
    @csrf

    <div class="field">
        <label for="session_checkin_id">Triagem (praticante autorizado)</label>
        <select name="session_checkin_id" id="session_checkin_id" required>
            <option value="">Selecione a triagem...</option>
            @foreach($checkins as $c)
                <option value="{{ $c->id }}">
                    #{{ $c->id }} — {{ $c->practitioner?->name ?? 'Praticante' }}
                    ({{ $c->scheduled_at ? \Carbon\Carbon::parse($c->scheduled_at)->format('d/m H:i') : '' }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="arena_id">Arena / Pista</label>
        <select name="arena_id" id="arena_id">
            <option value="">Selecione...</option>
            @foreach($arenas as $a)
                <option value="{{ $a->id }}">{{ $a->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="started_by">Terapeuta responsável</label>
        <select name="started_by" id="started_by" required>
            <option value="">Selecione...</option>
            @foreach($therapists as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-top:16px">
        <button type="submit" class="btn-primary">Iniciar sessão</button>
        <a href="{{ route('sessions.index') }}" class="btn">Cancelar</a>
    </div>
</form>
@endsection
