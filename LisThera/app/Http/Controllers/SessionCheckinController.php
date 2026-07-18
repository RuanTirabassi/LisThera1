<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionCheckinController extends Controller
{
    public function index()  { return view('checkins.index'); }
    public function create() { return view('checkins.create'); }
    public function store(Request $request) { return redirect()->route('checkins.index'); }
    public function show($id) { return view('checkins.show', compact('id')); }
}
