<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologyAssessment extends Model
{
    protected $table = 'psychology_assessments';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'practitioner_id',
        'arena_session_id',
        'therapist_id',
        'assessment_date',
        // Domínios clínicos
        'emotionalregulation',
        'socialinteraction',
        'communication',
        'attentionfocus',
        'behavioralresponse',
        'anxietylevel',
        'motivation',
        'selfesteem',
        // Diagnóstico
        'cid',
        'profissionaldiagnostico',
        'datadiagnostico',
        'usamedicacao',
        'medicacaodosagem',
        'tratamentoespecifico',
        // Sono e cognição
        'sonorecem',
        'sonoatual',
        'ondedorme',
        'percepcao',
        'atencaoconcentracao',
        'memoria',
        'conceitos',
        // Linguagem
        'linguagemverbalfuncional',
        'linguagemdialogo',
        'linguagemimitasons',
        'linguagemletrassilabas',
        'linguagemleituraescrita',
        'linguagemnumeros',
        'linguagemoperacoes',
        // Aspectos sociais
        'contatovisual',
        'interacao',
        'brincar',
        'humor',
        'frustracao',
        'comportamentoagressivo',
        'aceitaregras',
        'reacaoresponsaveis',
        'compreensaocertoerrado',
        'atividadesvidadiaria',
        // Comportamentos
        'comportamentoestereotipado',
        'mania',
        'objetofixacao',
        'medos',
        'principaisqueixas',
        // Scores e notas finais
        'overallscore',
        'evolutionnotes',
        'sessionnotes',
    ];

    protected $casts = [
        'assessedat'    => 'datetime',
        'usamedicacao'  => 'boolean',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function arenaSession()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function cueLinks()
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'psychologyassessmentid');
    }
}
