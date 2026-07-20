<?php

namespace App\Http\Controllers;

use App\Models\SessionCheckin;
use App\Models\Practitioner;
use Illuminate\Http\Request;

class SessionCheckinController extends Controller
{
    public function index()
    {
        $checkins = SessionCheckin::with('practitioner')
            ->orderByDesc('checkedat')
            ->paginate(20);

        return view('checkins.index', compact('checkins'));
    }

    public function create()
    {
        $practitioners = Practitioner::orderBy('fullname')->get();
        return view('checkins.create', compact('practitioners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'practitionerid'      => 'required|exists:practitioners,id',
            'bloodpressuresys'    => 'nullable|integer',
            'bloodpressuredia'    => 'nullable|integer',
            'heartrate'           => 'nullable|integer',
            'temperature'         => 'nullable|numeric',
            'oxygensaturation'    => 'nullable|numeric',
            'painlevel'           => 'nullable|integer|min:0|max:10',
            'mobilityrating'      => 'nullable|integer|min:1|max:5',
            'moodrating'          => 'nullable|integer|min:1|max:5',
            'sessionauthorized'   => 'required|boolean',
            'authorizationnotes'  => 'nullable|string',
        ]);

        $data['checkedat'] = now();
        $checkin = SessionCheckin::create($data);

        return redirect()->route('checkins.show', $checkin->id)->with('success', 'Check-in registrado.');
    }

    public function show($id)
    {
        $checkin = SessionCheckin::with('practitioner')->findOrFail($id);
        return view('checkins.show', compact('checkin'));
    }
}
