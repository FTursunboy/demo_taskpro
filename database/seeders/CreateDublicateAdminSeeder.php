<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateDublicateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nuriddin',
            'surname' => 'Shahobov',
            'lastname' => 'Farrukhovich',
            'phone' => '+992000207747',
            'login' => 'z1ntel2001',
            'password' => Hash::make('z1ntel2001'),
            'position' => 'Admin',
            'otdel_id' => 1,
            'telegram_user_id' => 123123123,
            'xp' => 100,
            'slug' => Str::slug(Str::random(6) . ' ' . "Nuriddin Shahobov " . Str::random(4), '-'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Ахмедова',
            'surname' => 'Муаттар',
            'lastname' => '',
            'phone' => '+00000000',
            'login' => 'admin2',
            'password' => Hash::make('password'),
            'position' => 'Admin',
            'otdel_id' => 1,
            'telegram_user_id' => 12312354123,
            'xp' => 100,
            'slug' => Str::slug(Str::random(6) . ' ' . "Nuriddin Shahobov " . Str::random(4), '-'),
        ])->assignRole('admin');

    }
}
