<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@portfolio.local',
        ], [
            'name' => 'Administrateur Portfolio',
            'password' => Hash::make('Admin1234!'),
        ]);

        $this->call(ProjectSeeder::class);
    }
}
