<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Another User',
            'email' => 'a@user.com',
            'password' => bcrypt('12341234'),
            'username' => 'acelf'
        ]);
    }
}
