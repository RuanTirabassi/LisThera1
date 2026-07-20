<?php

namespace App\Http\Controllers;

use App\Models\PsychologyAssessment;
use App\Models\Practitioner;
use App\Models\ArenaSession;
use App\Models\Therapist;

class PsychologyAssessmentController extends Controller
{
    /**
     * Relatório individual evolutivo do praticante — lista todas as avaliações.
     */
    public function report(Practitioner $practitioner)
    {
        $assessments = PsychologyAssessment::with([
                'therapist',
                'arenaSession',
                'cueLinks.cueEvent.template',
            ])
            ->where('practitioner_id', $practitioner->id)
            ->orderBy('assessed_at')
            ->get();

        // Séries para o gráfico evolutivo
        $chartLabels = $assessments->map(fn ($a) =>
            $a->assessed_at?->format('d/m/Y') ?? 'S/D'
        );

        $chartDomains = [
            'Regulação Emocional' => $assessments->pluck('emotional_regulation'),
            'Interação Social'    => $assessments->pluck('social_interaction'),
            'Comunicação'         => $assessments->pluck('communication'),
            'Atenção/Foco'        => $assessments->pluck('attention_focus'),
            'Resposta Comportamental' => $assessments->pluck('behavioral_response'),
            'Nível de Ansiedade'   => $assessments->pluck('anxiety_level'),
            'Motivação'            => $assessments->pluck('motivation'),
            'Autoestima'           => $assessments->pluck('self_esteem'),
        ];

        $overallSeries = $assessments->pluck('overall_score');

        return view('assessments.psychology.report', compact(
            'practitioner',
            'assessments',
            'chartLabels',
            'chartDomains',
            'overallSeries'
        ));
    }

    /**
     * Formulário de nova avaliação pós-sessão.
     */
    public function create(ArenaSession $session)
    {
        $session->load([
            'sessionCheckin.practitioner',
            'memoryCueEvents.template',
        ]);

        $practitioner = $session->sessionCheckin?->practitioner;

        // Busca avaliação existente para esta sessão
        $existing = PsychologyAssessment::where('arena_session_id', $session->id)->first();

        return view('assessments.psychology.form', compact(
            'session',
            'practitioner',
            'existing'
        ));
    }

    /**
     * Salva ou atualiza a avaliação.
     */
    public function store(ArenaSession $session)
    {
        $session->load('sessionCheckin.practitioner');
        $practitioner = $session->sessionCheckin?->practitioner;

        $data = request()->validate([
            'therapist_id'           => 'required|exists:therapists,id',
            'assessed_at'            => 'required|date',
            'emotional_regulation'   => 'nullable|integer|min:0|max:10',
            'social_interaction'     => 'nullable|integer|min:0|max:10',
            'communication'          => 'nullable|integer|min:0|max:10',
            'attention_focus'        => 'nullable|integer|min:0|max:10',
            'behavioral_response'    => 'nullable|integer|min:0|max:10',
            'anxiety_level'          => 'nullable|integer|min:0|max:10',
            'motivation'             => 'nullable|integer|min:0|max:10',
            'self_esteem'            => 'nullable|integer|min:0|max:10',
            'overall_score'          => 'nullable|integer|min:0|max:100',
            'evolution_notes'        => 'nullable|string',
            'session_notes'          => 'nullable|string',
            'cue_event_ids'          => 'nullable|array',
            'cue_event_ids.*'        => 'exists:session_memory_cue_events,id',
        ]);

        $cueIds = $data['cue_event_ids'] ?? [];
        unset($data['cue_event_ids']);

        $data['arena_session_id'] = $session->id;
        $data['practitioner_id']  = $practitioner?->id;

        $assessment = PsychologyAssessment::updateOrCreate(
            ['arena_session_id' => $session->id],
            $data
        );

        // Sincroniza cue links
        $assessment->cueLinks()->delete();
        foreach ($cueIds as $cueId) {
            $assessment->cueLinks()->create(['session_memory_cue_event_id' => $cueId]);
        }

        return redirect()
            ->route('psychology.report', $practitioner)
            ->with('success', 'Avaliação salva com sucesso.');
    }
}
