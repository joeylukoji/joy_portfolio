<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages contact</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/joy.webp') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 min-h-screen">
    <main class="max-w-6xl mx-auto px-6 py-10">
        <div class="flex items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2">Messages re&ccedil;us depuis Contact</h1>
                <p class="text-zinc-400">Liste des demandes envoy&eacute;es depuis le formulaire public.</p>
            </div>
            <a href="{{ route('admin.projects') }}" class="rounded-md bg-zinc-700 text-white font-semibold px-4 py-2 hover:bg-zinc-600 transition text-sm whitespace-nowrap">
                Retour admin projets
            </a>
        </div>

        <section class="rounded-xl border border-zinc-800 bg-zinc-900 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-zinc-800/70 text-zinc-300">
                        <tr>
                            <th class="text-left px-4 py-3">Nom</th>
                            <th class="text-left px-4 py-3">Email</th>
                            <th class="text-left px-4 py-3">Sujet</th>
                            <th class="text-left px-4 py-3">Message</th>
                            <th class="text-left px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr class="border-t border-zinc-800 align-top">
                                <td class="px-4 py-3 font-medium">{{ $contact->full_name }}</td>
                                <td class="px-4 py-3 text-zinc-300">{{ $contact->email }}</td>
                                <td class="px-4 py-3 text-zinc-200">{{ $contact->subject }}</td>
                                <td class="px-4 py-3 text-zinc-300 max-w-xl whitespace-pre-wrap">{{ $contact->message }}</td>
                                <td class="px-4 py-3 text-zinc-400 whitespace-nowrap">{{ $contact->created_at?->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-zinc-400">Aucun message pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
        <div class="mt-6">
            {{ $contacts->links() }}
        </div>
    </main>
</body>
</html>
