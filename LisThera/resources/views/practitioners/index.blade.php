@extends('layouts.app')

@section('title', 'Praticantes')

@section('content')
<div class="page-header">
    <h1>Praticantes</h1>
    <a href="{{ route('practitioners.create') }}" class="btn btn-primary">+ Novo praticante</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Telefone</th>
                <th>Diagn&oacute;sticos</th>
                <th>A&ccedil;&otilde;es</th>
            </tr>
        </thead>
        <tbody>
            @forelse($practitioners as $p)
            <tr>
                <td><strong>{{ $p->fullname }}</strong></td>
                <td>{{ $p->birthdate ? \Carbon\Carbon::parse($p->birthdate)->format('d/m/Y') : '—' }}
                    @if($p->age) <span class="text-muted">({{ $p->age }} anos)</span> @endif
                </td>
                <td>{{ $p->phonenumber ?? '—' }}</td>
                <td>
                    @foreach($p->diagnoses as $d)
                        <span class="badge badge-blue">{{ $d->diagnosisReference?->code ?? $d->diagnosisReference?->name ?? '?' }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('practitioners.show', $p->id) }}" class="btn btn-sm">Ver</a>
                    <a href="{{ route('practitioners.edit', $p->id) }}" class="btn btn-sm">Editar</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty">Nenhum praticante cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrap">{{ $practitioners->links() }}</div>
</div>
@endsection
