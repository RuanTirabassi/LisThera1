<?php

namespace App\Http\Controllers;

use App\Models\PsychologyAssessment;
use App\Models\PsychologyAssessmentCueLink;
use App\Models\SessionMemoryCueEvent;
use Illuminate\Http\Request;

class PsychologyAssessmentCueLinkController extends Controller
{
    // Lista os cues vinculados à avaliação
    public function index(PsychologyAssessment $psychology)
    {
        $cues = PsychologyAssessmentCueLink::where('psychologyassessmentid', $psychology->id)
            ->with(['sessionMemoryCueEvent.memoryCueTemplate', 'sessionMemoryCueEvent.therapist'])
            ->orderByDesc('createdat')
            ->get();

        // Eventos de memória disponíveis da mesma sessão da avaliação (para sugestão)
        $availableEvents = SessionMemoryCueEvent::where('arenasessionid', $psychology->arenasessionid)
            ->with('memoryCueTemplate')
            ->orderByDesc('recordedat')
            ->get();

        return view('psychology.cues.index', compact('psychology', 'cues', 'availableEvents'));
    }

    // Formulário de criação
    public function create(PsychologyAssessment $psychology)
    {
        // Eventos da mesma sessão de arena que ainda não foram vinculados
        $linkedIds = PsychologyAssessmentCueLink::where('psychologyassessmentid', $psychology->id)
            ->pluck('sessionmemorycueeventid');

        $availableEvents = SessionMemoryCueEvent::where('arenasessionid', $psychology->arenasessionid)
            ->whereNotIn('id', $linkedIds)
            ->with('memoryCueTemplate')
            ->orderByDesc('recordedat')
            ->get();

        return view('psychology.cues.create', compact('psychology', 'availableEvents'));
    }

    // Salva novo vínculo
    public function store(Request $request, PsychologyAssessment $psychology)
    {
        $data = $request->validate([
            'sessionmemorycueeventid'  => 'required|exists:sessionmemorycueevents,id',
            'professionaljustification' => 'nullable|string',
            'intensityscore'            => 'nullable|integer|min:1|max:10',
        ]);

        $data['psychologyassessmentid'] = $psychology->id;
        $data['createdat'] = now();

        PsychologyAssessmentCueLink::create($data);

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue vinculado com sucesso.');
    }

    // Formulário de edição
    public function edit(PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $availableEvents = SessionMemoryCueEvent::where('arenasessionid', $psychology->arenasessionid)
            ->with('memoryCueTemplate')
            ->orderByDesc('recordedat')
            ->get();

        return view('psychology.cues.edit', compact('psychology', 'cue', 'availableEvents'));
    }

    // Atualiza vínculo
    public function update(Request $request, PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $data = $request->validate([
            'sessionmemorycueeventid'   => 'required|exists:sessionmemorycueevents,id',
            'professionaljustification'  => 'nullable|string',
            'intensityscore'             => 'nullable|integer|min:1|max:10',
        ]);

        $cue->update($data);

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue atualizado com sucesso.');
    }

    // Remove vínculo
    public function destroy(PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $cue->delete();

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue removido.');
    }
}
