<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'prenom_nom' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:180'],
            'sujet' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Contact::query()->create([
            'full_name' => $validated['prenom_nom'],
            'email' => $validated['email'],
            'subject' => $validated['sujet'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Merci pour votre message ! Je vous repondrai dans les plus brefs delais.');
    }
}
