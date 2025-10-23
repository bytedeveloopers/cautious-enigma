<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\User;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get teachers
        $teachers = User::where('role', 'teacher')->get();
        
        if ($teachers->isEmpty()) {
            return;
        }

        // Lessons by Prof. María García (first teacher)
        $teacher1 = $teachers->first();
        
        Lesson::create([
            'title' => 'Introducción a Laravel',
            'description' => 'Aprende los conceptos básicos del framework Laravel PHP, desde la instalación hasta la creación de tu primera aplicación.',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration' => 45,
            'order' => 1,
            'teacher_id' => $teacher1->id,
        ]);

        Lesson::create([
            'title' => 'Rutas y Controladores en Laravel',
            'description' => 'Comprende cómo funcionan las rutas y controladores en Laravel para organizar tu aplicación de manera eficiente.',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration' => 38,
            'order' => 2,
            'teacher_id' => $teacher1->id,
        ]);

        Lesson::create([
            'title' => 'Eloquent ORM - Modelos y Relaciones',
            'description' => 'Domina el ORM de Laravel para trabajar con bases de datos de forma elegante y eficiente.',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration' => 52,
            'order' => 3,
            'teacher_id' => $teacher1->id,
        ]);

        // Lessons by Dr. Carlos Rodríguez (if exists)
        if ($teachers->count() > 1) {
            $teacher2 = $teachers->skip(1)->first();
            
            Lesson::create([
                'title' => 'JavaScript Moderno - ES6+',
                'description' => 'Explora las características más recientes de JavaScript y cómo utilizarlas en tus proyectos.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 41,
                'order' => 1,
                'teacher_id' => $teacher2->id,
            ]);

            Lesson::create([
                'title' => 'React.js - Componentes y Estados',
                'description' => 'Aprende a crear interfaces de usuario dinámicas con React.js y maneja el estado de tu aplicación.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 48,
                'order' => 2,
                'teacher_id' => $teacher2->id,
            ]);
        }

        // Lessons by Lic. Ana Martínez (if exists)
        if ($teachers->count() > 2) {
            $teacher3 = $teachers->skip(2)->first();
            
            Lesson::create([
                'title' => 'Diseño UX/UI Fundamentals',
                'description' => 'Aprende los principios básicos del diseño de experiencia de usuario y interfaces intuitivas.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 35,
                'order' => 1,
                'teacher_id' => $teacher3->id,
            ]);

            Lesson::create([
                'title' => 'Prototipado con Figma',
                'description' => 'Domina Figma para crear prototipos profesionales y colaborar eficientemente en equipos de diseño.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 42,
                'order' => 2,
                'teacher_id' => $teacher3->id,
            ]);

            Lesson::create([
                'title' => 'Design Systems y Componentes',
                'description' => 'Crea sistemas de diseño consistentes y componentes reutilizables para proyectos escalables.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'duration' => 55,
                'order' => 3,
                'teacher_id' => $teacher3->id,
            ]);
        }
    }
}
