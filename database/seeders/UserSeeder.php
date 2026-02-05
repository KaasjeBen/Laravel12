<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Student User', 'email' => 'student@school.nl', 'password' => 'student', 'role' => 'student'],
            ['name' => 'Teacher User', 'email' => 'teacher@school.nl', 'password' => 'teacher', 'role' => 'teacher'],
            ['name' => 'Admin User', 'email' => 'admin@school.nl', 'password' => 'admin', 'role' => 'admin'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => Hash::make($userData['password'])]
            );

            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
