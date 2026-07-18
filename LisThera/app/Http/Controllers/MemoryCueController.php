<?php

namespace App\Http\Controllers;

use App\Models\SessionMemoryCueEvent;
use App\Models\MemoryCueTemplate;
use Illuminate\Http\Request;

class MemoryCueController extends Controller
{
    /**
     * Lista os templates disponíveis para uma especialidade.
     */
    public function templates(Request $request)
    {
        $specialty = $request->get('specialty');
        $templates = MemoryCueTemplate::where('isactive', true)
                        ->when($specialty, fn($q) => $q->where('specialty', $specialty))
                        ->orderBy('hotkey')
                        ->get();
        return response()->json($templates);
    }

    /**
     * Registra um evento de cue durante a sessão.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'arenasessionid' => 'required|integer',
            'templateid'     => 'required|integer',
            'notes'          => 'nullable|string',
        ]);

        $data['recordedat'] = now();

        $event = SessionMemoryCueEvent::create($data);

        return response()->json([
            'success' => true,
            'event'   => $event->load('template'),
        ]);
    }

    /**
     * Lista os eventos de cue de uma sessão.
     */
    public function bySession($sessionId)
    {
        $events = SessionMemoryCueEvent::with('template')
                    ->where('arenasessionid', $sessionId)
                    ->orderBy('recordedat')
                    ->get();
        return response()->json($events);
    }
}
