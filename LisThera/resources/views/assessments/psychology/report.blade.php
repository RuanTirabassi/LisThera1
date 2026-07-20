@extends('layouts.app')

@section('title', 'Relatório Psicológico — ' . $practitioner->name)

@section('content')
<div class="page-header">
    <div>
        <h1>Relatório Individual Evolutivo</h1>
        <span class="badge badge-purple">Psicologia</span>
    </div>
    <div class="header-actions">
        <a href="{{ route('practitioners.show', $practitioner) }}" class="btn btn-ghost">← Praticante</a>
        <button onclick="window.print()" class="btn btn-ghost">Imprimir</button>
    </div>
</div>

{{-- Cabeçalho do praticante --}}
<div class="card practitioner-header mb-6">
    <div class="card-body">
        <div class="prac-info">
            <div class="prac-avatar">{{ strtoupper(substr($practitioner->name, 0, 2)) }}</div>
            <div>
                <h2>{{ $practitioner->name }}</h2>
                <div class="meta-row">
                    @if($practitioner->birth_date)
                        <span>{{ $practitioner->age }} anos</span>
                    @endif
                    @if($practitioner->gender)
                        <span>{{ ucfirst($practitioner->gender) }}</span>
                    @endif
                    <span>{{ $assessments->count() }} avaliação(ões) registrada(s)</span>
                </div>
                @if($practitioner->diagnoses->count())
                <div class="diagnoses-chips mt-2">
                    @foreach($practitioner->diagnoses as $d)
                        <span class="badge badge-gray">{{ $d->diagnosisRef?->code }} — {{ $d->diagnosisRef?->description }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($assessments->isEmpty())
<div class="empty-state">
    <div class="empty-state-icon">📋</div>
    <h3>Nenhuma avaliação registrada</h3>
    <p>As avaliações psicológicas são criadas a partir das sessões de arena.</p>
    <a href="{{ route('sessions.index') }}" class="btn btn-primary">Ver Sessões</a>
</div>
@else

{{-- Gráfico evolutivo geral --}}
<div class="card mb-6">
    <div class="card-header">
        <h2>Evolução Geral</h2>
        <span class="text-muted">Escore geral por sessão</span>
    </div>
    <div class="card-body">
        <canvas id="overallChart" height="80"></canvas>
    </div>
</div>

{{-- Gráfico por domínio --}}
<div class="card mb-6">
    <div class="card-header">
        <h2>Evolução por Domínio</h2>
        <span class="text-muted">Escala 0–10 por sessão</span>
    </div>
    <div class="card-body">
        <canvas id="domainsChart" height="100"></canvas>
    </div>
</div>

{{-- Radar da última avaliação --}}
@php $last = $assessments->last(); @endphp
<div class="two-col mb-6">
    <div class="card">
        <div class="card-header">
            <h2>Perfil Atual</h2>
            <span class="text-muted">{{ $last->assessed_at?->format('d/m/Y') }}</span>
        </div>
        <div class="card-body">
            <canvas id="radarChart" height="220"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h2>Última Avaliação</h2></div>
        <div class="card-body">
            @php
                $domainLabels = [
                    'emotional_regulation' => 'Regulação Emocional',
                    'social_interaction'   => 'Interação Social',
                    'communication'        => 'Comunicação',
                    'attention_focus'      => 'Atenção/Foco',
                    'behavioral_response'  => 'Resp. Comportamental',
                    'anxiety_level'        => 'Ansiedade',
                    'motivation'           => 'Motivação',
                    'self_esteem'          => 'Autoestima',
                ];
            @endphp
            <table class="data-table">
                <thead><tr><th>Domínio</th><th>Escore</th><th>Barra</th></tr></thead>
                <tbody>
                    @foreach($domainLabels as $field => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td><strong>{{ $last->{$field} ?? '—' }}</strong>/10</td>
                        <td>
                            @if($last->{$field} !== null)
                            <div class="score-bar">
                                <div class="score-fill"
                                    style="width:{{ ($last->{$field} / 10) * 100 }}%;
                                           background: {{ $last->{$field} >= 7 ? 'var(--color-success)' : ($last->{$field} >= 4 ? 'var(--color-gold)' : 'var(--color-error)') }}"
                                ></div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($last->overall_score !== null)
            <div class="overall-score">
                <span>Escore Geral</span>
                <strong>{{ $last->overall_score }}/100</strong>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Histórico de avaliações --}}
<div class="card mb-6">
    <div class="card-header"><h2>Histórico de Avaliações</h2></div>
    <div class="card-body">
        <div class="assessments-timeline">
            @foreach($assessments->reverse() as $a)
            <div class="timeline-item">
                <div class="timeline-date">{{ $a->assessed_at?->format('d/m/Y') }}</div>
                <div class="timeline-body">
                    <div class="timeline-header">
                        <span class="text-muted">Terapeuta: {{ $a->therapist?->name ?? '—' }}</span>
                        @if($a->overall_score !== null)
                            <span class="badge {{ $a->overall_score >= 70 ? 'badge-green' : ($a->overall_score >= 40 ? 'badge-yellow' : 'badge-red') }}">
                                Escore: {{ $a->overall_score }}
                            </span>
                        @endif
                    </div>

                    @if($a->evolution_notes)
                    <div class="timeline-note">
                        <strong>Evolução:</strong> {{ $a->evolution_notes }}
                    </div>
                    @endif

                    @if($a->session_notes)
                    <div class="timeline-note text-muted">
                        <strong>Sessão:</strong> {{ $a->session_notes }}
                    </div>
                    @endif

                    @if($a->cueLinks->count())
                    <div class="cue-evidence">
                        <span class="text-muted" style="font-size:var(--text-xs)">Evidências:</span>
                        @foreach($a->cueLinks as $link)
                            <span class="badge badge-sm {{ $link->cueEvent?->template?->polarity === 'positive' ? 'badge-green' : ($link->cueEvent?->template?->polarity === 'negative' ? 'badge-red' : 'badge-gray') }}">
                                {{ $link->cueEvent?->template?->cue_label ?? 'Cue' }}
                            </span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endif {{-- fim @if assessments --}}

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const labels  = @json($chartLabels);
    const overall = @json($overallSeries);
    const domains = @json($chartDomains);

    const palette = [
        '#01696f','#da7101','#d19900','#437a22',
        '#006494','#7a39bb','#a12c7b','#a13544'
    ];

    // Gráfico geral
    new Chart(document.getElementById('overallChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Escore Geral',
                data: overall,
                borderColor: '#01696f',
                backgroundColor: 'rgba(1,105,111,0.08)',
                tension: 0.35,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: '#01696f',
            }]
        },
        options: {
            scales: { y: { min: 0, max: 100 } },
            plugins: { legend: { display: false } }
        }
    });

    // Gráfico por domínio
    const domainEntries = Object.entries(domains);
    new Chart(document.getElementById('domainsChart'), {
        type: 'line',
        data: {
            labels,
            datasets: domainEntries.map(([name, data], i) => ({
                label: name,
                data,
                borderColor: palette[i % palette.length],
                backgroundColor: 'transparent',
                tension: 0.3,
                pointRadius: 4,
            }))
        },
        options: {
            scales: { y: { min: 0, max: 10 } },
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Radar última avaliação
    const lastValues = domainEntries.map(([, data]) => data[data.length - 1] ?? 0);
    new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: domainEntries.map(([name]) => name),
            datasets: [{
                label: 'Perfil Atual',
                data: lastValues,
                backgroundColor: 'rgba(1,105,111,0.15)',
                borderColor: '#01696f',
                pointBackgroundColor: '#01696f',
            }]
        },
        options: {
            scales: { r: { min: 0, max: 10, ticks: { stepSize: 2 } } },
            plugins: { legend: { display: false } }
        }
    });
</script>

<style>
.practitioner-header .prac-info { display:flex; gap:var(--space-4); align-items:flex-start; }
.prac-avatar {
    width:56px; height:56px; border-radius:var(--radius-full);
    background:var(--color-primary); color:#fff;
    display:flex; align-items:center; justify-content:center;
    font-size:var(--text-lg); font-weight:700; flex-shrink:0;
}
.diagnoses-chips { display:flex; gap:var(--space-2); flex-wrap:wrap; }
.domains-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:var(--space-6); }
.domain-item { display:flex; flex-direction:column; gap:var(--space-1); }
.domain-header { display:flex; justify-content:space-between; align-items:center; }
.domain-header label { font-weight:600; font-size:var(--text-sm); }
.domain-value { font-size:var(--text-lg); font-weight:700; color:var(--color-primary); min-width:24px; text-align:right; }
.range-labels { display:flex; justify-content:space-between; font-size:var(--text-xs); color:var(--color-text-muted); }
.domain-hint { font-size:var(--text-xs); color:var(--color-text-muted); margin:0; }
input[type=range] { width:100%; accent-color:var(--color-primary); }
.cue-grid { display:flex; flex-wrap:wrap; gap:var(--space-2); }
.cue-chip { display:flex; align-items:center; gap:var(--space-2); padding:var(--space-2) var(--space-3); border-radius:var(--radius-full); border:1px solid var(--color-border); cursor:pointer; font-size:var(--text-sm); }
.cue-chip input { margin:0; }
.cue-positive { border-color:var(--color-success); background:var(--color-success-highlight); }
.cue-negative { border-color:var(--color-error); background:var(--color-error-highlight); }
.cue-neutral  { border-color:var(--color-border); }
.score-bar { background:var(--color-surface-offset); border-radius:var(--radius-full); height:8px; overflow:hidden; }
.score-fill { height:100%; border-radius:var(--radius-full); transition:width 0.4s; }
.overall-score { display:flex; justify-content:space-between; align-items:center; margin-top:var(--space-4); padding-top:var(--space-4); border-top:1px solid var(--color-divider); font-size:var(--text-lg); }
.overall-score strong { font-size:var(--text-xl); color:var(--color-primary); }
.assessments-timeline { display:flex; flex-direction:column; gap:var(--space-4); }
.timeline-item { display:grid; grid-template-columns:120px 1fr; gap:var(--space-4); padding:var(--space-4); border-radius:var(--radius-md); background:var(--color-surface-offset); }
.timeline-date { font-weight:600; font-size:var(--text-sm); color:var(--color-primary); padding-top:var(--space-1); }
.timeline-body { display:flex; flex-direction:column; gap:var(--space-2); }
.timeline-header { display:flex; justify-content:space-between; align-items:center; }
.timeline-note { font-size:var(--text-sm); line-height:1.5; }
.cue-evidence { display:flex; flex-wrap:wrap; gap:var(--space-1); align-items:center; }
.badge-sm { font-size:var(--text-xs) !important; padding:2px 8px !important; }
.badge-purple { background:var(--color-purple-highlight); color:var(--color-purple); }
.badge-yellow { background:var(--color-gold-highlight); color:var(--color-gold); }
.form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:var(--space-4); }
.form-grid-1 { display:flex; flex-direction:column; gap:var(--space-4); }
.form-actions { display:flex; justify-content:flex-end; gap:var(--space-3); padding-top:var(--space-4); }
.mb-6 { margin-bottom:var(--space-6); }
.mt-6 { margin-top:var(--space-6); }
.mt-2 { margin-top:var(--space-2); }
@media(max-width:768px){ .timeline-item{grid-template-columns:1fr;} .two-col{grid-template-columns:1fr;} .domains-grid{grid-template-columns:1fr;} }
@media print { .header-actions, .btn { display:none; } canvas { max-height:200px; } }
</style>
@endsection
