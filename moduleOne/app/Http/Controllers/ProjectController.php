<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('max_budget')) {
            $query->where('budget', '<=', $request->input('max_budget'));
        }

        if ($request->has('min_rating_sum')) {
            $query->whereRaw('rating1 + rating2 + rating3 >= ?', [$request->input('min_rating_sum')]);
        }

        $projects = $query->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:projects,code',
            'author' => 'required|string',
            'budget' => 'required|integer|min:0',
            'rating1' => 'required|integer|min:1|max:10',
            'rating2' => 'required|integer|min:1|max:10',
            'rating3' => 'required|integer|min:1|max:10',
        ]);

        $validated['creator_user_id'] = Auth::id();

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Проект створено!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Проект видалено!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'code' => 'required|string|unique:projects,code,' . $project->id,
            'author' => 'required|string',
            'budget' => 'required|integer|min:0',
            'rating1' => 'required|integer|min:1|max:10',
            'rating2' => 'required|integer|min:1|max:10',
            'rating3' => 'required|integer|min:1|max:10',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Проект оновлено!');
    }
}
