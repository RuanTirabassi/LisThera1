<?php

namespace App\Http\Controllers;

use App\Models\ArenaSession;
use App\Models\Practitioner;
use App\Models\SessionCheckin;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPractitioners   = Practitioner::where('isactive', true)->count();
        $sessionsToday        = ArenaSession::whereDate('startedat', today())->count();
        $pendingAuthorization = SessionCheckin::whereDate('checkindate', today())
                                    ->where('authorized', false)
                                    ->count();

        return view('dashboard', compact(
            'totalPractitioners',
            'sessionsToday',
            'pendingAuthorization'
        ));
    }
}
