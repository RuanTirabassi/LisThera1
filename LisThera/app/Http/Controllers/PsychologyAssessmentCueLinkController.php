<?php

namespace App\Http\Controllers;

use App\Models\PsychologyAssessment;
use App\Models\PsychologyAssessmentCueLink;
use App\Models\MemoryCueTemplate;
use Illuminate\Http\Request;

class PsychologyAssessmentCueLinkController extends Controller
{
    // Lista os cues de uma avaliação
    public function index(PsychologyAssessment $psychology)
    {
        $cues      = $psychology->cueLinks()->with('memoryCueTemplate')->latest()->get();
        $templates = MemoryCueTemplate::orderBy('label')->get();

        return view('psychology.cues.index', compact('psychology', 'cues', 'templates'));
    }

    // Formulário de criação
    public function create(PsychologyAssessment $psychology)
    {
        $templates = MemoryCueTemplate::orderBy('label')->get();
        return view('psychology.cues.create', compact('psychology', 'templates'));
    }

    // Salva novo cue
    public function store(Request $request, PsychologyAssessment $psychology)
    {
        $data = $request->validate([
            'memory_cue_template_id' => 'nullable|exists:memory_cue_templates,id',
            'cue_label'              => 'nullable|string|max:120',
            'cue_description'        => 'nullable|string',
            'cue_type'               => 'required|in:visual,auditivo,tátil,verbal,outro',
            'intensity'              => 'nullable|integer|min:1|max:5',
            'therapist_notes'        => 'nullable|string',
        ]);

        $data['psychology_assessment_id'] = $psychology->id;
        PsychologyAssessmentCueLink::create($data);

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue adicionado com sucesso.');
    }

    // Formulário de edição
    public function edit(PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $templates = MemoryCueTemplate::orderBy('label')->get();
        return view('psychology.cues.edit', compact('psychology', 'cue', 'templates'));
    }

    // Atualiza cue
    public function update(Request $request, PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $data = $request->validate([
            'memory_cue_template_id' => 'nullable|exists:memory_cue_templates,id',
            'cue_label'              => 'nullable|string|max:120',
            'cue_description'        => 'nullable|string',
            'cue_type'               => 'required|in:visual,auditivo,tátil,verbal,outro',
            'intensity'              => 'nullable|integer|min:1|max:5',
            'therapist_notes'        => 'nullable|string',
        ]);

        $cue->update($data);

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue atualizado com sucesso.');
    }

    // Remove cue
    public function destroy(PsychologyAssessment $psychology, PsychologyAssessmentCueLink $cue)
    {
        $cue->delete();

        return redirect()
            ->route('psychology.cues.index', $psychology)
            ->with('success', 'Memory Cue removido.');
    }
}
