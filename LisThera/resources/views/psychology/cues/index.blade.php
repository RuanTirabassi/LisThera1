@extends('layouts.app')

@section('title', 'Memory Cues — Avaliação Psicológica')

@section('content')
<div class="page-header">
    <div>
        <h1>Memory Cues</h1>
        <span class="text-muted">{{ $psychology->practitioner?->fullname ?? '—' }} · Avaliação Psicológica</span>
    </div>
    <div class="header-actions">
        <a href="{{ route('psychology.show', $psychology) }}" class="btn btn-ghost">← Voltar à Avaliação</a>
        <a href="{{ route('psychology.cues.create', $psychology) }}" class="btn btn-primary">+ Novo Cue</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($cues->isEmpty())
<div class="empty-state">
    <div class="empty-state-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 0 14 18.469V19a2 2 0 1 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
        </svg>
    </div>
    <h3>Nenhum Memory Cue cadastrado</h3>
    <p>Adicione pistas de memória para orientar as sessões de equoterapia.</p>
    <a href="{{ route('psychology.cues.create', $psychology) }}" class="btn btn-primary">+ Adicionar Cue</a>
</div>
@else
<div class="card" style="margin-top:var(--space-4)">
    <div class="card-body" style="padding:0">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Rótulo / Template</th>
                    <th>Tipo</th>
                    <th>Intensidade</th>
                    <th>Descrição</th>
                    <th>Notas do Terapeuta</th>
                    <th style="width:120px">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cues as $cue)
            <tr>
                <td>
                    <strong>{{ $cue->cue_label ?: ($cue->memoryCueTemplate?->label ?? '—') }}</strong>
                    @if($cue->memoryCueTemplate)
                    <br><small class="text-muted">Template: {{ $cue->memoryCueTemplate->label }}</small>
                    @endif
                </td>
                <td>
                    <span class="badge badge-{{ ['visual'=>'blue','auditivo'=>'green','tátil'=>'yellow','verbal'=>'purple','outro'=>'gray'][$cue->cue_type] ?? 'gray' }}">
                        {{ ucfirst($cue->cue_type) }}
                    </span>
                </td>
                <td>
                    @if($cue->intensity)
                    <div class="intensity-dots">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="dot {{ $i <= $cue->intensity ? 'dot-active' : '' }}"></span>
                        @endfor
                    </div>
                    @else
                    <span class="text-muted">—</span>
                    @endif
                </td>
                <td style="max-width:240px">{{ Str::limit($cue->cue_description, 80) ?: '—' }}</td>
                <td style="max-width:200px">{{ Str::limit($cue->therapist_notes, 60) ?: '—' }}</td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('psychology.cues.edit', [$psychology, $cue]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form method="POST" action="{{ route('psychology.cues.destroy', [$psychology, $cue]) }}"
                              onsubmit="return confirm('Remover este Memory Cue?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<style>
.header-actions{display:flex;gap:var(--space-2);}
.row-actions{display:flex;gap:var(--space-1);}
.alert-success{background:var(--color-success-highlight);color:var(--color-success);border:1px solid var(--color-success);border-radius:var(--radius-md);padding:var(--space-3) var(--space-4);margin-bottom:var(--space-4);}
.empty-state{display:flex;flex-direction:column;align-items:center;text-align:center;padding:var(--space-16) var(--space-8);color:var(--color-text-muted);}
.empty-state-icon{margin-bottom:var(--space-4);color:var(--color-text-faint);}
.empty-state h3{color:var(--color-text);margin-bottom:var(--space-2);}
.empty-state p{max-width:36ch;margin-bottom:var(--space-6);}
.badge-blue{background:var(--color-blue-highlight);color:var(--color-blue);}
.badge-green{background:var(--color-success-highlight);color:var(--color-success);}
.badge-yellow{background:var(--color-gold-highlight);color:var(--color-gold);}
.badge-purple{background:var(--color-purple-highlight);color:var(--color-purple);}
.badge-gray{background:var(--color-surface-offset);color:var(--color-text-muted);}
.intensity-dots{display:flex;gap:4px;align-items:center;}
.dot{width:10px;height:10px;border-radius:50%;background:var(--color-border);}
.dot-active{background:var(--color-primary);}
</style>
@endsection
