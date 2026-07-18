<?php

namespace App\Http\Controllers;

use App\Models\ArenaSession;
use App\Models\Arena;
use App\Models\SessionCheckin;
use Illuminate\Http\Request;

class ArenaSessionController extends Controller
{
    public function index()
    {
        $sessions = ArenaSession::with(['practitioner', 'arena'])
                        ->orderByDesc('startedat')
                        ->paginate(20);
        return view('sessions.index', compact('sessions'));
    }

    public function show($id)
    {
        $session = ArenaSession::with([
            'practitioner',
            'arena',
            'sessionCheckin',
            'entities.therapist',
            'mounts.horse',
            'mounts.mountType',
            'memoryCueEvents.template',
        ])->findOrFail($id);

        return view('sessions.show', compact('session'));
    }

    public function create(Request $request)
    {
        $arenas    = Arena::where('isactive', true)->get();
        $checkinId = $request->get('checkin_id');
        $checkin   = $checkinId ? SessionCheckin::with('practitioner')->findOrFail($checkinId) : null;
        return view('sessions.create', compact('arenas', 'checkin'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'practitionerid'   => 'required|integer',
            'arenaid'          => 'required|integer',
            'sessioncheckinid' => 'required|integer',
        ]);

        $data['startedat'] = now();
        $data['status']    = 'active';

        $session = ArenaSession::create($data);

        return redirect()->route('sessions.show', $session->arenasessionid)
            ->with('success', 'Sessão iniciada.');
    }

    public function end($id)
    {
        $session = ArenaSession::findOrFail($id);
        $session->update([
            'endedat' => now(),
            'status'  => 'finished',
        ]);

        return redirect()->route('sessions.show', $id)
            ->with('success', 'Sessão encerrada.');
    }
}
