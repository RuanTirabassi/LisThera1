<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\DiagnosisReference;
use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    public function index()
    {
        $practitioners = Practitioner::with(['diagnoses.diagnosisReference', 'guardians'])
            ->orderBy('fullname')
            ->paginate(20);

        return view('practitioners.index', compact('practitioners'));
    }

    public function show($id)
    {
        $practitioner = Practitioner::with([
            'diagnoses.diagnosisReference',
            'guardians',
            'sessionCheckins',
            'arenaSessions.arena',
            'arenaSessions.therapist',
        ])->findOrFail($id);

        return view('practitioners.show', compact('practitioner'));
    }

    public function create()
    {
        $diagnoses = DiagnosisReference::orderBy('name')->get();
        return view('practitioners.create', compact('diagnoses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname'    => 'required|string|max:255',
            'birthdate'   => 'nullable|date',
            'rfidtoken'   => 'nullable|string|max:100',
            'phonenumber' => 'nullable|string|max:30',
            'address'     => 'nullable|string|max:255',
            'notes'       => 'nullable|string',
        ]);

        $p = Practitioner::create($data);
        return redirect()->route('practitioners.show', $p->id)->with('success', 'Praticante criado com sucesso.');
    }

    public function edit($id)
    {
        $practitioner = Practitioner::findOrFail($id);
        $diagnoses = DiagnosisReference::orderBy('name')->get();
        return view('practitioners.edit', compact('practitioner', 'diagnoses'));
    }

    public function update(Request $request, $id)
    {
        $practitioner = Practitioner::findOrFail($id);
        $data = $request->validate([
            'fullname'    => 'required|string|max:255',
            'birthdate'   => 'nullable|date',
            'rfidtoken'   => 'nullable|string|max:100',
            'phonenumber' => 'nullable|string|max:30',
            'address'     => 'nullable|string|max:255',
            'notes'       => 'nullable|string',
        ]);

        $practitioner->update($data);
        return redirect()->route('practitioners.show', $practitioner->id)->with('success', 'Dados atualizados.');
    }
}
