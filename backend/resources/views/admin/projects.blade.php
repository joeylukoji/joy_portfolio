<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Projets</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/joy.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">
    <main class="max-w-5xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Administration des projets</h1>
                <p class="text-zinc-400">Ajoute un projet avec image, description et m&eacute;tadonn&eacute;es.</p>
            </div>
            <a href="{{ route('admin.messages') }}" class="rounded-md bg-blue-500 text-white font-semibold px-4 py-2 hover:bg-blue-400 transition text-sm whitespace-nowrap">
                Voir messages contact
            </a>
        </div>
        <div class="mb-8"></div>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-400/30 bg-red-500/10 px-4 py-3 text-red-200">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="rounded-xl border border-zinc-800 bg-zinc-900 p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4">Nouveau projet</h2>
            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data" class="grid gap-4">
                @csrf
                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2" type="text" name="title" placeholder="Titre du projet" value="{{ old('title') }}" required>
                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2" type="text" name="category" placeholder="Cat&eacute;gorie (web, IA, desktop...)" value="{{ old('category') }}" required>
                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-32" name="description" placeholder="Description" required>{{ old('description') }}</textarea>

                <div class="grid md:grid-cols-2 gap-4">
                    <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2" type="text" name="color" placeholder="#ffffff" value="{{ old('color', '#ffffff') }}">
                    <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2" type="url" name="link" placeholder="https://..." value="{{ old('link') }}">
                </div>

                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-24" name="skills" placeholder="Skills (une ligne = une skill)">{{ old('skills') }}</textarea>
                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-24" name="details" placeholder="D&eacute;tails (une ligne = un d&eacute;tail)">{{ old('details') }}</textarea>

                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 file:mr-4 file:rounded file:border-0 file:bg-zinc-700 file:px-3 file:py-1.5 file:text-zinc-100" type="file" name="image" accept="image/*">
                <p class="text-xs text-zinc-400">Si aucune image n'est choisie, ta photo sera utilis&eacute;e comme logo par d&eacute;faut.</p>

                <button class="rounded-md bg-white text-black font-semibold px-4 py-2 hover:bg-zinc-200 transition" type="submit">
                    Ajouter le projet
                </button>
            </form>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-4">Projets existants</h2>
            <div class="grid md:grid-cols-2 gap-4">
                @forelse ($projects as $project)
                    <article class="rounded-xl border border-zinc-800 bg-zinc-900 p-4">
                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" loading="lazy" decoding="async" class="h-40 w-full object-cover rounded-md mb-3">
                        <h3 class="font-semibold mb-4">{{ $project->title }}</h3>

                        <button
                            type="button"
                            class="rounded-md bg-zinc-700 text-white font-semibold px-3 py-2 hover:bg-zinc-600 transition text-sm mb-4"
                            onclick="toggleInfo('project-info-{{ $project->id }}', this)"
                        >
                            Afficher information
                        </button>

                        <div id="project-info-{{ $project->id }}" class="hidden">
                            <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data" class="grid gap-3 mb-4">
                                @csrf
                                @method('PUT')
                                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 text-sm" type="text" name="title" value="{{ $project->title }}" required>
                                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 text-sm" type="text" name="category" value="{{ $project->category }}" required>
                                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-24 text-sm" name="description" required>{{ $project->description }}</textarea>
                                <div class="grid grid-cols-2 gap-3">
                                    <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 text-sm" type="text" name="color" value="{{ $project->color }}">
                                    <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 text-sm" type="url" name="link" value="{{ $project->link }}">
                                </div>
                                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-20 text-sm" name="skills" placeholder="Skills">{{ implode("\n", $project->skills ?? []) }}</textarea>
                                <textarea class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 min-h-20 text-sm" name="details" placeholder="D&eacute;tails">{{ implode("\n", $project->details ?? []) }}</textarea>
                                <input class="rounded-md bg-zinc-800 border border-zinc-700 px-3 py-2 text-sm file:mr-2 file:rounded file:border-0 file:bg-zinc-700 file:px-2 file:py-1" type="file" name="image" accept="image/*">
                                <button class="rounded-md bg-emerald-400 text-black font-semibold px-3 py-2 hover:bg-emerald-300 transition text-sm" type="submit">
                                    Modifier
                                </button>
                            </form>

                            <form action="{{ route('admin.projects.destroy', $project) }}" method="post" onsubmit="return confirm('Supprimer ce projet ?');">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md bg-red-500/90 text-white font-semibold px-3 py-2 hover:bg-red-500 transition text-sm" type="submit">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="text-zinc-400">Aucun projet pour le moment.</p>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        </section>
    </main>
    <script>
        function toggleInfo(targetId, button) {
            const block = document.getElementById(targetId);
            if (!block) return;
            block.classList.toggle('hidden');
            button.textContent = block.classList.contains('hidden') ? 'Afficher information' : 'Masquer information';
        }
    </script>
</body>
</html>
