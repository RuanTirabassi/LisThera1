<?php

namespace App\Http\Controllers;

use App\Models\Practitioner;
use App\Models\ArenaSession;
use App\Models\SessionCheckin;
use App\Models\Horse;
use App\Models\Therapist;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'practitioners' => Practitioner::count(),
            'sessions_today' => ArenaSession::whereDate('startedat', today())->count(),
            'checkins_today' => SessionCheckin::whereDate('checkedat', today())->count(),
            'horses' => Horse::count(),
            'therapists' => Therapist::count(),
            'sessions_active' => ArenaSession::whereNull('endedat')->count(),
        ];

        $recent_sessions = ArenaSession::with(['practitioner', 'therapist', 'arena'])
            ->orderByDesc('startedat')
            ->limit(8)
            ->get();

        $recent_checkins = SessionCheckin::with('practitioner')
            ->orderByDesc('checkedat')
            ->limit(6)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_sessions', 'recent_checkins'));
    }
}
