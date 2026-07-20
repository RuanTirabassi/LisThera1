@extends('layouts.app')
@section('title', $practitioner->name)
@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('practitioners.index') }}" class="back-link">&larr; Praticantes</a>
        <h1>{{ $practitioner->name }}</h1>
    </div>
    <a href="{{ route('practitioners.edit', $practitioner->id) }}" class="btn btn-primary">Editar</a>
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Dados pessoais</h2>
        <dl class="info-list">
            <dt>Data de nascimento</dt>
            <dd>{{ $practitioner->birth_date ? \Carbon\Carbon::parse($practitioner->birth_date)->format('d/m/Y') : '—' }}</dd>
            <dt>Gênero</dt>
            <dd>{{ $practitioner->gender ?? '—' }}</dd>
            <dt>Alergias</dt>
            <dd>{{ $practitioner->allergy ?? '—' }}</dd>
            <dt>Tag RFID</dt>
            <dd><code>{{ $practitioner->rfid_tag ?? '—' }}</code></dd>
            <dt>Ativo</dt>
            <dd>{{ $practitioner->is_active ? 'Sim' : 'Não' }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Histórico clínico</h2>
        @if($practitioner->clinicalHistory)
        <dl class="info-list">
            <dt>Gestação planejada</dt>
            <dd>{{ $practitioner->clinicalHistory->pregnancy_planned ?? '—' }}</dd>
            <dt>Gestação tranquila</dt>
            <dd>{{ $practitioner->clinicalHistory->pregnancy_peaceful ?? '—' }}</dd>
            <dt>Parto</dt>
            <dd>{{ $practitioner->clinicalHistory->delivery ?? '—' }}</dd>
            <dt>Tem irmãos?</dt>
            <dd>{{ $practitioner->clinicalHistory->has_siblings ?? '—' }}</dd>
            <dt>Relacionamento com irmãos</dt>
            <dd>{{ $practitioner->clinicalHistory->siblings_relationship ?? '—' }}</dd>
            <dt>Membros do domicílio</dt>
            <dd>{{ $practitioner->clinicalHistory->household_members ?? '—' }}</dd>
        </dl>
        @else
        <p class="text-muted">Histórico não preenchido.</p>
        @endif
    </div>

    <div class="card">
        <h2>Diagnósticos</h2>
        @forelse($practitioner->diagnoses as $d)
        <div class="diag-item" style="margin-bottom:8px">
            <span class="badge badge-blue">{{ $d->diagnosisRef?->code ?? '—' }}</span>
            <strong>{{ $d->diagnosisRef?->description ?? '—' }}</strong>
        </div>
        @empty
        <p class="text-muted">Nenhum diagnóstico registrado.</p>
        @endforelse
    </div>

    <div class="card">
        <h2>Responsáveis</h2>
        @forelse($practitioner->guardians as $g)
        <div class="guardian-item" style="margin-bottom:8px">
            <strong>{{ $g->name }}</strong><br>
            @if($g->birth_date)
                <span class="text-muted">Nasc.: {{ \Carbon\Carbon::parse($g->birth_date)->format('d/m/Y') }}</span><br>
            @endif
            @if($g->phone) <span>{{ $g->phone }}</span><br> @endif
            @if($g->profession) <span class="text-muted">{{ $g->profession }}</span> @endif
        </div>
        @empty
        <p class="text-muted">Nenhum responsável cadastrado.</p>
        @endforelse
    </div>

    <div class="card" style="grid-column: 1 / -1">
        <div class="card-header">
            <h2>Histórico de sessões</h2>
            <a href="{{ route('sessions.index') }}">Ver todas</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Arena</th>
                    <th>Status</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($practitioner->arenaSessions->take(8) as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->arena?->name ?? '—' }}</td>
                    <td>{{ $s->status }}</td>
                    <td>{{ $s->started_at ? \Carbon\Carbon::parse($s->started_at)->format('d/m/Y H:i') : '—' }}</td>
                    <td>{{ $s->ended_at ? \Carbon\Carbon::parse($s->ended_at)->format('H:i') : '—' }}</td>
                    <td><a href="{{ route('sessions.show', $s->id) }}" class="btn btn-sm">Ver</a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty">Nenhuma sessão.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
