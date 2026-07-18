<?php

namespace App\Http\Controllers;

use App\Models\SessionCheckin;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionCheckinController extends Controller
{
    public function index()
    {
        $checkins = SessionCheckin::with('practitioner')
                        ->whereDate('checkindate', today())
                        ->orderByDesc('checkindate')
                        ->paginate(20);
        return view('checkins.index', compact('checkins'));
    }

    public function create()
    {
        $practitioners = Practitioner::where('isactive', true)->orderBy('fullname')->get();
        return view('checkins.create', compact('practitioners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'practitionerid'   => 'required|integer',
            'bloodpressure'    => 'nullable|string|max:20',
            'heartrate'        => 'nullable|integer',
            'temperature'      => 'nullable|numeric',
            'oxygensaturation' => 'nullable|integer',
            'pain'             => 'nullable|integer|min:0|max:10',
            'mood'             => 'nullable|string|max:50',
            'authorized'       => 'required|boolean',
            'authorizednotes'  => 'nullable|string',
        ]);

        $data['checkindate'] = now();
        $data['recordedby']  = Auth::id();

        SessionCheckin::create($data);

        return redirect()->route('checkins.index')
            ->with('success', 'Triagem registrada com sucesso.');
    }

    public function show($id)
    {
        $checkin = SessionCheckin::with('practitioner')->findOrFail($id);
        return view('checkins.show', compact('checkin'));
    }
}
