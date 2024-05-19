<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'nama_tahun' => 'ganjil',
            ],
            [
                'nama_tahun' => 'genap',
            ]
        ];

        DB::table('tahun_ajaran_semesters')->insert($posts);
    }
}
