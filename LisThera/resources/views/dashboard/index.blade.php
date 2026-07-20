@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
    <span class="text-muted">{{ now()->format('d/m/Y') }}</span>
</div>

{{-- KPIs --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['practitioners'] }}</span>
        <span class="kpi-label">Praticantes</span>
    </div>
    <div class="kpi-card kpi-accent">
        <span class="kpi-value">{{ $stats['sessions_active'] }}</span>
        <span class="kpi-label">Sessões ativas</span>
    </div>
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['sessions_today'] }}</span>
        <span class="kpi-label">Sessões hoje</span>
    </div>
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['checkins_today'] }}</span>
        <span class="kpi-label">Check-ins hoje</span>
    </div>
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['therapists'] }}</span>
        <span class="kpi-label">Terapeutas</span>
    </div>
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['horses'] }}</span>
        <span class="kpi-label">Cavalos</span>
    </div>
</div>

{{-- Acesso rápido: Avaliações --}}
<div class="card" style="margin-bottom:1.5rem">
    <div class="card-header">
        <h2>Avaliações Clínicas</h2>
        <a href="{{ route('assessments.index') }}">Central de avaliações</a>
    </div>
    <div style="display:flex;gap:1rem;padding:1rem;flex-wrap:wrap">
        <a href="{{ route('psychology.index') }}" class="assessment-shortcut" style="--c:#7c3aed">
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 1 7 7c0 3.5-2.5 6.4-5.8 7.7V19h-2.4v-2.3C7.5 15.4 5 12.5 5 9a7 7 0 0 1 7-7z"/><path d="M9.5 22h5"/></svg>
            <span class="shortcut-title">Psicologia</span>
            <span class="shortcut-count">{{ $stats['assessments_psychology'] ?? '—' }} avaliações</span>
        </a>
        <a href="{{ route('pedagogy.index') }}" class="assessment-shortcut" style="--c:#059669">
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19V6a2 2 0 0 1 2-2h13"/><path d="M18 2v17"/><path d="M8 10h6"/><path d="M8 14h4"/><rect x="2" y="17" width="20" height="4" rx="1"/></svg>
            <span class="shortcut-title">Pedagogia</span>
            <span class="shortcut-count">{{ $stats['assessments_pedagogy'] ?? '—' }} avaliações</span>
        </a>
        <a href="{{ route('physiotherapy.index') }}" class="assessment-shortcut" style="--c:#0284c7">
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M10 22V10.5L7 16h2v6"/><path d="M14 22V10.5l3 5.5h-2v6"/><path d="M10 10.5a4 4 0 0 1 4 0"/></svg>
            <span class="shortcut-title">Fisioterapia</span>
            <span class="shortcut-count">{{ $stats['assessments_physiotherapy'] ?? '—' }} avaliações</span>
        </a>
    </div>
</div>

<style>
.assessment-shortcut {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: .3rem;
    padding: 1rem 1.4rem;
    border: 1.5px solid color-mix(in srgb, var(--c) 30%, transparent);
    border-radius: .6rem;
    background: color-mix(in srgb, var(--c) 6%, transparent);
    color: var(--c);
    text-decoration: none;
    min-width: 160px;
    transition: background .18s, box-shadow .18s;
}
.assessment-shortcut:hover {
    background: color-mix(in srgb, var(--c) 14%, transparent);
    box-shadow: 0 4px 16px color-mix(in srgb, var(--c) 20%, transparent);
}
.assessment-shortcut .shortcut-title {
    font-weight: 700;
    font-size: 1rem;
}
.assessment-shortcut .shortcut-count {
    font-size: .8rem;
    opacity: .75;
}
</style>

<div class="two-col">
    {{-- Sessões recentes --}}
    <div class="card">
        <div class="card-header">
            <h2>Sessões recentes</h2>
            <a href="{{ route('sessions.index') }}">Ver todas</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Praticante</th>
                    <th>Terapeuta</th>
                    <th>Arena</th>
                    <th>Início</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_sessions as $s)
                @php
                    $practitioner = $s->sessionCheckin?->practitioner;
                    $therapist    = $s->startedByTherapist;
                @endphp
                <tr>
                    <td>
                        @if($practitioner)
                            <a href="{{ route('practitioners.show', $practitioner->id) }}">{{ $practitioner->name }}</a>
                        @else
                            <span class="text-muted">&mdash;</span>
                        @endif
                    </td>
                    <td>{{ $therapist?->name ?? '&mdash;' }}</td>
                    <td>{{ $s->arena?->name ?? '&mdash;' }}</td>
                    <td>{{ $s->started_at?->format('d/m H:i') ?? '&mdash;' }}</td>
                    <td>
                        @if($s->is_active)
                            <span class="badge badge-green">Ativa</span>
                        @else
                            <span class="badge badge-gray">Encerrada</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty">Nenhuma sessão encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Check-ins recentes --}}
    <div class="card">
        <div class="card-header">
            <h2>Check-ins recentes</h2>
            <a href="{{ route('checkins.index') }}">Ver todos</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Praticante</th>
                    <th>Agendado</th>
                    <th>Humor</th>
                    <th>Autorizado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_checkins as $c)
                <tr>
                    <td>{{ $c->practitioner?->name ?? '&mdash;' }}</td>
                    <td>{{ $c->scheduled_at?->format('d/m H:i') ?? '&mdash;' }}</td>
                    <td>{{ $c->practitioner_mood_pre ?? '&mdash;' }}</td>
                    <td>
                        @if($c->is_authorized_to_ride === 'yes')
                            <span class="badge badge-green">Sim</span>
                        @elseif($c->is_authorized_to_ride === 'no')
                            <span class="badge badge-red">Não</span>
                        @else
                            <span class="badge badge-gray">Pendente</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty">Nenhum check-in encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
