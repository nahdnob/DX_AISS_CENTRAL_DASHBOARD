<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'npk'      => '2000103',
            'name'     => 'Fachrudin Fachmi',
            'email'    => 'fachrudinfachmi@example.com',
            'password' => Hash::make('2000103'),
            'role'     => 'user',
        ]);
    }
}
