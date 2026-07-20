<?php

namespace App\Http\Controllers;

use App\Models\ArenaSession;
use App\Models\Practitioner;
use App\Models\Therapist;
use App\Models\Arena;
use App\Models\Horse;
use App\Models\SessionMemoryCueEvent;
use Illuminate\Http\Request;

class ArenaSessionController extends Controller
{
    public function index()
    {
        $sessions = ArenaSession::with(['practitioner', 'therapist', 'arena'])
            ->orderByDesc('startedat')
            ->paginate(20);

        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        $practitioners = Practitioner::orderBy('fullname')->get();
        $therapists    = Therapist::orderBy('fullname')->get();
        $arenas        = Arena::orderBy('name')->get();
        $horses        = Horse::orderBy('name')->get();

        return view('sessions.create', compact('practitioners', 'therapists', 'arenas', 'horses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'practitionerid' => 'required|exists:practitioners,id',
            'therapistid'    => 'required|exists:therapists,id',
            'arenaid'        => 'required|exists:arenas,id',
            'notes'          => 'nullable|string',
        ]);

        $data['startedat'] = now();
        $session = ArenaSession::create($data);

        return redirect()->route('sessions.show', $session->id);
    }

    public function show($id)
    {
        $session = ArenaSession::with([
            'practitioner',
            'therapist',
            'arena',
            'mounts.horse',
            'mounts.mountType',
            'memoryCueEvents.template',
        ])->findOrFail($id);

        return view('sessions.show', compact('session'));
    }

    public function end(Request $request, $id)
    {
        $session = ArenaSession::findOrFail($id);
        $session->update(['endedat' => now()]);
        return redirect()->route('sessions.show', $id)->with('success', 'Sessão encerrada.');
    }
}
