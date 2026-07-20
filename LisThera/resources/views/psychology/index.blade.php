@extends('layouts.app')

@section('title', 'Avaliações Psicológicas')

@section('content')
<div class="page-header">
    <h1>Avaliações Psicológicas</h1>
    <a href="{{ route('psychology.create') }}" class="btn btn-primary">+ Nova Avaliação</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Busca --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('psychology.index') }}" class="search-form">
            <div class="search-fields">
                <div class="form-group">
                    <label for="nome">Nome do Praticante</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        placeholder="Buscar por nome..."
                        value="{{ request('nome') }}">
                </div>
                <div class="form-group">
                    <label for="data">Data da Avaliação</label>
                    <input type="date" name="data" id="data" class="form-control"
                        value="{{ request('data') }}">
                </div>
                <div class="search-actions">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('psychology.index') }}" class="btn btn-ghost">Limpar</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabela --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Praticante</th>
                        <th>Data da Avaliação</th>
                        <th>Escore Geral</th>
                        <th>Psicólogo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avaliacoes as $av)
                    <tr>
                        <td>
                            <span class="practitioner-name">{{ $av->practitioner?->fullname ?? '—' }}</span>
                        </td>
                        <td>{{ $av->assessedat?->format('d/m/Y') ?? '—' }}</td>
                        <td>
                            @if($av->overallscore !== null)
                                <span class="badge {{ $av->overallscore >= 70 ? 'badge-green' : ($av->overallscore >= 40 ? 'badge-yellow' : 'badge-red') }}">
                                    {{ $av->overallscore }}/100
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $av->therapist?->fullname ?? '—' }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('psychology.show', $av) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('psychology.edit', $av) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('psychology.destroy', $av) }}"
                                      onsubmit="return confirm('Excluir esta avaliação? Esta ação não pode ser desfeita.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-row">
                            @if(request('nome') || request('data'))
                                Nenhuma avaliação encontrada para os filtros informados.
                            @else
                                Nenhuma avaliação psicológica cadastrada ainda.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($avaliacoes->hasPages())
        <div class="pagination-wrap">
            {{ $avaliacoes->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
