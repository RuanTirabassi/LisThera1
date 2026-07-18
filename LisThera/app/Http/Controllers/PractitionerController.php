<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    public function index()
    {
        $practitioners = Practitioner::where('isactive', true)
                            ->orderBy('fullname')
                            ->paginate(20);
        return view('practitioners.index', compact('practitioners'));
    }

    public function show($id)
    {
        $practitioner = Practitioner::with([
            'guardians',
            'diagnoses.diagnosisReference',
            'clinicalHistory',
            'sessionCheckins',
            'arenaSessions',
        ])->findOrFail($id);

        return view('practitioners.show', compact('practitioner'));
    }

    public function create()
    {
        return view('practitioners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname'    => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'cpf'         => 'nullable|string|max:14',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
        ]);

        $data['isactive'] = true;
        Practitioner::create($data);

        return redirect()->route('practitioners.index')
            ->with('success', 'Praticante cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $practitioner = Practitioner::findOrFail($id);
        return view('practitioners.edit', compact('practitioner'));
    }

    public function update(Request $request, $id)
    {
        $practitioner = Practitioner::findOrFail($id);
        $data = $request->validate([
            'fullname'    => 'required|string|max:255',
            'dateofbirth' => 'required|date',
            'cpf'         => 'nullable|string|max:14',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
        ]);

        $practitioner->update($data);

        return redirect()->route('practitioners.show', $id)
            ->with('success', 'Praticante atualizado com sucesso.');
    }
}
