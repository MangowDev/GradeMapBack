<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@example.com',
            'dni' => '00000001A',
            'name' => 'Admin',
            'surnames' => 'User',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'teacher',
            'password' => Hash::make('teacher123'),
            'email' => 'teacher@example.com',
            'dni' => '00000002B',
            'name' => 'Teacher',
            'surnames' => 'User',
            'role' => 'teacher',
        ]);

        User::create([
            'username' => 'student',
            'password' => Hash::make('student123'),
            'email' => 'student@example.com',
            'dni' => '00000003C',
            'name' => 'Student',
            'surnames' => 'User',
            'role' => 'student',
        ]);

        User::factory()->count(18)->create();
    }
}
