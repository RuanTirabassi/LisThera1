@extends('layouts.app')

@section('title', 'Sess&atilde;o')

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('sessions.index') }}" class="back-link">&larr; Sess&otilde;es</a>
        <h1>Sess&atilde;o #{{ $session->id }}</h1>
        <span class="text-muted">{{ $session->startedat?->format('d/m/Y H:i') }}</span>
    </div>
    @if($session->is_active)
    <form method="POST" action="{{ route('sessions.end', $session->id) }}">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-danger">Encerrar sess&atilde;o</button>
    </form>
    @endif
</div>

<div class="detail-grid">
    <div class="card">
        <h2>Detalhes</h2>
        <dl class="info-list">
            <dt>Praticante</dt>
            <dd><a href="{{ route('practitioners.show', $session->practitioner?->id) }}">{{ $session->practitioner?->fullname ?? '—' }}</a></dd>
            <dt>Terapeuta</dt>
            <dd>{{ $session->therapist?->fullname ?? '—' }}</dd>
            <dt>Arena</dt>
            <dd>{{ $session->arena?->name ?? '—' }}</dd>
            <dt>In&iacute;cio</dt>
            <dd>{{ $session->startedat?->format('d/m/Y H:i:s') }}</dd>
            <dt>T&eacute;rmino</dt>
            <dd>{{ $session->endedat?->format('H:i:s') ?? '<span class="badge badge-green">Em andamento</span>' }}</dd>
            <dt>Dura&ccedil;&atilde;o</dt>
            <dd>{{ $session->duration }} min</dd>
            <dt>Observa&ccedil;&otilde;es</dt>
            <dd>{{ $session->notes ?? '—' }}</dd>
        </dl>
    </div>

    <div class="card">
        <h2>Montarias</h2>
        @forelse($session->mounts as $m)
        <div class="mount-item">
            <strong>{{ $m->horse?->name ?? '—' }}</strong>
            <span class="badge">{{ $m->mountType?->name ?? '—' }}</span>
            <span class="text-muted">{{ $m->mountedat?->format('H:i') }} → {{ $m->dismountedat?->format('H:i') ?? 'em sela' }}</span>
        </div>
        @empty
        <p class="text-muted">Nenhuma montaria registrada.</p>
        @endforelse
    </div>

    <div class="card" style="grid-column: 1 / -1">
        <h2>Timeline de Memory Cues</h2>
        @forelse($session->memoryCueEvents as $e)
        <div class="cue-event">
            <span class="cue-time">{{ $e->recordedat?->format('H:i:s') }}</span>
            <span class="badge badge-blue">{{ $e->template?->category }}</span>
            <strong>{{ $e->template?->label }}</strong>
            @if($e->notes) <span class="text-muted">— {{ $e->notes }}</span> @endif
        </div>
        @empty
        <p class="text-muted">Nenhum cue registrado.</p>
        @endforelse
    </div>
</div>
@endsection
