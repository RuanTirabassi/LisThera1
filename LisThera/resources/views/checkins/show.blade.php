@extends('layouts.app')
@section('title', 'Triagem #' . $checkin->id)
@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('checkins.index') }}" class="back-link">&larr; Triagens</a>
        <h1>Triagem: {{ $checkin->practitioner?->name ?? '#' . $checkin->id }}</h1>
        <span class="text-muted">
            Agendado em: {{ $checkin->scheduled_at ? \Carbon\Carbon::parse($checkin->scheduled_at)->format('d/m/Y H:i') : '—' }}
        </span>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Sinais vitais pré-sessão</h2>
        <dl class="info-list">
            <dt>Peso pré</dt>
            <dd>{{ $checkin->practitioner_weight_pre ?? '—' }} kg</dd>
            <dt>Altura</dt>
            <dd>{{ $checkin->practitioner_height_cm ?? '—' }} cm</dd>
            <dt>Pressão pré</dt>
            <dd>{{ $checkin->practitioner_pressure_pre ?? '—' }}</dd>
            <dt>Temperatura pré</dt>
            <dd>{{ $checkin->practitioner_temp_pre ?? '—' }} °C</dd>
            <dt>Humor pré</dt>
            <dd>{{ $checkin->practitioner_mood_pre ?? '—' }}</dd>
            <dt>Sensor ativo</dt>
            <dd>{{ $checkin->practitioner_use_sensor ? 'Sim' : 'Não' }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Sinais vitais pós-sessão</h2>
        <dl class="info-list">
            <dt>Humor pós</dt>
            <dd>{{ $checkin->practitioner_mood_post ?? '—' }}</dd>
            <dt>Peso pós</dt>
            <dd>{{ $checkin->practitioner_weight_post ?? '—' }} kg</dd>
            <dt>Pressão pós</dt>
            <dd>{{ $checkin->practitioner_pressure_post ?? '—' }}</dd>
            <dt>Temperatura pós</dt>
            <dd>{{ $checkin->practitioner_temp_post ?? '—' }} °C</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Autorização</h2>
        <dl class="info-list">
            <dt>Autorizado para montar?</dt>
            <dd>
                @if($checkin->is_authorized_to_ride === 'yes')
                    <span class="badge badge-green">Sim</span>
                @else
                    <span class="badge badge-red">Não</span>
                @endif
            </dd>
            <dt>Motivo de negação</dt>
            <dd>{{ $checkin->denial_reason ?? '—' }}</dd>
            <dt>Motivo de cancelamento</dt>
            <dd>{{ $checkin->cancellation_reason ?? '—' }}</dd>
            <dt>Ref. MongoDB</dt>
            <dd><code>{{ $checkin->mongo_ref_id ?? '—' }}</code></dd>
        </dl>
    </div>

    <div class="card">
        <h2>Observações</h2>
        <p>{{ $checkin->practitioner_obs ?? 'Sem observações.' }}</p>
    </div>
</div>
@endsection
