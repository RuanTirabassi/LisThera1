@extends('layouts.app')

@section('title', 'Check-in')

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('checkins.index') }}" class="back-link">&larr; Triagem</a>
        <h1>Check-in: {{ $checkin->practitioner?->fullname }}</h1>
        <span class="text-muted">{{ $checkin->checkedat?->format('d/m/Y H:i') }}</span>
    </div>
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Sinais vitais</h2>
        <dl class="info-list">
            <dt>Press&atilde;o arterial</dt>
            <dd>{{ $checkin->bloodpressuresys ?? '?' }}/{{ $checkin->bloodpressuredia ?? '?' }} mmHg</dd>
            <dt>Frequ&ecirc;ncia card&iacute;aca</dt>
            <dd>{{ $checkin->heartrate ?? '—' }} bpm</dd>
            <dt>Temperatura</dt>
            <dd>{{ $checkin->temperature ?? '—' }} &deg;C</dd>
            <dt>Satura&ccedil;&atilde;o O2</dt>
            <dd>{{ $checkin->oxygensaturation ?? '—' }}%</dd>
        </dl>
    </div>
    <div class="card">
        <h2>Avalia&ccedil;&atilde;o cl&iacute;nica</h2>
        <dl class="info-list">
            <dt>N&iacute;vel de dor</dt>
            <dd>{{ $checkin->painlevel ?? '—' }}/10</dd>
            <dt>Mobilidade</dt>
            <dd>{{ $checkin->mobilityrating ?? '—' }}/5</dd>
            <dt>Humor</dt>
            <dd>{{ $checkin->moodrating ?? '—' }}/5</dd>
            <dt>Sess&atilde;o autorizada?</dt>
            <dd>
                @if($checkin->sessionauthorized)
                    <span class="badge badge-green">Sim</span>
                @else
                    <span class="badge badge-red">N&atilde;o</span>
                @endif
            </dd>
            <dt>Observa&ccedil;&otilde;es</dt>
            <dd>{{ $checkin->authorizationnotes ?? '—' }}</dd>
        </dl>
    </div>
</div>
@endsection
