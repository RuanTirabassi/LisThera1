@extends('layouts.app')

@section('title', 'Triagem')

@section('content')
<div class="page-header">
    <h1>Triagem (Check-ins)</h1>
    <a href="{{ route('checkins.create') }}" class="btn btn-primary">+ Novo check-in</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Praticante</th>
                <th>Data/Hora</th>
                <th>P.A.</th>
                <th>FC</th>
                <th>Dor</th>
                <th>Humor</th>
                <th>Mobilidade</th>
                <th>Autorizado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($checkins as $c)
            <tr>
                <td><a href="{{ route('practitioners.show', $c->practitioner?->id) }}">{{ $c->practitioner?->fullname ?? '—' }}</a></td>
                <td>{{ $c->checkedat?->format('d/m/Y H:i') }}</td>
                <td>{{ $c->bloodpressuresys ?? '?' }}/{{ $c->bloodpressuredia ?? '?' }}</td>
                <td>{{ $c->heartrate ?? '—' }} bpm</td>
                <td>{{ $c->painlevel ?? '—' }}/10</td>
                <td>{{ $c->moodrating ?? '—' }}/5</td>
                <td>{{ $c->mobilityrating ?? '—' }}/5</td>
                <td>
                    @if($c->sessionauthorized)
                        <span class="badge badge-green">Sim</span>
                    @else
                        <span class="badge badge-red">N&atilde;o</span>
                    @endif
                </td>
                <td><a href="{{ route('checkins.show', $c->id) }}" class="btn btn-sm">Ver</a></td>
            </tr>
            @empty
            <tr><td colspan="9" class="empty">Nenhum check-in registrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrap">{{ $checkins->links() }}</div>
</div>
@endsection
