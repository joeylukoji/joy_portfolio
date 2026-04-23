<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-commerce React',
                'category' => 'web',
                'color' => '#ffffff',
                'image' => 'assets/img/marketplace.webp',
                'description' => 'Plateforme e-commerce complete avec panier, paiement Stripe et dashboard admin.',
                'skills' => ['Vite JS', 'FastAPI', 'PostgreSQL', 'Stripe'],
                'details' => ['Authentification JWT', 'Paiement securise', 'Dashboard analytics', 'Responsive design'],
                'link' => null,
            ],
            [
                'title' => "Plateforme de reservation d'appartements",
                'category' => 'web',
                'color' => '#cfe0ff',
                'image' => 'assets/img/Jachyvhamappartements.webp',
                'description' => "Creation complete d'une plateforme de reservation d'appartements.",
                'skills' => ['Figma', 'React JS', 'ShadCN UI', 'Supabase'],
                'details' => ['Authentification', 'Reservation securisee', 'Dashboard analytics', 'Gestion budget'],
                'link' => 'https://www.jachyvhamapartements.com/rooms',
            ],
            [
                'title' => 'Chatbot medical Niketkaps',
                'category' => 'IA',
                'color' => '#f59e0b',
                'image' => 'assets/img/niketkaps.webp',
                'description' => "Application de chatbot medical avec integration LLM et protocole RAG.",
                'skills' => ['RAG', 'Django', 'React JS'],
                'details' => ['Temps reel', 'Pipeline de connaissances', 'Interface responsive'],
                'link' => 'https://niketkaps.vercel.app/',
            ],
        ];

        foreach ($projects as $project) {
            Project::query()->updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
