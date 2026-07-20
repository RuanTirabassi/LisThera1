@extends('layouts.app')
@section('title', 'Praticantes | LisThera')
@section('page-title', 'Praticantes')
@section('content')
<div class="page-header">
    <h1>Praticantes</h1>
    <a href="{{ route('practitioners.create') }}" class="btn btn-primary">+ Novo praticante</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Data nasc.</th>
            <th>Gênero</th>
            <th>Alergias</th>
            <th>RFID</th>
            <th>Ativo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($practitioners as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->birth_date ? \Carbon\Carbon::parse($p->birth_date)->format('d/m/Y') : '—' }}</td>
            <td>{{ $p->gender ?? '—' }}</td>
            <td>{{ $p->allergy ?? '—' }}</td>
            <td><code>{{ $p->rfid_tag ?? '—' }}</code></td>
            <td>{{ $p->is_active ? 'Sim' : 'Não' }}</td>
            <td><a href="{{ route('practitioners.show', $p->id) }}" class="btn btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="8" class="empty">Nenhum praticante cadastrado.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $practitioners->links() }}
@endsection
