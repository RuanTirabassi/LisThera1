@extends('layouts.app')

@section('title', 'Avaliações Psicológicas')
@section('page-title', 'Psicologia')

@section('content')
<div class="psychology-page">
    <div class="page-hero">
        <div>
            <span class="section-kicker">Equipe clínica</span>
            <h1>Avaliações Psicológicas</h1>
            <p class="page-subtitle">
                Consulte, filtre e acompanhe os registros psicológicos dos praticantes.
            </p>
        </div>
        <div class="page-hero-actions">
            <a href="{{ route('psychology.create') }}" class="btn btn-primary">+ Nova avaliação</a>
        </div>
    </div>

    @if(session('success'))
        <div class="feedback-banner success">{{ session('success') }}</div>
    @endif

    <div class="card filter-card">
        <div class="section-head">
            <div>
                <h2>Filtros de busca</h2>
                <p>Refine a listagem por praticante ou data da avaliação.</p>
            </div>
        </div>
        <form method="GET" action="{{ route('psychology.index') }}" class="filter-grid">
            <div class="field">
                <label for="nome">Nome do praticante</label>
                <input type="text" name="nome" id="nome" placeholder="Buscar por nome..." value="{{ request('nome') }}">
            </div>
            <div class="field">
                <label for="data">Data da avaliação</label>
                <input type="date" name="data" id="data" value="{{ request('data') }}">
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('psychology.index') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </form>
    </div>

    <div class="card table-card">
        <div class="section-head">
            <div>
                <h2>Lista de avaliações</h2>
                <p>{{ $avaliacoes->total() ?? $avaliacoes->count() }} registro(s) encontrado(s).</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="data-table psychology-table">
                <thead>
                    <tr>
                        <th>Praticante</th>
                        <th>Data da avaliação</th>
                        <th>Escore geral</th>
                        <th>Psicólogo</th>
                        <th class="actions-col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avaliacoes as $av)
                        <tr>
                            <td>
                                <div class="person-cell">
                                    <span class="person-avatar">{{ strtoupper(substr($av->practitioner?->name ?? 'P', 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $av->practitioner?->name ?? '—' }}</strong>
                                        <span class="cell-subtext">Praticante vinculado</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $av->assessment_date ? \Carbon\Carbon::parse($av->assessment_date)->format('d/m/Y') : '—' }}</td>
                            <td>
                                @if($av->overall_score !== null)
                                    <span class="score-badge {{ $av->overall_score >= 70 ? 'score-good' : ($av->overall_score >= 40 ? 'score-medium' : 'score-low') }}">
                                        {{ $av->overall_score }}/100
                                    </span>
                                @else
                                    <span class="text-muted">Não informado</span>
                                @endif
                            </td>
                            <td>{{ $av->therapist?->name ?? '—' }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('psychology.show', $av) }}" class="btn btn-sm btn-outline">Ver</a>
                                    <a href="{{ route('psychology.edit', $av) }}" class="btn btn-sm btn-secondary">Editar</a>
                                    <form method="POST" action="{{ route('psychology.destroy', $av) }}" onsubmit="return confirm('Excluir esta avaliação? Esta ação não pode ser desfeita.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger-soft">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state-cell">
                                <div class="empty-state-inline">
                                    <strong>
                                        @if(request('nome') || request('data'))
                                            Nenhuma avaliação encontrada para os filtros informados.
                                        @else
                                            Nenhuma avaliação psicológica cadastrada ainda.
                                        @endif
                                    </strong>
                                    <span>Cadastre uma nova avaliação para começar a montar o histórico clínico.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($avaliacoes->hasPages())
            <div class="pagination-wrap">{{ $avaliacoes->links() }}</div>
        @endif
    </div>
</div>
@endsection
