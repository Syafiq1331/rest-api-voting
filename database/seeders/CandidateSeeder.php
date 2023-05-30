<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('candidates')->insert([
            'id_selections' => 1,
            'name' => 'Rizky',
            'visi' => 'Membangun sekolah yang lebih baik',
            'misi' => 'Membangun sekolah yang lebih baik',
            'photo' => 'https://i.ibb.co/0jZ3Q0K/1.jpg',
        ]);
    }
}
