<?php

namespace App\Http\Controllers;

use App\Models\PsychologyAssessment;
use App\Models\Practitioner;
use App\Models\ArenaSession;
use App\Models\Therapist;
use Illuminate\Http\Request;

class PsychologyAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PsychologyAssessment::with(['practitioner', 'therapist']);

        if ($request->filled('nome')) {
            $query->whereHas('practitioner', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nome . '%');
            });
        }

        if ($request->filled('data')) {
            $query->whereDate('assessment_date', $request->data);
        }

        $avaliacoes = $query->orderByDesc('assessment_date')->paginate(15)->appends($request->only(['nome', 'data']));

        return view('psychology.index', compact('avaliacoes'));
    }

    public function create()
    {
        $praticantes = Practitioner::orderBy('name')->get();
        $terapeutas  = Therapist::orderBy('name')->get();
        $sessoes     = ArenaSession::orderByDesc('id')->limit(50)->get();

        return view('psychology.create', compact('praticantes', 'terapeutas', 'sessoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'assessment_date' => 'required|date',
        ]);

        PsychologyAssessment::create($request->except('_token'));

        return redirect()->route('psychology.index')->with('success', 'Avaliação psicológica salva com sucesso.');
    }

    public function show(PsychologyAssessment $psychology)
    {
        $psychology->load(['practitioner', 'therapist', 'arenaSession']);
        return view('psychology.show', compact('psychology'));
    }

    public function edit(PsychologyAssessment $psychology)
    {
        $psychology->load(['practitioner', 'therapist']);
        $praticantes = Practitioner::orderBy('name')->get();
        $terapeutas  = Therapist::orderBy('name')->get();
        $sessoes     = ArenaSession::orderByDesc('id')->limit(50)->get();

        return view('psychology.edit', compact('psychology', 'praticantes', 'terapeutas', 'sessoes'));
    }

    public function update(Request $request, PsychologyAssessment $psychology)
    {
        $request->validate([
            'practitioner_id' => 'required|exists:practitioners,id',
            'assessment_date' => 'required|date',
        ]);

        $psychology->update($request->except(['_token', '_method']));

        return redirect()->route('psychology.index')->with('success', 'Avaliação atualizada com sucesso.');
    }

    public function destroy(PsychologyAssessment $psychology)
    {
        $psychology->cueLinks()->delete();
        $psychology->delete();

        return redirect()->route('psychology.index')->with('success', 'Avaliação excluída com sucesso.');
    }
}
