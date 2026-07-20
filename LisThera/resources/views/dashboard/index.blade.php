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
        <span class="kpi-label">Sess&otilde;es ativas</span>
    </div>
    <div class="kpi-card">
        <span class="kpi-value">{{ $stats['sessions_today'] }}</span>
        <span class="kpi-label">Sess&otilde;es hoje</span>
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

<div class="two-col">
    {{-- Sessões recentes --}}
    <div class="card">
        <div class="card-header">
            <h2>Sess&otilde;es recentes</h2>
            <a href="{{ route('sessions.index') }}">Ver todas</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Praticante</th>
                    <th>Terapeuta</th>
                    <th>Arena</th>
                    <th>In&iacute;cio</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_sessions as $s)
                <tr>
                    <td><a href="{{ route('practitioners.show', $s->practitioner?->id) }}">{{ $s->practitioner?->fullname ?? '—' }}</a></td>
                    <td>{{ $s->therapist?->fullname ?? '—' }}</td>
                    <td>{{ $s->arena?->name ?? '—' }}</td>
                    <td>{{ $s->startedat?->format('d/m H:i') }}</td>
                    <td>
                        @if($s->is_active)
                            <span class="badge badge-green">Ativa</span>
                        @else
                            <span class="badge badge-gray">Encerrada</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty">Nenhuma sess&atilde;o encontrada.</td></tr>
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
                    <th>Hora</th>
                    <th>Dor</th>
                    <th>Autorizado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_checkins as $c)
                <tr>
                    <td>{{ $c->practitioner?->fullname ?? '—' }}</td>
                    <td>{{ $c->checkedat?->format('d/m H:i') }}</td>
                    <td>{{ $c->painlevel ?? '—' }}/10</td>
                    <td>
                        @if($c->sessionauthorized)
                            <span class="badge badge-green">Sim</span>
                        @else
                            <span class="badge badge-red">N&atilde;o</span>
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
