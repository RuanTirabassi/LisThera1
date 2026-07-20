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

    {{-- ABAS --}}
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
                        <label for="practitionerid">Praticante <span class="required">*</span></label>
                        <select name="practitionerid" id="practitionerid" required>
                            <option value="">Selecione o praticante...</option>
                            @foreach($praticantes as $p)
                                <option value="{{ $p->id }}" {{ old('practitionerid') == $p->id ? 'selected' : '' }}>
                                    {{ $p->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assessedat">Data da Avaliação <span class="required">*</span></label>
                        <input type="date" name="assessedat" id="assessedat" required
                            value="{{ old('assessedat', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label for="therapistid">Psicólogo Responsável</label>
                        <select name="therapistid" id="therapistid">
                            <option value="">Selecione...</option>
                            @foreach($terapeutas as $t)
                                <option value="{{ $t->id }}" {{ old('therapistid') == $t->id ? 'selected' : '' }}>
                                    {{ $t->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="arenasessionid">Sessão de Arena (opcional)</label>
                        <select name="arenasessionid" id="arenasessionid">
                            <option value="">Selecione...</option>
                            @foreach($sessoes as $s)
                                <option value="{{ $s->id }}" {{ old('arenasessionid') == $s->id ? 'selected' : '' }}>
                                    Sessão #{{ $s->id }} — {{ $s->startedat?->format('d/m/Y') ?? 'S/D' }}
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
                        'emotionalregulation' => ['Regulação Emocional',    'Reconhece e regula emoções durante a sessão'],
                        'socialinteraction'   => ['Interação Social',        'Qualidade das interações com terapeuta e equipe'],
                        'communication'       => ['Comunicação',             'Expressão verbal e não-verbal'],
                        'attentionfocus'      => ['Atenção / Foco',          'Mantém atenção nas tarefas propostas'],
                        'behavioralresponse'  => ['Resp. Comportamental',   'Resposta a comandos e situações novas'],
                        'anxietylevel'        => ['Nível de Ansiedade',      '0 = sem ansiedade, 10 = ansiedade máxima'],
                        'motivation'          => ['Motivação',               'Engajamento e vontade de participar'],
                        'selfesteem'          => ['Autoestima',              'Autoconfiança e autoimagem positiva'],
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
                        <input type="date" name="datadiagnostico" value="{{ old('datadiagnostico') }}">
                    </div>
                    <div class="form-group col-span-2">
                        <label>Profissional do Diagnóstico</label>
                        <input type="text" name="profissionaldiagnostico" value="{{ old('profissionaldiagnostico') }}" placeholder="Nome do profissional...">
                    </div>
                    <div class="form-group">
                        <label>Usa Medicação?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="usamedicacao" value="1" {{ old('usamedicacao') == '1' ? 'checked' : '' }}> Sim</label>
                            <label><input type="radio" name="usamedicacao" value="0" {{ old('usamedicacao') === '0' ? 'checked' : '' }} checked> Não</label>
                        </div>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Medicação e Dosagem</label>
                        <textarea name="medicacaodosagem" rows="2" placeholder="Medicação, dosagem e frequência...">{{ old('medicacaodosagem') }}</textarea>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Tratamento Específico</label>
                        <textarea name="tratamentoespecifico" rows="2" placeholder="Outros tratamentos em andamento...">{{ old('tratamentoespecifico') }}</textarea>
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
                    @foreach(['sonorecem' => 'Sono Recém-Nascido', 'sonoatual' => 'Sono Atual', 'ondedorme' => 'Onde Dorme'] as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                </div>
                <div class="section-title mt-4">Cognitivo</div>
                <div class="form-grid-2">
                    @foreach(['percepcao' => 'Percepção', 'atencaoconcentracao' => 'Atenção e Concentração', 'memoria' => 'Memória', 'conceitos' => 'Conceitos'] as $f => $l)
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
                        'linguagemverbalfuncional' => 'Linguagem Verbal Funcional',
                        'linguagemdialogo'         => 'Diálogo',
                        'linguagemimitasons'       => 'Imita Sons',
                        'linguagemletrassilabas'   => 'Letras e Sílabas',
                        'linguagemleituraescrita'  => 'Leitura e Escrita',
                        'linguagemnumeros'         => 'Números',
                        'linguagemoperacoes'       => 'Operações Matemáticas',
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
                        'contatovisual'            => 'Contato Visual',
                        'interacao'                => 'Interação',
                        'brincar'                  => 'Brincar',
                        'humor'                    => 'Humor',
                        'frustracao'               => 'Frustração',
                        'comportamentoagressivo'   => 'Comportamento Agressivo',
                        'aceitaregras'             => 'Aceita Regras',
                        'reacaoresponsaveis'       => 'Reação aos Responsáveis',
                        'compreensaocertoerrado'   => 'Compreensão Certo/Errado',
                        'atividadesvidadiaria'     => 'Atividades de Vida Diária',
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
                    @foreach(['comportamentoestereotipado' => 'Comportamento Estereotipado', 'mania' => 'Mania', 'objetofixacao' => 'Objeto de Fixação', 'medos' => 'Medos'] as $f => $l)
                    <div class="form-group">
                        <label>{{ $l }}</label>
                        <textarea name="{{ $f }}" rows="2" placeholder="Descreva...">{{ old($f) }}</textarea>
                    </div>
                    @endforeach
                    <div class="form-group col-span-2">
                        <label>Principais Queixas</label>
                        <textarea name="principaisqueixas" rows="3" placeholder="Queixas apresentadas pelos responsáveis ou observadas...">{{ old('principaisqueixas') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Escore Geral (0–100)</label>
                        <input type="number" name="overallscore" min="0" max="100" value="{{ old('overallscore') }}" placeholder="Ex: 72">
                    </div>
                    <div class="form-group col-span-2">
                        <label>Evolução Clínica</label>
                        <textarea name="evolutionnotes" rows="3" placeholder="Evolução observada em relação à sessão anterior...">{{ old('evolutionnotes') }}</textarea>
                    </div>
                    <div class="form-group col-span-2">
                        <label>Observações da Sessão</label>
                        <textarea name="sessionnotes" rows="3" placeholder="Intercorrências, comportamentos específicos, contexto...">{{ old('sessionnotes') }}</textarea>
                    </div>
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba6">← Anterior</button>
                    <button type="submit" class="btn btn-primary">Salvar Avaliação</button>
                </div>
            </div>

        </div>{{-- card-body --}}
    </div>{{-- card --}}
</form>

@include('psychology._tabs_script')
@endsection
