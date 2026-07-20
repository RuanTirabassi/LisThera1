@extends('layouts.app')
@section('title', 'Triagens | LisThera')
@section('page-title', 'Triagens de Sessão')
@section('content')
<div class="page-header">
    <h1>Triagens</h1>
    <a href="{{ route('checkins.create') }}" class="btn btn-primary">+ Nova triagem</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Praticante</th>
            <th>Agendado em</th>
            <th>Humor pré</th>
            <th>Peso pré (kg)</th>
            <th>Pressão pré</th>
            <th>Autorizado?</th>
            <th>Sensor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($checkins as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->practitioner?->name ?? '—' }}</td>
            <td>{{ $c->scheduled_at ? \Carbon\Carbon::parse($c->scheduled_at)->format('d/m/Y H:i') : '—' }}</td>
            <td>{{ $c->practitioner_mood_pre ?? '—' }}</td>
            <td>{{ $c->practitioner_weight_pre ?? '—' }}</td>
            <td>{{ $c->practitioner_pressure_pre ?? '—' }}</td>
            <td>
                @if($c->is_authorized_to_ride === 'yes')
                    <span class="badge badge-green">Sim</span>
                @else
                    <span class="badge badge-red">Não</span>
                @endif
            </td>
            <td>{{ $c->practitioner_use_sensor ? 'Sim' : 'Não' }}</td>
            <td><a href="{{ route('checkins.show', $c->id) }}" class="btn btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="9" class="empty">Nenhuma triagem registrada.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $checkins->links() }}
@endsection
