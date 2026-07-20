@extends('layouts.app')

@section('title', $practitioner->fullname)

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('practitioners.index') }}" class="back-link">&larr; Praticantes</a>
        <h1>{{ $practitioner->fullname }}</h1>
    </div>
    <a href="{{ route('practitioners.edit', $practitioner->id) }}" class="btn btn-primary">Editar</a>
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Dados pessoais</h2>
        <dl class="info-list">
            <dt>Data de nascimento</dt>
            <dd>{{ $practitioner->birthdate ? \Carbon\Carbon::parse($practitioner->birthdate)->format('d/m/Y') : '—' }}
                @if($practitioner->age) ({{ $practitioner->age }} anos) @endif
            </dd>
            <dt>Telefone</dt>
            <dd>{{ $practitioner->phonenumber ?? '—' }}</dd>
            <dt>Endere&ccedil;o</dt>
            <dd>{{ $practitioner->address ?? '—' }}</dd>
            <dt>RFID Token</dt>
            <dd><code>{{ $practitioner->rfidtoken ?? '—' }}</code></dd>
            <dt>Observa&ccedil;&otilde;es</dt>
            <dd>{{ $practitioner->notes ?? '—' }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Diagn&oacute;sticos</h2>
        @forelse($practitioner->diagnoses as $d)
        <div class="diag-item">
            <span class="badge badge-blue">{{ $d->diagnosisReference?->code }}</span>
            <strong>{{ $d->diagnosisReference?->name }}</strong>
            @if($d->diagnoseddate)
                <span class="text-muted">{{ \Carbon\Carbon::parse($d->diagnoseddate)->format('d/m/Y') }}</span>
            @endif
            @if($d->notes)<p>{{ $d->notes }}</p>@endif
        </div>
        @empty
        <p class="text-muted">Nenhum diagn&oacute;stico registrado.</p>
        @endforelse
    </div>

    <div class="card">
        <h2>Respons&aacute;veis</h2>
        @forelse($practitioner->guardians as $g)
        <div class="guardian-item">
            <strong>{{ $g->fullname }}</strong>
            <span class="badge">{{ $g->relationship }}</span><br>
            {{ $g->phonenumber }} {{ $g->email }}
        </div>
        @empty
        <p class="text-muted">Nenhum respons&aacute;vel cadastrado.</p>
        @endforelse
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Hist&oacute;rico de sess&otilde;es</h2>
            <a href="{{ route('sessions.index') }}">Ver todas</a>
        </div>
        <table class="data-table">
            <thead><tr><th>Data</th><th>Terapeuta</th><th>Arena</th><th>Dura&ccedil;&atilde;o</th><th></th></tr></thead>
            <tbody>
                @forelse($practitioner->arenaSessions->take(8) as $s)
                <tr>
                    <td>{{ $s->startedat?->format('d/m/Y H:i') }}</td>
                    <td>{{ $s->therapist?->fullname ?? '—' }}</td>
                    <td>{{ $s->arena?->name ?? '—' }}</td>
                    <td>{{ $s->duration }} min</td>
                    <td><a href="{{ route('sessions.show', $s->id) }}" class="btn btn-sm">Ver</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty">Nenhuma sess&atilde;o.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
