<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            'name' => 'João Valentim',
            'email' => 'joaovalentimdourado@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'city' => 'Póvoa de Varzim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
        User::insert($users);
    }
}
