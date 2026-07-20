@extends('layouts.app')

@section('title', 'Editar Avaliação Psicológica')

@section('content')
<div class="page-header">
    <h1>Editar Avaliação Psicológica</h1>
    <a href="{{ route('psychology.index') }}" class="btn btn-ghost">← Voltar</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

@php $av = $psychology; @endphp

<form method="POST" action="{{ route('psychology.update', $av) }}">
    @csrf @method('PUT')

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

            {{-- ABA 1 --}}
            <div class="tab-pane active" id="aba1">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Praticante <span class="required">*</span></label>
                        <select name="practitionerid" required>
                            <option value="">Selecione...</option>
                            @foreach($praticantes as $p)
                                <option value="{{ $p->id }}" {{ $av->practitionerid == $p->id ? 'selected' : '' }}>{{ $p->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data da Avaliação <span class="required">*</span></label>
                        <input type="date" name="assessedat" required
                            value="{{ $av->assessedat?->format('Y-m-d') ?? date('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label>Psicólogo Responsável</label>
                        <select name="therapistid">
                            <option value="">Selecione...</option>
                            @foreach($terapeutas as $t)
                                <option value="{{ $t->id }}" {{ $av->therapistid == $t->id ? 'selected' : '' }}>{{ $t->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sessão de Arena (opcional)</label>
                        <select name="arenasessionid">
                            <option value="">Selecione...</option>
                            @foreach($sessoes as $s)
                                <option value="{{ $s->id }}" {{ $av->arenasessionid == $s->id ? 'selected' : '' }}>
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

            {{-- ABA 2 --}}
            <div class="tab-pane" id="aba2">
                <p class="tab-hint">Avalie cada domínio de 0 a 10.</p>
                <div class="domains-grid">
                    @php
                    $dominios = [
                        'emotionalregulation' => ['Regulação Emocional',   'Reconhece e regula emoções durante a sessão'],
                        'socialinteraction'   => ['Interação Social',       'Qualidade das interações'],
                        'communication'       => ['Comunicação',            'Expressão verbal e não-verbal'],
                        'attentionfocus'      => ['Atenção / Foco',         'Mantém atenção nas tarefas propostas'],
                        'behavioralresponse'  => ['Resp. Comportamental',  'Resposta a comandos e situações novas'],
                        'anxietylevel'        => ['Nível de Ansiedade',     '0 = sem ansiedade, 10 = ansiedade máxima'],
                        'motivation'          => ['Motivação',              'Engajamento e vontade de participar'],
                        'selfesteem'          => ['Autoestima',             'Autoconfiança e autoimagem positiva'],
                    ];
                    @endphp
                    @foreach($dominios as $field => [$label, $hint])
                    <div class="domain-item">
                        <div class="domain-header">
                            <label for="e_{{ $field }}">{{ $label }}</label>
                            <span class="domain-value" id="e_{{ $field }}_val">{{ $av->{$field} ?? 5 }}</span>
                        </div>
                        <input type="range" min="0" max="10" step="1"
                            name="{{ $field }}" id="e_{{ $field }}"
                            value="{{ $av->{$field} ?? 5 }}"
                            oninput="document.getElementById('e_{{ $field }}_val').textContent=this.value">
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

            {{-- ABA 3 --}}
            <div class="tab-pane" id="aba3">
                <div class="form-grid-2">
                    <div class="form-group"><label>CID</label><input type="text" name="cid" value="{{ $av->cid }}"></div>
                    <div class="form-group"><label>Data do Diagnóstico</label><input type="date" name="datadiagnostico" value="{{ $av->datadiagnostico }}"></div>
                    <div class="form-group col-span-2"><label>Profissional do Diagnóstico</label><input type="text" name="profissionaldiagnostico" value="{{ $av->profissionaldiagnostico }}"></div>
                    <div class="form-group">
                        <label>Usa Medicação?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="usamedicacao" value="1" {{ $av->usamedicacao ? 'checked' : '' }}> Sim</label>
                            <label><input type="radio" name="usamedicacao" value="0" {{ !$av->usamedicacao ? 'checked' : '' }}> Não</label>
                        </div>
                    </div>
                    <div class="form-group col-span-2"><label>Medicação e Dosagem</label><textarea name="medicacaodosagem" rows="2">{{ $av->medicacaodosagem }}</textarea></div>
                    <div class="form-group col-span-2"><label>Tratamento Específico</label><textarea name="tratamentoespecifico" rows="2">{{ $av->tratamentoespecifico }}</textarea></div>
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba2">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba4">Próximo →</button>
                </div>
            </div>

            {{-- ABA 4 --}}
            <div class="tab-pane" id="aba4">
                <div class="section-title">Sono</div>
                <div class="form-grid-2">
                    @foreach(['sonorecem'=>'Sono Recém-Nascido','sonoatual'=>'Sono Atual','ondedorme'=>'Onde Dorme'] as $f=>$l)
                    <div class="form-group"><label>{{ $l }}</label><textarea name="{{ $f }}" rows="2">{{ $av->{$f} }}</textarea></div>
                    @endforeach
                </div>
                <div class="section-title mt-4">Cognitivo</div>
                <div class="form-grid-2">
                    @foreach(['percepcao'=>'Percepção','atencaoconcentracao'=>'Atenção e Concentração','memoria'=>'Memória','conceitos'=>'Conceitos'] as $f=>$l)
                    <div class="form-group"><label>{{ $l }}</label><textarea name="{{ $f }}" rows="2">{{ $av->{$f} }}</textarea></div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba3">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba5">Próximo →</button>
                </div>
            </div>

            {{-- ABA 5 --}}
            <div class="tab-pane" id="aba5">
                <div class="form-grid-2">
                    @php $linguagem=['linguagemverbalfuncional'=>'Linguagem Verbal Funcional','linguagemdialogo'=>'Diálogo','linguagemimitasons'=>'Imita Sons','linguagemletrassilabas'=>'Letras e Sílabas','linguagemleituraescrita'=>'Leitura e Escrita','linguagemnumeros'=>'Números','linguagemoperacoes'=>'Operações Matemáticas']; @endphp
                    @foreach($linguagem as $f=>$l)
                    <div class="form-group"><label>{{ $l }}</label><textarea name="{{ $f }}" rows="2">{{ $av->{$f} }}</textarea></div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba4">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba6">Próximo →</button>
                </div>
            </div>

            {{-- ABA 6 --}}
            <div class="tab-pane" id="aba6">
                <div class="form-grid-2">
                    @php $sociais=['contatovisual'=>'Contato Visual','interacao'=>'Interação','brincar'=>'Brincar','humor'=>'Humor','frustracao'=>'Frustração','comportamentoagressivo'=>'Comportamento Agressivo','aceitaregras'=>'Aceita Regras','reacaoresponsaveis'=>'Reação aos Responsáveis','compreensaocertoerrado'=>'Compreensão Certo/Errado','atividadesvidadiaria'=>'Atividades de Vida Diária']; @endphp
                    @foreach($sociais as $f=>$l)
                    <div class="form-group"><label>{{ $l }}</label><textarea name="{{ $f }}" rows="2">{{ $av->{$f} }}</textarea></div>
                    @endforeach
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba5">← Anterior</button>
                    <button type="button" class="btn btn-primary tab-next" data-next="aba7">Próximo →</button>
                </div>
            </div>

            {{-- ABA 7 --}}
            <div class="tab-pane" id="aba7">
                <div class="form-grid-2">
                    @foreach(['comportamentoestereotipado'=>'Comportamento Estereotipado','mania'=>'Mania','objetofixacao'=>'Objeto de Fixação','medos'=>'Medos'] as $f=>$l)
                    <div class="form-group"><label>{{ $l }}</label><textarea name="{{ $f }}" rows="2">{{ $av->{$f} }}</textarea></div>
                    @endforeach
                    <div class="form-group col-span-2"><label>Principais Queixas</label><textarea name="principaisqueixas" rows="3">{{ $av->principaisqueixas }}</textarea></div>
                    <div class="form-group"><label>Escore Geral (0–100)</label><input type="number" name="overallscore" min="0" max="100" value="{{ $av->overallscore }}"></div>
                    <div class="form-group col-span-2"><label>Evolução Clínica</label><textarea name="evolutionnotes" rows="3">{{ $av->evolutionnotes }}</textarea></div>
                    <div class="form-group col-span-2"><label>Observações da Sessão</label><textarea name="sessionnotes" rows="3">{{ $av->sessionnotes }}</textarea></div>
                </div>
                <div class="tab-nav-footer">
                    <button type="button" class="btn btn-ghost tab-prev" data-prev="aba6">← Anterior</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>

        </div>
    </div>
</form>

@include('psychology._tabs_script')
@endsection
