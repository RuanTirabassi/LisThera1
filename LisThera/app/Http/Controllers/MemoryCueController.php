<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoryCueController extends Controller
{
    public function index()    { return view('cues.index'); }
    public function templates() { return response()->json([]); }
    public function store(Request $request) { return response()->json(['ok' => true]); }
    public function bySession($id) { return response()->json([]); }
}
