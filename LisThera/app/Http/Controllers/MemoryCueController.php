<?php

namespace App\Http\Controllers;

use App\Models\MemoryCueTemplate;
use App\Models\SessionMemoryCueEvent;
use App\Models\ArenaSession;
use Illuminate\Http\Request;

class MemoryCueController extends Controller
{
    public function index()
    {
        $templates = MemoryCueTemplate::orderBy('category')->orderBy('label')->get();
        return view('cues.index', compact('templates'));
    }

    public function templates()
    {
        return response()->json(
            MemoryCueTemplate::orderBy('category')->orderBy('label')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'arenasessionid'       => 'required|exists:arenasessions,id',
            'memorycuetemplateid'  => 'required|exists:memorycuetemplates,id',
            'notes'                => 'nullable|string',
        ]);

        $data['recordedat'] = now();
        $event = SessionMemoryCueEvent::create($data);

        return response()->json($event->load('template'), 201);
    }

    public function bySession($id)
    {
        $events = SessionMemoryCueEvent::with('template')
            ->where('arenasessionid', $id)
            ->orderBy('recordedat')
            ->get();

        return response()->json($events);
    }
}
