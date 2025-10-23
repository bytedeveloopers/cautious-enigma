<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo teacher
        User::create([
            'name' => 'Prof. María García',
            'email' => 'profesor@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create a demo student
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'estudiante@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create additional teachers
        User::create([
            'name' => 'Dr. Carlos Rodríguez',
            'email' => 'carlos@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        User::create([
            'name' => 'Lic. Ana Martínez',
            'email' => 'ana@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Create additional students
        User::create([
            'name' => 'Sofia López',
            'email' => 'sofia@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Miguel Torres',
            'email' => 'miguel@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Laura Fernández',
            'email' => 'laura@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Roberto Silva',
            'email' => 'roberto@lms.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
