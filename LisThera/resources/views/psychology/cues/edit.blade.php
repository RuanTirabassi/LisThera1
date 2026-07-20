@extends('layouts.app')

@section('title', 'Editar Memory Cue')

@section('content')
<div class="page-header">
    <div>
        <h1>Editar Memory Cue</h1>
        <span class="text-muted">{{ $psychology->practitioner?->fullname ?? '—' }} · Avaliação Psicológica</span>
    </div>
    <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('psychology.cues.update', [$psychology, $cue]) }}">
        @csrf @method('PUT')

        {{-- Template (opcional) --}}
        <div class="form-group">
            <label for="memory_cue_template_id">Template de Cue <span class="text-muted">(opcional)</span></label>
            <select name="memory_cue_template_id" id="memory_cue_template_id" class="form-control">
                <option value="">— Selecionar template —</option>
                @foreach($templates as $tpl)
                <option value="{{ $tpl->id }}"
                    {{ (old('memory_cue_template_id', $cue->memory_cue_template_id) == $tpl->id) ? 'selected' : '' }}>
                    {{ $tpl->label }}
                </option>
                @endforeach
            </select>
            @error('memory_cue_template_id')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="cue_label">Rótulo do Cue</label>
                <input type="text" name="cue_label" id="cue_label" class="form-control"
                       value="{{ old('cue_label', $cue->cue_label) }}" maxlength="120">
                @error('cue_label')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="cue_type">Tipo *</label>
                <select name="cue_type" id="cue_type" class="form-control">
                    @foreach(['visual','auditivo','tátil','verbal','outro'] as $tipo)
                    <option value="{{ $tipo }}" {{ old('cue_type', $cue->cue_type) === $tipo ? 'selected' : '' }}>{{ ucfirst($tipo) }}</option>
                    @endforeach
                </select>
                @error('cue_type')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label>Intensidade <span class="text-muted">(1 = leve, 5 = forte)</span></label>
            <div class="intensity-picker">
                @for($i = 1; $i <= 5; $i++)
                <label class="intensity-opt">
                    <input type="radio" name="intensity" value="{{ $i }}"
                        {{ old('intensity', $cue->intensity) == $i ? 'checked' : '' }}>
                    <span class="intensity-btn">{{ $i }}</span>
                </label>
                @endfor
            </div>
            @error('intensity')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="cue_description">Descrição / Instrução</label>
            <textarea name="cue_description" id="cue_description" class="form-control" rows="3">{{ old('cue_description', $cue->cue_description) }}</textarea>
            @error('cue_description')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="therapist_notes">Notas do Psicólogo</label>
            <textarea name="therapist_notes" id="therapist_notes" class="form-control" rows="3">{{ old('therapist_notes', $cue->therapist_notes) }}</textarea>
            @error('therapist_notes')<span class="form-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
    </form>
</div>

<style>
.form-card{background:var(--color-surface);border:1px solid var(--color-border);border-radius:var(--radius-lg);padding:var(--space-8);max-width:720px;margin-top:var(--space-4);}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);}
.form-group{display:flex;flex-direction:column;gap:var(--space-1);margin-bottom:var(--space-4);}
.form-group label{font-size:var(--text-sm);font-weight:600;color:var(--color-text);}
.form-control{border:1px solid var(--color-border);border-radius:var(--radius-md);padding:var(--space-2) var(--space-3);font-size:var(--text-sm);background:var(--color-surface-2);color:var(--color-text);transition:border-color var(--transition-interactive);}
.form-control:focus{outline:none;border-color:var(--color-primary);}
.form-error{font-size:var(--text-xs);color:var(--color-error);}
.form-actions{display:flex;justify-content:flex-end;gap:var(--space-2);margin-top:var(--space-4);}
.intensity-picker{display:flex;gap:var(--space-2);}
.intensity-opt input{display:none;}
.intensity-btn{display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:var(--radius-md);border:2px solid var(--color-border);cursor:pointer;font-weight:700;font-size:var(--text-sm);transition:all var(--transition-interactive);}
.intensity-opt input:checked + .intensity-btn{background:var(--color-primary);border-color:var(--color-primary);color:#fff;}
.intensity-btn:hover{border-color:var(--color-primary);}
@media(max-width:600px){.form-row{grid-template-columns:1fr;}}
</style>
@endsection
