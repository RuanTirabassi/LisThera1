@extends('layouts.app')
@section('title', 'Sessões em Arena | LisThera')
@section('page-title', 'Sessões em Arena')
@section('content')
<div class="page-header">
    <h1>Sessões em Arena</h1>
    <a href="{{ route('sessions.create') }}" class="btn btn-primary">+ Nova sessão</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Triagem</th>
            <th>Arena</th>
            <th>Status</th>
            <th>Início</th>
            <th>Fim</th>
            <th>Iniciada por</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($sessions as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>
                <a href="{{ route('checkins.show', $s->session_checkin_id) }}">#{{ $s->session_checkin_id }}</a>
                — {{ $s->sessionCheckin?->practitioner?->name ?? '—' }}
            </td>
            <td>{{ $s->arena?->name ?? '—' }}</td>
            <td>
                @php
                    $badges = ['ready'=>'badge-gray','in_progress'=>'badge-green','finished'=>'badge-blue','aborted'=>'badge-red'];
                    $labels = ['ready'=>'Pronto','in_progress'=>'Em andamento','finished'=>'Finalizado','aborted'=>'Abortado'];
                @endphp
                <span class="badge {{ $badges[$s->status] ?? '' }}">
                    {{ $labels[$s->status] ?? $s->status }}
                </span>
            </td>
            <td>{{ $s->started_at ? \Carbon\Carbon::parse($s->started_at)->format('d/m/Y H:i') : '—' }}</td>
            <td>{{ $s->ended_at ? \Carbon\Carbon::parse($s->ended_at)->format('H:i') : '—' }}</td>
            <td>{{ $s->startedByTherapist?->name ?? '—' }}</td>
            <td><a href="{{ route('sessions.show', $s->id) }}" class="btn btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="8" class="empty">Nenhuma sessão registrada.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $sessions->links() }}
@endsection
