<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function presentation(): View
    {
        return view('presentation');
    }

    public function sphere(): View
    {
        $projects = Project::query()
            ->orderBy('id')
            ->get()
            ->map(fn (Project $project) => [
                'id' => $project->id,
                'title' => $project->title,
                'category' => $project->category,
                'color' => $project->color,
                'image' => $project->image,
                'description' => $project->description,
                'skills' => $project->skills ?? [],
                'details' => $project->details ?? [],
                'link' => $project->link ?? '',
            ]);

        return view('sphere-portfolio', ['projects' => $projects]);
    }

    public function contact(): View
    {
        return view('contact');
    }
}
