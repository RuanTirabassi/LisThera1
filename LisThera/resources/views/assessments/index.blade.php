@extends('layouts.app')

@section('title', 'Central de Avaliações')

@section('content')
<div class="page-header">
    <h1>Central de Avaliações</h1>
    <span class="text-muted">Escolha a especialidade para lançar ou consultar avaliações</span>
</div>

{{-- Cards de especialidade --}}
<div class="assessment-grid">

    {{-- Psicologia --}}
    <div class="assessment-card" style="--ac:#7c3aed">
        <div class="ac-icon">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M12 2a7 7 0 0 1 7 7c0 3.5-2.5 6.4-5.8 7.7V19h-2.4v-2.3C7.5 15.4 5 12.5 5 9a7 7 0 0 1 7-7z"/>
                <path d="M9.5 22h5"/>
            </svg>
        </div>
        <div class="ac-body">
            <h2 class="ac-title">Psicologia</h2>
            <p class="ac-description">Avaliação comportamental e emocional do praticante. Inclui escalas de humor, atenção, vínculo afetivo e autoestima.</p>
            <div class="ac-stats">
                <span>{{ $counts['psychology'] }} avaliações registradas</span>
            </div>
        </div>
        <div class="ac-actions">
            <a href="{{ route('psychology.create') }}" class="btn btn-primary">+ Nova avaliação</a>
            <a href="{{ route('psychology.index') }}" class="btn btn-secondary">Ver histórico</a>
        </div>
    </div>

    {{-- Pedagogia --}}
    <div class="assessment-card" style="--ac:#059669">
        <div class="ac-icon">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path d="M4 19V6a2 2 0 0 1 2-2h13"/>
                <path d="M18 2v17"/>
                <path d="M8 10h6"/>
                <path d="M8 14h4"/>
                <rect x="2" y="17" width="20" height="4" rx="1"/>
            </svg>
        </div>
        <div class="ac-body">
            <h2 class="ac-title">Pedagogia</h2>
            <p class="ac-description">Avaliação do desenvolvimento educacional e habilidades de aprendizagem, comunicação e participação nas atividades.</p>
            <div class="ac-stats">
                <span>{{ $counts['pedagogy'] }} avaliações registradas</span>
            </div>
        </div>
        <div class="ac-actions">
            <a href="/pedagogy/create" class="btn btn-primary">+ Nova avaliação</a>
            <a href="/pedagogy" class="btn btn-secondary">Ver histórico</a>
        </div>
    </div>

    {{-- Fisioterapia --}}
    <div class="assessment-card" style="--ac:#0284c7">
        <div class="ac-icon">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <circle cx="12" cy="5" r="2"/>
                <path d="M10 22V10.5L7 16h2v6"/>
                <path d="M14 22V10.5l3 5.5h-2v6"/>
                <path d="M10 10.5a4 4 0 0 1 4 0"/>
            </svg>
        </div>
        <div class="ac-body">
            <h2 class="ac-title">Fisioterapia</h2>
            <p class="ac-description">Avaliação motora e funcional. Inclui equilíbrio, coordenação, tônus muscular e desempenho postural durante a sessão.</p>
            <div class="ac-stats">
                <span>{{ $counts['physiotherapy'] }} avaliações registradas</span>
            </div>
        </div>
        <div class="ac-actions">
            <a href="/physiotherapy/create" class="btn btn-primary">+ Nova avaliação</a>
            <a href="/physiotherapy" class="btn btn-secondary">Ver histórico</a>
        </div>
    </div>

</div>

{{-- Últimas avaliações --}}
<div class="card" style="margin-top:2rem">
    <div class="card-header">
        <h2>Últimas avaliações lançadas</h2>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Praticante</th>
                <th>Especialidade</th>
                <th>Terapeuta</th>
                <th>Data</th>
                <th>Escore</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $row)
            <tr>
                <td>{{ $row['practitioner'] }}</td>
                <td>
                    @if($row['type'] === 'psychology')
                        <span class="badge" style="background:#ede9fe;color:#6d28d9">Psicologia</span>
                    @elseif($row['type'] === 'pedagogy')
                        <span class="badge" style="background:#d1fae5;color:#065f46">Pedagogia</span>
                    @else
                        <span class="badge" style="background:#dbeafe;color:#1e40af">Fisioterapia</span>
                    @endif
                </td>
                <td>{{ $row['therapist'] }}</td>
                <td>{{ $row['date'] }}</td>
                <td>
                    @if($row['score'] !== null)
                        @php $s = $row['score']; $cls = $s >= 70 ? 'badge-green' : ($s >= 40 ? 'badge-yellow' : 'badge-red'); @endphp
                        <span class="badge {{ $cls }}">{{ $s }}</span>
                    @else
                        <span class="text-muted">&mdash;</span>
                    @endif
                </td>
                <td>
                    <a href="{{ $row['show_url'] }}" class="btn btn-secondary btn-sm">Ver</a>
                    <a href="{{ $row['edit_url'] }}" class="btn btn-secondary btn-sm">Editar</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty">Nenhuma avaliação lançada ainda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
.assessment-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}
.assessment-card {
    border: 1.5px solid color-mix(in srgb, var(--ac) 25%, transparent);
    border-radius: .75rem;
    background: color-mix(in srgb, var(--ac) 5%, var(--color-surface, #fff));
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    transition: box-shadow .18s;
}
.assessment-card:hover {
    box-shadow: 0 6px 24px color-mix(in srgb, var(--ac) 18%, transparent);
}
.ac-icon {
    color: var(--ac);
    background: color-mix(in srgb, var(--ac) 12%, transparent);
    width: 60px;
    height: 60px;
    border-radius: .6rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ac-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--ac);
    margin: 0 0 .3rem;
}
.ac-description {
    font-size: .9rem;
    color: var(--color-text-muted, #666);
    margin: 0 0 .5rem;
    line-height: 1.5;
}
.ac-stats span {
    font-size: .8rem;
    background: color-mix(in srgb, var(--ac) 12%, transparent);
    color: var(--ac);
    padding: .2rem .6rem;
    border-radius: 999px;
    font-weight: 600;
}
.ac-actions {
    display: flex;
    gap: .6rem;
    flex-wrap: wrap;
}
.badge-yellow { background: #fef9c3; color: #854d0e; }
</style>
@endsection
