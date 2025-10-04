<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
     public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'user_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // you can change password
            'role' => 'admin',
        ]);

        $this->command->info('Admin user created: admin@admin.com / password');
    }
}
