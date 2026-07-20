@extends('layouts.app')

@section('title', 'Nova Avaliação Psicológica')

@section('content')
<div class="page-header">
    <h1>Nova Avaliação Psicológica</h1>
    <a href="{{ route('psychology.index') }}" class="btn btn-ghost">← Voltar</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('psychology.store') }}">
    @csrf

    <div class="tabs-header">
        <button type="button" class="tab-btn active" data-tab="aba1">1. Identificação</button>
        <button type="button" class="tab-btn" data-tab="aba2">2. Dom. Clínicos</button>
        <button type="button" class="tab-btn" data-tab="aba3">3. Diagnóstico</button>
        <button type="button" class="tab-btn" data-tab="aba4">4. Sono e Cognição</button>
        <button type="button" class="tab-btn" data-tab="aba5">5. Linguagem</button>
        <button type="button" class="tab-btn" data-tab="aba6">6. Asp. Sociais</button>
        <button type="button" class="tab-btn" data-tab="aba7">7. Observações</button>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- ABA 1: Identificação --}}
            <div class="tab-pane active" id="aba1">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="practitioner_id">Praticante <span class="required">*</span></label>
                        <select name="practitioner_id" id="practitioner_id" required>
                            <option value="">Selecione o praticante...</option>
                            @foreach($praticantes as $p)
                                <option value="{{ $p->id }}" {{ old('practitioner_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assessment_date">Data da Avaliação <span class="required">*</span></label>
                        <input type="date" name="assessment_date" id="assessment_date" required
                            value="{{ old('assessment_date', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label for="therapist_id">Psicólogo Responsável</label>
                        <select name="therapist_id" id="therapist_id">
                            <option value="">Selecione...</option>
                            @foreach($terapeutas as $t)
                                <option value="{{ $t->id }}" {{ old('therapist_id') == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="arena_session_id">Sessão de Arena (opcional)</label>
                        <select name="arena_session_id" id="arena_session_id">
                            <option value="">Selecione...</option>
                            @foreach($sessoes as $s)
                                <option value="{{ $s->id }}" {{ old('arena_session_id') == $s->id ? 'selected' : '' }}>
                                    Sessão #{{ $s->id }} — {{ $s->started_at?->format('d/m/Y') ?? 'S/D' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tab-nav-footer">
                    <span></span>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba2">Próximo →</button>
                </div>
            </div>

            {{-- ABA 2: Domínios Clínicos --}}
            <div class="tab-pane" id="aba2">
                <p class="tab-hint">Avalie cada domínio de 0 (ausente/muito baixo) a 10 (excelente/muito alto). Para Ansiedade, 0 = sem ansiedade.</p>
                <div class="domains-grid">
                    @php
                    $dominios = [
                        'emotional_regulation' => ['Regulação Emocional',    'Reconhece e regula emoções durante a sessão'],
                        'social_interaction'   => ['Interação Social',        'Qualidade das interações com terapeuta e equipe'],
                        'communication'        => ['Comunicação',             'Expressão verbal e não-verbal'],
                        'attention_focus'      => ['Atenção / Foco',          'Mantém atenção nas tarefas propostas'],
                        'behavioral_response'  => ['Resp. Comportamental',   'Resposta a comandos e situações novas'],
                        'anxiety_level'        => ['Nível de Ansiedade',      '0 = sem ansiedade, 10 = ansiedade máxima'],
                        'motivation'           => ['Motivação',               'Engajamento e vontade de participar'],
                        'self_esteem'          => ['Autoestima',              'Autoconfiança e autoimagem positiva'],
                    ];
                    @endphp
                    @foreach($dominios as $field => [$label, $hint])
                    <div class="domain-item">
                        <div class="domain-header">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <span class="domain-value" id="{{ $field }}_val">{{ old($field, 5) }}</span>
                        </div>
                        <input type="range" min="0" max="10" step="1"
                            name="{{ $field }}" id="{{ $field }}"
                            value="{{ old($field, 5) }}"
                            oninput="document.getElementById('{{ $field }}_val').textContent=this.value">
                        <div class="range-labels"><span>0</span><span>5</span><span>10</span></div>
                        <p class="domain-hint">{{ $hint }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba1">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba3">Próximo →</button>
                </div>
            </div>

            {{-- ABA 3: Diagnóstico --}}
            <div class="tab-pane" id="aba3">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>CID</label>
                        <input type="text" name="cid" value="{{ old('cid') }}" placeholder="Ex: F84.0">
                    </div>
                    <div class="form-group">
                        <label>Data do Diagnóstico</label>
                        <input type="date" name="diagnosis_date" value="{{ old('diagnosis_date') }}">
                    </div>
                    <div class="form-group col-span-2">
                        <label>Profissional do Diagnóstico</label>
                        <input type="text" name="diagnosis_professional" value="{{ old('diagnosis_professional') }}" placeholder="Nome do profissional...">
                    </div>
                    <div class="form-group">
                        <label>Usa Medicação?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="uses_medication" value="1" {{ old('uses_medication') == '1' ? 'checked' : '' }}> Sim</label>
                            <label><input type="radio" name="uses_medication" value="0" {{ old('uses_medication') === '0' ? 'checked' : '' }} checked> Não</label>
                        </div>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Medicação e Dosagem</label>
                        <textarea name="medication_dosage" rows="2" placeholder="Medicação, dosagem e frequência...">{{ old('medication_dosage') }}</textarea>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Tratamento Específico</label>
                        <textarea name="specific_treatment" rows="2" placeholder="Outros tratamentos em andamento...">{{ old('specific_treatment') }}</textarea>
                    </div>
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba2">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba4">Próximo →</button>
                </div>
            </div>

            {{-- ABA 4: Sono e Cognição --}}
            <div class="tab-pane" id="aba4">
                <div class="section-title">Sono</div>
                <div class="form-grid-2">
                    @foreach(['sleep_newborn' => 'Sono Recém-Nascido', 'sleep_current' => 'Sono Atual', 'sleep_location' => 'Onde Dorme'] as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="section-title mt-4">Cognitivo</div>
                <div class="form-grid-2">
                    @foreach(['perception' => 'Percepção', 'attention_concentration' => 'Atenção e Concentração', 'memory' => 'Memória', 'concepts' => 'Conceitos'] as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba3">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba5">Próximo →</button>
                </div>
            </div>

            {{-- ABA 5: Linguagem --}}
            <div class="tab-pane" id="aba5">
                <div class="form-grid-2">
                    @php
                    $linguagem = [
                        'language_verbal_functional' => 'Linguagem Verbal Funcional',
                        'language_dialogue'          => 'Diálogo',
                        'language_imitates_sounds'   => 'Imita Sons',
                        'language_letters_syllables' => 'Letras e Sílabas',
                        'language_reading_writing'   => 'Leitura e Escrita',
                        'language_numbers'           => 'Números',
                        'language_math_operations'   => 'Operações Matemáticas',
                    ];
                    @endphp
                    @foreach($linguagem as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba4">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba6">Próximo →</button>
                </div>
            </div>

            {{-- ABA 6: Aspectos Sociais --}}
            <div class="tab-pane" id="aba6">
                <div class="form-grid-2">
                    @php
                    $sociais = [
                        'eye_contact'              => 'Contato Visual',
                        'interaction'              => 'Interação',
                        'play'                     => 'Brincar',
                        'mood'                     => 'Humor',
                        'frustration'              => 'Frustração',
                        'aggressive_behavior'      => 'Comportamento Agressivo',
                        'accepts_rules'            => 'Aceita Regras',
                        'reaction_to_guardians'    => 'Reação aos Responsáveis',
                        'right_wrong_understanding'=> 'Compreensão Certo/Errado',
                        'daily_life_activities'    => 'Atividades de Vida Diária',
                    ];
                    @endphp
                    @foreach($sociais as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba5">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba7">Próximo →</button>
                </div>
            </div>

            {{-- ABA 7: Observações Finais --}}
            <div class="tab-pane" id="aba7">
                <div class="form-grid-2">
                    @foreach(['stereotyped_behavior' => 'Comportamento Estereotipado', 'mania' => 'Mania', 'fixation_object' => 'Objeto de Fixação', 'fears' => 'Medos'] as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                    <div class="form-group col-span-2">
                        <label>Principais Queixas</label>
                        <textarea name="main_complaints" rows="3" placeholder="Queixas apresentadas pelos responsáveis ou observadas...">{{ old('main_complaints') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Escore Geral (0–100)</label>
                        <input type="number" name="overall_score" min="0" max="100" value="{{ old('overall_score') }}" placeholder="Ex: 72">
                    </div>
                    <div class="form-group col-span-2">
                        <label>Evolução Clínica</label>
                        <textarea name="evolution_notes" rows="3" placeholder="Evolução observada em relação à sessão anterior...">{{ old('evolution_notes') }}</textarea>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Observações da Sessão</label>
                        <textarea name="session_notes" rows="3" placeholder="Intercorrências, comportamentos específicos, contexto...">{{ old('session_notes') }}</textarea>
                    </div>
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba6">← Anterior</button>
                    <button type="submit" class="btn btn-primary">Salvar Avaliação</button>
                </div>
            </div>

        </div>
    </div>
</form>

@include('psychology._tabs_script')
@endsection
