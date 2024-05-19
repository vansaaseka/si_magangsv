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
                'password' => Hash::make('12345678')
            ],
            [
                'role_id' => '2',
                'name' => 'timcdc',
                'email' => 'cdc@gmail.com',
                'password' => Hash::make('cdc123')
            ],
            [
                'role_id' => '3',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ],
            [
                'role_id' => '4',
                'name' => 'dekan',
                'email' => 'dekan@gmail.com',
                'password' => Hash::make('dekan123')
            ],
            [
                'role_id' => '5',
                'name' => 'dosen',
                'email' => 'dosen@gmail.com',
                'password' => Hash::make('dosen123')
            ],
        ];

        DB::table('users')->insert($posts);
    }
}
