@extends('layouts.app')
@section('title', 'Sessão #' . $session->id)
@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('sessions.index') }}" class="back-link">&larr; Sessões</a>
        <h1>Sessão #{{ $session->id }}</h1>
        <span class="text-muted">
            {{ $session->started_at ? \Carbon\Carbon::parse($session->started_at)->format('d/m/Y H:i') : '—' }}
        </span>
    </div>
    @if($session->status === 'in_progress')
    <form method="POST" action="{{ route('sessions.end', $session->id) }}">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-danger">Encerrar sessão</button>
    </form>
    @endif
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Detalhes da sessão</h2>
        <dl class="info-list">
            <dt>Praticante</dt>
            <dd>
                @php $pract = $session->sessionCheckin?->practitioner; @endphp
                @if($pract)
                    <a href="{{ route('practitioners.show', $pract->id) }}">{{ $pract->name }}</a>
                @else —
                @endif
            </dd>
            <dt>Arena</dt>
            <dd>{{ $session->arena?->name ?? '—' }}</dd>
            <dt>Status</dt>
            <dd>
                @php
                    $labels = ['ready'=>'Pronto','in_progress'=>'Em andamento','finished'=>'Finalizado','aborted'=>'Abortado'];
                @endphp
                {{ $labels[$session->status] ?? $session->status }}
            </dd>
            <dt>Início</dt>
            <dd>{{ $session->started_at ? \Carbon\Carbon::parse($session->started_at)->format('d/m/Y H:i:s') : '—' }}</dd>
            <dt>Fim</dt>
            <dd>{{ $session->ended_at ? \Carbon\Carbon::parse($session->ended_at)->format('H:i:s') : '<span class="badge badge-green">Em andamento</span>' }}</dd>
            <dt>Iniciada por</dt>
            <dd>{{ $session->startedByTherapist?->name ?? '—' }}</dd>
            <dt>Encerrada por</dt>
            <dd>{{ $session->endedByTherapist?->name ?? '—' }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Entidades na arena</h2>
        @forelse($session->arenaEntities as $e)
        <div class="entity-item" style="margin-bottom:8px">
            <span class="badge">{{ ucfirst($e->entity_type) }}</span>
            <strong>RFID: {{ $e->rfid_tag }}</strong>
            <span class="text-muted">
                {{ $e->entered_at ? \Carbon\Carbon::parse($e->entered_at)->format('H:i') : '?' }}
                →
                {{ $e->exited_at ? \Carbon\Carbon::parse($e->exited_at)->format('H:i') : 'presente' }}
            </span>
        </div>
        @empty
        <p class="text-muted">Nenhuma entidade registrada.</p>
        @endforelse
    </div>

    <div class="card">
        <h2>Montarias</h2>
        @forelse($session->mounts as $m)
        <div class="mount-item" style="margin-bottom:8px">
            <span class="badge">{{ $m->mountType?->name ?? 'Tipo #' . $m->mount_type_id }}</span>
            <span class="text-muted">
                {{ $m->started_at ? \Carbon\Carbon::parse($m->started_at)->format('H:i') : '?' }}
                →
                {{ $m->ended_at ? \Carbon\Carbon::parse($m->ended_at)->format('H:i') : 'em sela' }}
            </span>
            @if($m->notes) <p class="text-muted" style="margin:4px 0 0">{{ $m->notes }}</p> @endif
        </div>
        @empty
        <p class="text-muted">Nenhuma montaria registrada.</p>
        @endforelse
    </div>

    <div class="card" style="grid-column: 1 / -1">
        <h2>Timeline de Memory Cues</h2>
        @forelse($session->memoryCueEvents as $e)
        <div class="cue-event" style="display:flex;gap:12px;align-items:center;padding:6px 0;border-bottom:1px solid var(--border)">
            <span class="cue-time text-muted" style="min-width:60px">
                {{ $e->recorded_at ? \Carbon\Carbon::parse($e->recorded_at)->format('H:i:s') : '—' }}
            </span>
            <span class="badge badge-blue">{{ $e->template?->category ?? '—' }}</span>
            <strong>{{ $e->template?->cue_label ?? '—' }}</strong>
            <span class="text-muted">{{ $e->template?->polarity ? '(' . $e->template->polarity . ')' : '' }}</span>
        </div>
        @empty
        <p class="text-muted">Nenhum cue registrado.</p>
        @endforelse
    </div>
</div>
@endsection
