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
            'practitioners'   => Practitioner::count(),
            'sessions_today'  => ArenaSession::whereDate('started_at', today())->count(),
            'checkins_today'  => SessionCheckin::whereDate('scheduled_at', today())->count(),
            'horses'          => Horse::count(),
            'therapists'      => Therapist::count(),
            'sessions_active' => ArenaSession::where('status', 'in_progress')->count(),
        ];

        $recent_sessions = ArenaSession::with([
                'sessionCheckin.practitioner',
                'startedByTherapist',
                'arena',
            ])
            ->orderByDesc('started_at')
            ->limit(8)
            ->get();

        $recent_checkins = SessionCheckin::with('practitioner')
            ->orderByDesc('scheduled_at')
            ->limit(6)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_sessions', 'recent_checkins'));
    }
}
