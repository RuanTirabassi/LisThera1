<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsychologyAssessment extends Model
{
    // Nome real da tabela no BD (sem underscores)
    protected $table = 'psychologyassessments';
    public $timestamps = false;

    // Chave primária padrão: id
    protected $primaryKey = 'id';

    protected $fillable = [
        'practitionerid',
        'arenasessionid',
        'therapistid',
        'assessmentdate',
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
        'assessmentdate' => 'datetime',
        'usamedicacao'   => 'boolean',
    ];

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function arenaSession(): BelongsTo
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function cueLinks(): HasMany
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'psychologyassessmentid');
    }
}
