@extends('layouts.app')

@section('title', 'Avaliação Psicológica — ' . ($practitioner?->name ?? 'Praticante'))

@section('content')
<div class="page-header">
    <div>
        <h1>Avaliação Psicológica</h1>
        @if($practitioner)
            <span class="text-muted">{{ $practitioner->name }}</span>
        @endif
    </div>
    @if($practitioner)
        <a href="{{ route('psychology.report', $practitioner) }}" class="btn btn-ghost">
            Ver Relatório Evolutivo
        </a>
    @endif
</div>

{{-- Resumo da sessão --}}
<div class="card mb-6">
    <div class="card-body meta-row">
        <span><strong>Sessão:</strong> #{{ $session->id }}</span>
        <span><strong>Data:</strong> {{ $session->started_at?->format('d/m/Y H:i') ?? '—' }}</span>
        <span><strong>Arena:</strong> {{ $session->arena?->name ?? '—' }}</span>
        <span><strong>Terapeuta:</strong> {{ $session->startedByTherapist?->name ?? '—' }}</span>
    </div>
</div>

<form method="POST" action="{{ route('psychology.store', $session) }}">
    @csrf

    {{-- Terapeuta avaliador + data --}}
    <div class="card mb-6">
        <div class="card-header"><h2>Identificação da Avaliação</h2></div>
        <div class="card-body form-grid-2">
            <div class="form-group">
                <label for="therapist_id">Psicólogo responsável</label>
                <select name="therapist_id" id="therapist_id" required>
                    <option value="">Selecionar...</option>
                    {{-- populado via controller se necessário --}}
                    @if($existing)
                        <option value="{{ $existing->therapist_id }}" selected>
                            {{ $existing->therapist?->name }}
                        </option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="assessed_at">Data da avaliação</label>
                <input type="datetime-local" name="assessed_at" id="assessed_at" required
                    value="{{ $existing ? $existing->assessed_at?->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i') }}">
            </div>
        </div>
    </div>

    {{-- Domínios clínicos (escala 0-10) --}}
    <div class="card mb-6">
        <div class="card-header">
            <h2>Domínios Clínicos <span class="text-muted" style="font-weight:400;font-size:var(--text-sm)">(escala 0–10)</span></h2>
        </div>
        <div class="card-body">
            <div class="domains-grid">
                @php
                    $domains = [
                        'emotional_regulation' => ['Regulação Emocional', 'Capacidade de reconhecer e regular emoções durante a sessão'],
                        'social_interaction'   => ['Interação Social', 'Qualidade das interações com terapeuta e equipe'],
                        'communication'        => ['Comunicação', 'Expressão verbal e não-verbal'],
                        'attention_focus'      => ['Atenção / Foco', 'Capacidade de manter atenção nas tarefas propostas'],
                        'behavioral_response'  => ['Resposta Comportamental', 'Resposta a comandos e situações novas'],
                        'anxiety_level'        => ['Nível de Ansiedade', 'Sinais de ansiedade ou medo observados (0 = sem ansiedade)'],
                        'motivation'           => ['Motivação', 'Engajamento e vontade de participar'],
                        'self_esteem'          => ['Autoestima', 'Expressões de autoconfiança e autoimagem positiva'],
                    ];
                @endphp

                @foreach($domains as $field => [$label, $hint])
                <div class="domain-item">
                    <div class="domain-header">
                        <label for="{{ $field }}">{{ $label }}</label>
                        <span class="domain-value" id="{{ $field }}_val">
                            {{ $existing?->{$field} ?? '—' }}
                        </span>
                    </div>
                    <input
                        type="range" min="0" max="10" step="1"
                        name="{{ $field }}" id="{{ $field }}"
                        value="{{ $existing?->{$field} ?? 5 }}"
                        oninput="document.getElementById('{{ $field }}_val').textContent = this.value"
                    >
                    <div class="range-labels"><span>0</span><span>5</span><span>10</span></div>
                    <p class="domain-hint">{{ $hint }}</p>
                </div>
                @endforeach
            </div>

            <div class="form-group mt-6">
                <label for="overall_score">Escore geral (0–100)</label>
                <input type="number" name="overall_score" id="overall_score" min="0" max="100"
                    value="{{ $existing?->overall_score ?? '' }}"
                    placeholder="Calculado ou inserido manualmente">
            </div>
        </div>
    </div>

    {{-- Cues observados na sessão --}}
    @if($session->memoryCueEvents->count())
    <div class="card mb-6">
        <div class="card-header">
            <h2>Cues Observados na Sessão</h2>
            <span class="text-muted">Selecione os que fundamentam esta avaliação</span>
        </div>
        <div class="card-body">
            <div class="cue-grid">
                @foreach($session->memoryCueEvents as $event)
                <label class="cue-chip {{ $event->template?->polarity === 'positive' ? 'cue-positive' : ($event->template?->polarity === 'negative' ? 'cue-negative' : 'cue-neutral') }}">
                    <input type="checkbox" name="cue_event_ids[]" value="{{ $event->id }}"
                        {{ $existing && $existing->cueLinks->pluck('session_memory_cue_event_id')->contains($event->id) ? 'checked' : '' }}>
                    <span>{{ $event->template?->cue_label ?? 'Cue #' . $event->id }}</span>
                    <small>{{ $event->recorded_at?->format('H:i:s') }}</small>
                </label>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Observações --}}
    <div class="card mb-6">
        <div class="card-header"><h2>Observações</h2></div>
        <div class="card-body form-grid-1">
            <div class="form-group">
                <label for="evolution_notes">Evolução clínica observada</label>
                <textarea name="evolution_notes" id="evolution_notes" rows="4"
                    placeholder="Descreva a evolução do praticante em relação à sessão anterior...">{{ $existing?->evolution_notes }}</textarea>
            </div>
            <div class="form-group">
                <label for="session_notes">Observações da sessão</label>
                <textarea name="session_notes" id="session_notes" rows="3"
                    placeholder="Intercorrências, comportamentos específicos, contexto...">{{ $existing?->session_notes }}</textarea>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('sessions.show', $session) }}" class="btn btn-ghost">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar Avaliação</button>
    </div>
</form>
@endsection
