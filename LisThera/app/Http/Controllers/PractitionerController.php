<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PractitionerController extends Controller
{
    public function index()  { return view('practitioners.index'); }
    public function create() { return view('practitioners.create'); }
    public function store(Request $request) { return redirect()->route('practitioners.index'); }
    public function show($id) { return view('practitioners.show', compact('id')); }
    public function edit($id) { return view('practitioners.edit', compact('id')); }
    public function update(Request $request, $id) { return redirect()->route('practitioners.index'); }
}
