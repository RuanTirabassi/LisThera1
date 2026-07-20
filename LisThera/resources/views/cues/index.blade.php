@extends('layouts.app')
@section('title', 'Memory Cues | LisThera')
@section('page-title', 'Templates de Memory Cues')
@section('content')
<div class="page-header">
    <h1>Memory Cues</h1>
    <a href="{{ route('cues.create') }}" class="btn btn-primary">+ Novo cue</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Terapeuta</th>
            <th>Chave</th>
            <th>Rótulo</th>
            <th>Categoria</th>
            <th>Polaridade</th>
            <th>Ativo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($cues as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->therapist?->name ?? '—' }}</td>
            <td><code>{{ $c->cue_key }}</code></td>
            <td>{{ $c->cue_label }}</td>
            <td>{{ $c->category ?? '—' }}</td>
            <td>
                @php
                    $pol = ['positive'=>'badge-green','negative'=>'badge-red','neutral'=>'badge-gray'];
                @endphp
                <span class="badge {{ $pol[$c->polarity] ?? '' }}">{{ $c->polarity ?? '—' }}</span>
            </td>
            <td>{{ $c->is_active ? 'Sim' : 'Não' }}</td>
            <td><a href="{{ route('cues.show', $c->id) }}" class="btn btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="8" class="empty">Nenhum template registrado.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $cues->links() }}
@endsection
