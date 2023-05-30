<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Candidates;
use COM;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SelectionSeeder::class,
            CandidateSeeder::class,
            VoterSeeder::class,
            VotesSeeder::class,
        ]);
    }
}
