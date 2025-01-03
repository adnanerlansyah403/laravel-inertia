<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Project::query();

        if($request->has('search')) $query->where('name', 'like', '%' . $request->search . '%');

        $projects = $query->paginate(10);

        return Inertia::render("Projects/Index", [
            'projects' => $projects,
            'filters' => $request->only('search'),
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
