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
        'emotionalregulation',
        'socialinteraction',
        'communication',
        'attentionfocus',
        'behavioralresponse',
        'anxietylevel',
        'motivation',
        'selfesteem',
        'cid',
        'profissionaldiagnostico',
        'datadiagnostico',
        'usamedicacao',
        'medicacaodosagem',
        'tratamentoespecifico',
        'sonorecem',
        'sonoatual',
        'ondedorme',
        'percepcao',
        'atencaoconcentracao',
        'memoria',
        'conceitos',
        'linguagemverbalfuncional',
        'linguagemdialogo',
        'linguagemimitasons',
        'linguagemletrassilabas',
        'linguagemleituraescrita',
        'linguagemnumeros',
        'linguagemoperacoes',
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
        'comportamentoestereotipado',
        'mania',
        'objetofixacao',
        'medos',
        'principaisqueixas',
        'overallscore',
        'evolutionnotes',
        'sessionnotes',
    ];

    protected $casts = [
        'assessment_date' => 'datetime',
        'usamedicacao'    => 'boolean',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function arenaSession()
    {
        return $this->belongsTo(ArenaSession::class, 'arena_session_id');
    }

    public function cueLinks()
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'psychology_assessment_id');
    }
}
