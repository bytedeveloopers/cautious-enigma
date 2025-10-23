<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Programación Web',
                'slug' => 'programacion-web',
                'description' => 'Aprende desarrollo web front-end y back-end',
                'icon' => '💻',
                'color' => '#3b82f6',
                'order' => 1
            ],
            [
                'name' => 'Bases de Datos',
                'slug' => 'bases-de-datos',
                'description' => 'Gestión y diseño de bases de datos',
                'icon' => '🗄️',
                'color' => '#10b981',
                'order' => 2
            ],
            [
                'name' => 'Algoritmos',
                'slug' => 'algoritmos',
                'description' => 'Estructuras de datos y algoritmos',
                'icon' => '🧮',
                'color' => '#f59e0b',
                'order' => 3
            ],
            [
                'name' => 'Frameworks',
                'slug' => 'frameworks',
                'description' => 'Frameworks modernos de desarrollo',
                'icon' => '🛠️',
                'color' => '#8b5cf6',
                'order' => 4
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Integración y despliegue continuo',
                'icon' => '🚀',
                'color' => '#ef4444',
                'order' => 5
            ],
            [
                'name' => 'Seguridad',
                'slug' => 'seguridad',
                'description' => 'Seguridad informática y ciberseguridad',
                'icon' => '🔒',
                'color' => '#06b6d4',
                'order' => 6
            ],
            [
                'name' => 'Móvil',
                'slug' => 'movil',
                'description' => 'Desarrollo de aplicaciones móviles',
                'icon' => '📱',
                'color' => '#ec4899',
                'order' => 7
            ],
            [
                'name' => 'Machine Learning',
                'slug' => 'machine-learning',
                'description' => 'Inteligencia Artificial y ML',
                'icon' => '🤖',
                'color' => '#6366f1',
                'order' => 8
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
