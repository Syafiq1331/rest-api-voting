<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voters')->insert(
            [
                [
                    'id_users' => 1,
                    'is_voted' => 'voted',
                    'id_selections' => 1,
                ],
                [
                    'id_users' => 1,
                    'is_voted' => 'not voted',
                    'id_selections' => 1,
                ]
            ]
        );
    }
}
