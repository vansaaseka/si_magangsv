<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'role_id' => '1',
                'name' => 'mahasiswa',
                'email' => 'mahasiswa@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('12345678'),
                'status' => 1
            ],
            [
                'role_id' => '2',
                'name' => 'timcdc',
                'email' => 'cdc@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('cdc123'),
                'status' => 1
            ],
            [
                'role_id' => '3',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('admin123'),
                'status' => 1
            ],
            [
                'role_id' => '4',
                'name' => 'dekan',
                'email' => 'dekan@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('dekan123'),
                'status' => 1
            ],
            [
                'role_id' => '5',
                'name' => 'dosen',
                'email' => 'dosen@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('dosen123'),
                'status' => 1
            ],
            [
                'role_id' => '5',
                'name' => 'Agus Purbayu, S.Si.,M.Kom',
                'email' => 'bayoe@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('bayu123'),
                'status' => 1
            ],
            [
                'role_id' => '5',
                'name' => 'Sahirul Alim Tri Bawono, S.Kom., M.Kom.',
                'email' => 'sahirul@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('dosen123'),
                'status' => 1
            ],
            [
                'role_id' => '5',
                'name' => 'Eko Harry Pratisto, S.T., M.Info.Tech., Ph.D.',
                'email' => 'ekoharry@gmail.com',
                'prodi_id' => 1,
                'password' => Hash::make('dosen123'),
                'status' => 1
            ],
        ];

        DB::table('users')->insert($posts);
    }
}
