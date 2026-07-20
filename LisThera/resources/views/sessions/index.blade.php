@extends('layouts.app')

@section('title', 'Sess&otilde;es de Arena')

@section('content')
<div class="page-header">
    <h1>Sess&otilde;es de Arena</h1>
    <a href="{{ route('sessions.create') }}" class="btn btn-primary">+ Nova sess&atilde;o</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Praticante</th>
                <th>Terapeuta</th>
                <th>Arena</th>
                <th>In&iacute;cio</th>
                <th>T&eacute;rmino</th>
                <th>Dura&ccedil;&atilde;o</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions as $s)
            <tr>
                <td><a href="{{ route('practitioners.show', $s->practitioner?->id) }}">{{ $s->practitioner?->fullname ?? '—' }}</a></td>
                <td>{{ $s->therapist?->fullname ?? '—' }}</td>
                <td>{{ $s->arena?->name ?? '—' }}</td>
                <td>{{ $s->startedat?->format('d/m/Y H:i') }}</td>
                <td>{{ $s->endedat?->format('H:i') ?? '—' }}</td>
                <td>{{ $s->duration }} min</td>
                <td>
                    @if($s->is_active)
                        <span class="badge badge-green">Ativa</span>
                    @else
                        <span class="badge badge-gray">Encerrada</span>
                    @endif
                </td>
                <td><a href="{{ route('sessions.show', $s->id) }}" class="btn btn-sm">Ver</a></td>
            </tr>
            @empty
            <tr><td colspan="8" class="empty">Nenhuma sess&atilde;o encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrap">{{ $sessions->links() }}</div>
</div>
@endsection
