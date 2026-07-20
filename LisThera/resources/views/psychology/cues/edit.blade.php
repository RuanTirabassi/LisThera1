@extends('layouts.app')

@section('title', 'Editar Vínculo de Cue')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar Vínculo de Cue</h1>
        <span class="text-muted">{{ $psychology->practitioner?->fullname ?? '—' }} · Avaliação Psicológica</span>
    </div>
    <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('psychology.cues.update', [$psychology, $cue]) }}">
        @csrf @method('PUT')

        {{-- Evento de Memória --}}
        <div class="form-group">
            <label for="sessionmemorycueeventid">Evento de Memória (Sessão #{{ $psychology->arenasessionid }}) *</label>
            <select name="sessionmemorycueeventid" id="sessionmemorycueeventid" class="form-control" required>
                <option value="">— Selecionar evento —</option>
                @foreach($availableEvents as $event)
                <option value="{{ $event->id }}"
                    {{ (old('sessionmemorycueeventid', $cue->sessionmemorycueeventid) == $event->id) ? 'selected' : '' }}>
                    {{ $event->memoryCueTemplate?->label ?? 'Evento #'.$event->id }}
                    — {{ $event->recordedat?->format('d/m/Y H:i') ?? '' }}
                </option>
                @endforeach
            </select>
            @error('sessionmemorycueeventid')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        {{-- Intensidade --}}
        <div class="form-group">
            <label>Intensidade do Cue <span class="text-muted">(1 = muito leve — 10 = máxima)</span></label>
            <div class="intensity-picker">
                @for($i = 1; $i <= 10; $i++)
                <label class="intensity-opt">
                    <input type="radio" name="intensityscore" value="{{ $i }}"
                        {{ old('intensityscore', $cue->intensityscore) == $i ? 'checked' : '' }}>
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
                      placeholder="Descreva a justificativa clínica para incluir este cue na avaliação...">{{ old('professionaljustification', $cue->professionaljustification) }}</textarea>
            @error('professionaljustification')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>

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
</style>
@endsection
