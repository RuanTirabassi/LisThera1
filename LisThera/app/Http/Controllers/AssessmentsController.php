<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PsychologyAssessment;

class AssessmentsController extends Controller
{
    public function index()
    {
        // Contadores por especialidade
        $counts = [
            'psychology'     => PsychologyAssessment::count(),
            'pedagogy'       => 0, // substituir pelo Model quando criado
            'physiotherapy'  => 0, // substituir pelo Model quando criado
        ];

        // Últimas 10 avaliações de psicologia (expandir quando os outros models existirem)
        $recentPsych = PsychologyAssessment::with('practitioner', 'assessedByTherapist')
            ->latest('assessed_at')
            ->limit(10)
            ->get()
            ->map(fn($r) => [
                'type'         => 'psychology',
                'practitioner' => $r->practitioner?->name ?? '—',
                'therapist'    => $r->assessedByTherapist?->name ?? '—',
                'date'         => $r->assessed_at?->format('d/m/Y') ?? '—',
                'score'        => $r->overall_score,
                'show_url'     => route('psychology.show', $r->id),
                'edit_url'     => route('psychology.edit', $r->id),
            ]);

        // Mesclar e ordenar (preparado para receber pedagogy e physiotherapy)
        $recent = collect()
            ->merge($recentPsych)
            ->sortByDesc('date')
            ->values()
            ->take(15);

        return view('assessments.index', compact('counts', 'recent'));
    }
}
