@extends('layouts.app')

@section('title', 'Vincular Memory Cue')

@section('content')
<div class="page-header">
    <div>
        <h1>Vincular Memory Cue</h1>
        <span class="text-muted">{{ $psychology->practitioner?->fullname ?? '—' }} · Avaliação Psicológica</span>
    </div>
    <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">← Voltar</a>
</div>

@if($availableEvents->isEmpty())
<div class="empty-state" style="margin-top:var(--space-4)">
    <div class="empty-state-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 8v4m0 4h.01"/>
        </svg>
    </div>
    <h3>Nenhum evento disponível</h3>
    <p>Não há eventos de memória registrados na sessão de arena desta avaliação, ou todos já foram vinculados.</p>
    <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">Voltar</a>
</div>
@else
<div class="form-card">
    <form method="POST" action="{{ route('psychology.cues.store', $psychology) }}">
        @csrf

        {{-- Evento de Memória --}}
        <div class="form-group">
            <label for="sessionmemorycueeventid">Evento de Memória (Sessão #{{ $psychology->arenasessionid }}) *</label>
            <select name="sessionmemorycueeventid" id="sessionmemorycueeventid" class="form-control" required
                    onchange="updatePreview(this)">
                <option value="">— Selecionar evento —</option>
                @foreach($availableEvents as $event)
                <option value="{{ $event->id }}"
                    data-template="{{ $event->memoryCueTemplate?->label ?? 'Sem template' }}"
                    data-desc="{{ $event->memoryCueTemplate?->description ?? '' }}"
                    data-recorded="{{ $event->recordedat?->format('d/m/Y H:i') ?? '' }}"
                    {{ old('sessionmemorycueeventid') == $event->id ? 'selected' : '' }}>
                    {{ $event->memoryCueTemplate?->label ?? 'Evento #'.$event->id }}
                    — {{ $event->recordedat?->format('d/m/Y H:i') ?? '' }}
                </option>
                @endforeach
            </select>
            @error('sessionmemorycueeventid')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        {{-- Preview do evento selecionado --}}
        <div id="event-preview" class="event-preview" style="display:none">
            <p><strong id="prev-template"></strong></p>
            <p id="prev-desc" class="text-muted"></p>
            <small id="prev-recorded" class="text-muted"></small>
        </div>

        {{-- Intensidade --}}
        <div class="form-group">
            <label>Intensidade do Cue <span class="text-muted">(1 = muito leve — 10 = máxima)</span></label>
            <div class="intensity-picker">
                @for($i = 1; $i <= 10; $i++)
                <label class="intensity-opt">
                    <input type="radio" name="intensityscore" value="{{ $i }}" {{ old('intensityscore') == $i ? 'checked' : '' }}>
                    <span class="intensity-btn">{{ $i }}</span>
                </label>
                @endfor
            </div>
            @error('intensityscore')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        {{-- Justificativa --}}
        <div class="form-group">
            <label for="professionaljustification">Justificativa Clínica / Profissional</label>
            <textarea name="professionaljustification" id="professionaljustification" class="form-control" rows="4"
                      placeholder="Descreva a justificativa clínica para incluir este cue na avaliação...">{{ old('professionaljustification') }}</textarea>
            @error('professionaljustification')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Vincular Cue</button>
        </div>
    </form>
</div>
@endif

<style>
.form-card{background:var(--color-surface);border:1px solid var(--color-border);border-radius:var(--radius-lg);padding:var(--space-8);max-width:720px;margin-top:var(--space-4);}
.form-group{display:flex;flex-direction:column;gap:var(--space-1);margin-bottom:var(--space-5);}
.form-group label{font-size:var(--text-sm);font-weight:600;color:var(--color-text);}
.form-control{border:1px solid var(--color-border);border-radius:var(--radius-md);padding:var(--space-2) var(--space-3);font-size:var(--text-sm);background:var(--color-surface-2);color:var(--color-text);transition:border-color var(--transition-interactive);}
.form-control:focus{outline:none;border-color:var(--color-primary);}
.form-error{font-size:var(--text-xs);color:var(--color-error);}
.form-actions{display:flex;justify-content:flex-end;gap:var(--space-2);margin-top:var(--space-4);}
.intensity-picker{display:flex;gap:var(--space-2);flex-wrap:wrap;}
.intensity-opt input{display:none;}
.intensity-btn{display:flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:var(--radius-md);border:2px solid var(--color-border);cursor:pointer;font-weight:700;font-size:var(--text-sm);transition:all var(--transition-interactive);}
.intensity-opt input:checked + .intensity-btn{background:var(--color-primary);border-color:var(--color-primary);color:#fff;}
.intensity-btn:hover{border-color:var(--color-primary);}
.event-preview{background:var(--color-surface-offset);border:1px solid var(--color-border);border-radius:var(--radius-md);padding:var(--space-3) var(--space-4);margin-bottom:var(--space-4);}
.event-preview p{margin:0 0 var(--space-1);font-size:var(--text-sm);}
.empty-state{display:flex;flex-direction:column;align-items:center;text-align:center;padding:var(--space-16) var(--space-8);color:var(--color-text-muted);}
.empty-state-icon{margin-bottom:var(--space-4);color:var(--color-text-faint);}
.empty-state h3{color:var(--color-text);margin-bottom:var(--space-2);}
.empty-state p{max-width:40ch;margin-bottom:var(--space-6);}
</style>

<script>
function updatePreview(sel) {
    const opt = sel.options[sel.selectedIndex];
    const preview = document.getElementById('event-preview');
    if (!opt.value) { preview.style.display = 'none'; return; }
    document.getElementById('prev-template').textContent = opt.dataset.template || '';
    document.getElementById('prev-desc').textContent = opt.dataset.desc || '';
    document.getElementById('prev-recorded').textContent = opt.dataset.recorded ? 'Registrado em: ' + opt.dataset.recorded : '';
    preview.style.display = 'block';
}
</script>
@endsection
