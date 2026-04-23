<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;

class AdminProjectController extends Controller
{
    private function parseLines(?string $raw): array
    {
        return collect(explode("\n", (string) $raw))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    public function index(): View
    {
        $projects = Project::query()
            ->select(['id', 'title', 'category', 'description', 'image', 'color', 'skills', 'details', 'link', 'created_at'])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.projects', ['projects' => $projects]);
    }

    public function contacts(): View
    {
        $contacts = Contact::query()
            ->select(['id', 'full_name', 'email', 'subject', 'message', 'created_at'])
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('admin.contacts', ['contacts' => $contacts]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'color' => ['nullable', 'string', 'max:20'],
            'skills' => ['nullable', 'string', 'max:3000'],
            'details' => ['nullable', 'string', 'max:3000'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        $image = 'assets/img/joy.webp';
        if ($request->hasFile('image')) {
            $image = 'storage/' . $request->file('image')->store('projects', 'public');
        }

        Project::query()->create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $image,
            'color' => $validated['color'] ?? '#ffffff',
            'skills' => $this->parseLines($validated['skills'] ?? null),
            'details' => $this->parseLines($validated['details'] ?? null),
            'link' => $validated['link'] ?? null,
        ]);

        return redirect()
            ->route('admin.projects')
            ->with('success', 'Projet ajoute avec succes.');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'color' => ['nullable', 'string', 'max:20'],
            'skills' => ['nullable', 'string', 'max:3000'],
            'details' => ['nullable', 'string', 'max:3000'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        $image = $project->image;

        if ($request->hasFile('image')) {
            if (str_starts_with((string) $project->image, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', (string) $project->image));
            }

            $image = 'storage/' . $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $image,
            'color' => $validated['color'] ?? '#ffffff',
            'skills' => $this->parseLines($validated['skills'] ?? null),
            'details' => $this->parseLines($validated['details'] ?? null),
            'link' => $validated['link'] ?? null,
        ]);

        return redirect()
            ->route('admin.projects')
            ->with('success', 'Projet modifie avec succes.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if (str_starts_with((string) $project->image, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', (string) $project->image));
        }

        $project->delete();

        return redirect()
            ->route('admin.projects')
            ->with('success', 'Projet supprime avec succes.');
    }
}
