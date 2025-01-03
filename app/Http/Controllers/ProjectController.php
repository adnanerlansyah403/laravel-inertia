<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        return Inertia::render("Projects/Index", [
            'projects' => Project::latest()->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('message', 'Proyek berhasil dibuat!');
    }

}
