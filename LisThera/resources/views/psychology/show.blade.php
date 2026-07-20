@extends('layouts.app')

@section('title', 'Avaliação Psicológica — ' . ($psychology->practitioner?->fullname ?? 'Praticante'))

@section('content')
<div class="page-header">
    <div>
        <h1>Avaliação Psicológica</h1>
        <span class="text-muted">{{ $psychology->practitioner?->fullname ?? '—' }}</span>
    </div>
    <div class="header-actions">
        <a href="{{ route('psychology.index') }}" class="btn btn-ghost">← Voltar</a>
        <a href="{{ route('psychology.cues.index', $psychology) }}" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:-2px">
                <path d="M9.663 17h4.673M12 3v1m6.364 1.636-.707.707M21 12h-1M4 12H3m3.343-5.657-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 0 14 18.469V19a2 2 0 1 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            Memory Cues
        </a>
        <a href="{{ route('psychology.edit', $psychology) }}" class="btn btn-warning">Editar</a>
    </div>
</div>

<div class="show-grid">

    {{-- Identificação --}}
    <div class="card">
        <div class="card-header"><h2>Identificação</h2></div>
        <div class="card-body show-fields">
            <div class="show-field"><span>Praticante</span><strong>{{ $psychology->practitioner?->fullname ?? '—' }}</strong></div>
            <div class="show-field"><span>Data da Avaliação</span><strong>{{ $psychology->assessedat?->format('d/m/Y') ?? '—' }}</strong></div>
            <div class="show-field"><span>Psicólogo</span><strong>{{ $psychology->therapist?->fullname ?? '—' }}</strong></div>
            <div class="show-field"><span>Sessão de Arena</span><strong>{{ $psychology->arenasessionid ? 'Sessão #' . $psychology->arenasessionid : '—' }}</strong></div>
            @if($psychology->overallscore !== null)
            <div class="show-field">
                <span>Escore Geral</span>
                <strong>
                    <span class="badge {{ $psychology->overallscore >= 70 ? 'badge-green' : ($psychology->overallscore >= 40 ? 'badge-yellow' : 'badge-red') }}">
                        {{ $psychology->overallscore }}/100
                    </span>
                </strong>
            </div>
            @endif
        </div>
    </div>

    {{-- Domínios Clínicos --}}
    <div class="card">
        <div class="card-header"><h2>Domínios Clínicos</h2></div>
        <div class="card-body">
            @php
            $dominios = [
                'emotionalregulation' => 'Regulação Emocional',
                'socialinteraction'   => 'Interação Social',
                'communication'       => 'Comunicação',
                'attentionfocus'      => 'Atenção / Foco',
                'behavioralresponse'  => 'Resp. Comportamental',
                'anxietylevel'        => 'Nível de Ansiedade',
                'motivation'          => 'Motivação',
                'selfesteem'          => 'Autoestima',
            ];
            @endphp
            <table class="data-table">
                <thead><tr><th>Domínio</th><th>Escore</th><th></th></tr></thead>
                <tbody>
                @foreach($dominios as $field => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td><strong>{{ $psychology->{$field} ?? '—' }}</strong>{{ $psychology->{$field} !== null ? '/10' : '' }}</td>
                    <td>
                        @if($psychology->{$field} !== null)
                        <div class="score-bar">
                            <div class="score-fill" style="width:{{ ($psychology->{$field}/10)*100 }}%;
                                background:{{ $psychology->{$field} >= 7 ? 'var(--color-success)' : ($psychology->{$field} >= 4 ? 'var(--color-gold)' : 'var(--color-error)') }}"></div>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Diagnóstico --}}
    <div class="card">
        <div class="card-header"><h2>Diagnóstico e Medicação</h2></div>
        <div class="card-body show-fields">
            <div class="show-field"><span>CID</span><strong>{{ $psychology->cid ?? '—' }}</strong></div>
            <div class="show-field"><span>Profissional</span><strong>{{ $psychology->profissionaldiagnostico ?? '—' }}</strong></div>
            <div class="show-field"><span>Data Diagnóstico</span><strong>{{ $psychology->datadiagnostico ?? '—' }}</strong></div>
            <div class="show-field"><span>Usa Medicação</span><strong>{{ $psychology->usamedicacao ? 'Sim' : 'Não' }}</strong></div>
            @if($psychology->medicacaodosagem)
            <div class="show-field col-span-2"><span>Medicação e Dosagem</span><p>{{ $psychology->medicacaodosagem }}</p></div>
            @endif
            @if($psychology->tratamentoespecifico)
            <div class="show-field col-span-2"><span>Tratamento Específico</span><p>{{ $psychology->tratamentoespecifico }}</p></div>
            @endif
        </div>
    </div>

    {{-- Sono e Cognição --}}
    <div class="card">
        <div class="card-header"><h2>Sono e Cognição</h2></div>
        <div class="card-body show-fields">
            @foreach(['sonorecem'=>'Sono Recém-Nascido','sonoatual'=>'Sono Atual','ondedorme'=>'Onde Dorme','percepcao'=>'Percepção','atencaoconcentracao'=>'Atenção/Concentração','memoria'=>'Memória','conceitos'=>'Conceitos'] as $f=>$l)
            @if($psychology->{$f})
            <div class="show-field"><span>{{ $l }}</span><p>{{ $psychology->{$f} }}</p></div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- Linguagem --}}
    <div class="card">
        <div class="card-header"><h2>Linguagem</h2></div>
        <div class="card-body show-fields">
            @foreach(['linguagemverbalfuncional'=>'Verbal Funcional','linguagemdialogo'=>'Diálogo','linguagemimitasons'=>'Imita Sons','linguagemletrassilabas'=>'Letras/Sílabas','linguagemleituraescrita'=>'Leitura/Escrita','linguagemnumeros'=>'Números','linguagemoperacoes'=>'Operações'] as $f=>$l)
            @if($psychology->{$f})
            <div class="show-field"><span>{{ $l }}</span><p>{{ $psychology->{$f} }}</p></div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- Aspectos Sociais --}}
    <div class="card">
        <div class="card-header"><h2>Aspectos Sociais</h2></div>
        <div class="card-body show-fields">
            @foreach(['contatovisual'=>'Contato Visual','interacao'=>'Interação','brincar'=>'Brincar','humor'=>'Humor','frustracao'=>'Frustração','comportamentoagressivo'=>'Comp. Agressivo','aceitaregras'=>'Aceita Regras','reacaoresponsaveis'=>'Reação Responsáveis','compreensaocertoerrado'=>'Certo/Errado','atividadesvidadiaria'=>'AVDs'] as $f=>$l)
            @if($psychology->{$f})
            <div class="show-field"><span>{{ $l }}</span><p>{{ $psychology->{$f} }}</p></div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- Comportamentos e Queixas --}}
    <div class="card">
        <div class="card-header"><h2>Comportamentos e Queixas</h2></div>
        <div class="card-body show-fields">
            @foreach(['comportamentoestereotipado'=>'Comp. Estereotipado','mania'=>'Mania','objetofixacao'=>'Objeto Fixação','medos'=>'Medos'] as $f=>$l)
            @if($psychology->{$f})
            <div class="show-field"><span>{{ $l }}</span><p>{{ $psychology->{$f} }}</p></div>
            @endif
            @endforeach
            @if($psychology->principaisqueixas)
            <div class="show-field col-span-2"><span>Principais Queixas</span><p>{{ $psychology->principaisqueixas }}</p></div>
            @endif
        </div>
    </div>

    {{-- Observações finais --}}
    @if($psychology->evolutionnotes || $psychology->sessionnotes)
    <div class="card">
        <div class="card-header"><h2>Observações Finais</h2></div>
        <div class="card-body show-fields">
            @if($psychology->evolutionnotes)
            <div class="show-field col-span-2"><span>Evolução Clínica</span><p>{{ $psychology->evolutionnotes }}</p></div>
            @endif
            @if($psychology->sessionnotes)
            <div class="show-field col-span-2"><span>Observações da Sessão</span><p>{{ $psychology->sessionnotes }}</p></div>
            @endif
        </div>
    </div>
    @endif

</div>{{-- show-grid --}}

<style>
.show-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(480px,1fr)); gap:var(--space-4); margin-top:var(--space-4); }
.show-fields { display:grid; grid-template-columns:1fr 1fr; gap:var(--space-3) var(--space-6); }
.show-field { display:flex; flex-direction:column; gap:2px; }
.show-field span { font-size:var(--text-xs); color:var(--color-text-muted); text-transform:uppercase; letter-spacing:.04em; }
.show-field strong, .show-field p { font-size:var(--text-sm); color:var(--color-text); margin:0; }
.col-span-2 { grid-column:span 2; }
.score-bar { background:var(--color-surface-offset); border-radius:var(--radius-full); height:7px; width:120px; overflow:hidden; }
.score-fill { height:100%; border-radius:var(--radius-full); }
.header-actions { display:flex; gap:var(--space-2); align-items:center; flex-wrap:wrap; }
.btn-secondary { background:var(--color-surface-offset); color:var(--color-text); border:1px solid var(--color-border); }
.btn-secondary:hover { background:var(--color-surface-dynamic); }
@media(max-width:768px){ .show-grid{grid-template-columns:1fr;} .show-fields{grid-template-columns:1fr;} .col-span-2{grid-column:span 1;} }
</style>
@endsection
