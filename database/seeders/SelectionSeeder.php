<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SelectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('selections')->insert([
            [
                'title' => 'Pemilihan Ketua OSIS',
                'status' => 'active',
                'start_date' => '2021-05-23',
                'end_date' => '2021-05-23',
            ],
            [
                'title' => 'Pemilihan Ketua MPk',
                'status' => 'inactive',
                'start_date' => '2021-05-23',
                'end_date' => '2021-05-23',
            ]
        ]);
    }
}
