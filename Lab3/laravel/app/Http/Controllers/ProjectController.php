<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
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
        $request->validate([
            'code' => 'required|string|unique:projects,code',
            'author' => 'required|string',
            'budget' => 'required|integer|min:0',
            'rating1' => 'required|integer|min:1|max:10',
            'rating2' => 'required|integer|min:1|max:10',
            'rating3' => 'required|integer|min:1|max:10',
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')->with('success', 'Проект успішно додано!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'code' => 'required|string|unique:projects,code,' . $project->id,
            'author' => 'required|string',
            'budget' => 'required|integer|min:0',
            'rating1' => 'required|integer|min:1|max:5',
            'rating2' => 'required|integer|min:1|max:5',
            'rating3' => 'required|integer|min:1|max:5',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Проект успішно оновлено!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Проект успішно видалено!');
    }

}
