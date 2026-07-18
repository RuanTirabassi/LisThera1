<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArenaSessionController extends Controller
{
    public function index()  { return view('sessions.index'); }
    public function create() { return view('sessions.create'); }
    public function store(Request $request) { return redirect()->route('sessions.index'); }
    public function show($id) { return view('sessions.show', compact('id')); }
    public function end($id) { return redirect()->route('sessions.index'); }
}
