<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function index()
    {
        $projectStats = [
            'total_tasks' => 150,
            'completed_tasks' => 85,
            'pending_tasks' => 65,
            'completion_rate' => '56.67%'
        ];

        return Inertia::render('Dashboard', [
            'title' => 'Project Dashboard',
            'stats' => $projectStats,
            'last_updated' => now()->format('d m Y H:i:s')
        ]);
    }

    public function projects()
    {
        return Inertia::render('Projects');
    }

}
