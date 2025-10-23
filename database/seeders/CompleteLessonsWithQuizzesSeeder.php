<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;

class CompleteLessonsWithQuizzesSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();
        
        if (!$teacher) {
            $teacher = User::create([
                'name' => 'Profesor Principal',
                'email' => 'profesor@lms.com',
                'password' => bcrypt('password'),
                'role' => 'teacher'
            ]);
        }

        $lessons = [
            // Web Development
            [
                'title' => 'Introducción a HTML5',
                'description' => 'Aprende los fundamentos de HTML5 y estructura web moderna',
                'content' => 'HTML5 es el lenguaje de marcado estándar para crear páginas web...',
                'video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
                'duration' => 45,
                'difficulty_level' => 'beginner',
                'points' => 50,
                'category_ids' => [1], // Programación Web
                'quiz' => [
                    'title' => 'Quiz de HTML5 Básico',
                    'questions' => [
                        [
                            'question' => '¿Qué significa HTML?',
                            'answers' => [
                                ['text' => 'HyperText Markup Language', 'correct' => true],
                                ['text' => 'High Tech Modern Language', 'correct' => false],
                                ['text' => 'Home Tool Markup Language', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es la etiqueta correcta para el título principal?',
                            'answers' => [
                                ['text' => '<h1>', 'correct' => true],
                                ['text' => '<title>', 'correct' => false],
                                ['text' => '<header>', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué etiqueta se usa para crear un enlace?',
                            'answers' => [
                                ['text' => '<a>', 'correct' => true],
                                ['text' => '<link>', 'correct' => false],
                                ['text' => '<url>', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es la estructura básica de un documento HTML5?',
                            'answers' => [
                                ['text' => '<!DOCTYPE html>, <html>, <head>, <body>', 'correct' => true],
                                ['text' => '<html>, <body>, <content>', 'correct' => false],
                                ['text' => '<page>, <header>, <main>', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'CSS3: Estilos y Diseño',
                'description' => 'Domina CSS3 para crear diseños atractivos y responsive',
                'content' => 'CSS3 es el lenguaje que da estilo y diseño a las páginas web...',
                'video_url' => 'https://www.youtube.com/watch?v=wRNinF7YQqQ',
                'duration' => 60,
                'difficulty_level' => 'beginner',
                'points' => 50,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de CSS3',
                    'questions' => [
                        [
                            'question' => '¿Qué significa CSS?',
                            'answers' => [
                                ['text' => 'Cascading Style Sheets', 'correct' => true],
                                ['text' => 'Computer Style Sheets', 'correct' => false],
                                ['text' => 'Creative Style System', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es la sintaxis correcta para cambiar el color de fondo?',
                            'answers' => [
                                ['text' => 'background-color: red;', 'correct' => true],
                                ['text' => 'bg-color: red;', 'correct' => false],
                                ['text' => 'color-background: red;', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué propiedad se usa para cambiar el tamaño de fuente?',
                            'answers' => [
                                ['text' => 'font-size', 'correct' => true],
                                ['text' => 'text-size', 'correct' => false],
                                ['text' => 'size', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es el selector para una clase en CSS?',
                            'answers' => [
                                ['text' => '.nombre-clase', 'correct' => true],
                                ['text' => '#nombre-clase', 'correct' => false],
                                ['text' => 'nombre-clase', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'JavaScript Básico',
                'description' => 'Aprende los fundamentos de JavaScript para dar vida a tus sitios web',
                'content' => 'JavaScript es el lenguaje de programación de la web...',
                'video_url' => 'https://www.youtube.com/watch?v=hdI2bqOjy3c',
                'duration' => 90,
                'difficulty_level' => 'beginner',
                'points' => 75,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de JavaScript',
                    'questions' => [
                        [
                            'question' => '¿Cómo se declara una variable en JavaScript moderno?',
                            'answers' => [
                                ['text' => 'let o const', 'correct' => true],
                                ['text' => 'variable', 'correct' => false],
                                ['text' => 'int', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué método se usa para imprimir en consola?',
                            'answers' => [
                                ['text' => 'console.log()', 'correct' => true],
                                ['text' => 'print()', 'correct' => false],
                                ['text' => 'echo()', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es el operador de igualdad estricta?',
                            'answers' => [
                                ['text' => '===', 'correct' => true],
                                ['text' => '==', 'correct' => false],
                                ['text' => '=', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué palabra clave se usa para crear una función?',
                            'answers' => [
                                ['text' => 'function', 'correct' => true],
                                ['text' => 'func', 'correct' => false],
                                ['text' => 'def', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'React: Componentes y Props',
                'description' => 'Aprende a crear componentes reutilizables en React',
                'content' => 'React es una biblioteca de JavaScript para construir interfaces...',
                'video_url' => 'https://www.youtube.com/watch?v=w7ejDZ8SWv8',
                'duration' => 120,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [4], // Frameworks
                'quiz' => [
                    'title' => 'Quiz de React',
                    'questions' => [
                        [
                            'question' => '¿Qué es un componente en React?',
                            'answers' => [
                                ['text' => 'Una pieza reutilizable de UI', 'correct' => true],
                                ['text' => 'Una base de datos', 'correct' => false],
                                ['text' => 'Un servidor web', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se pasan datos a un componente hijo?',
                            'answers' => [
                                ['text' => 'A través de props', 'correct' => true],
                                ['text' => 'Con variables globales', 'correct' => false],
                                ['text' => 'Por URL', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué hook se usa para manejar estado?',
                            'answers' => [
                                ['text' => 'useState', 'correct' => true],
                                ['text' => 'useEffect', 'correct' => false],
                                ['text' => 'useContext', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es JSX?',
                            'answers' => [
                                ['text' => 'Sintaxis de JavaScript extendida para escribir HTML', 'correct' => true],
                                ['text' => 'Un lenguaje de programación', 'correct' => false],
                                ['text' => 'Una base de datos', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Vue.js Esencial',
                'description' => 'Framework progresivo para construir interfaces de usuario',
                'content' => 'Vue.js es un framework JavaScript progresivo y versátil...',
                'video_url' => 'https://www.youtube.com/watch?v=nhBVL41-_Cw',
                'duration' => 100,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [4],
                'quiz' => [
                    'title' => 'Quiz de Vue.js',
                    'questions' => [
                        [
                            'question' => '¿Qué directiva se usa para renderizado condicional?',
                            'answers' => [
                                ['text' => 'v-if', 'correct' => true],
                                ['text' => 'v-show', 'correct' => false],
                                ['text' => 'v-for', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se vincula un atributo en Vue?',
                            'answers' => [
                                ['text' => 'v-bind o :', 'correct' => true],
                                ['text' => 'v-model', 'correct' => false],
                                ['text' => 'v-on', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es la reactividad en Vue?',
                            'answers' => [
                                ['text' => 'Actualización automática del DOM cuando cambian los datos', 'correct' => true],
                                ['text' => 'Un tipo de componente', 'correct' => false],
                                ['text' => 'Una librería externa', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué método del ciclo de vida se ejecuta cuando el componente se monta?',
                            'answers' => [
                                ['text' => 'mounted', 'correct' => true],
                                ['text' => 'created', 'correct' => false],
                                ['text' => 'updated', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],

            // Databases
            [
                'title' => 'SQL Fundamentos',
                'description' => 'Aprende a consultar y manipular bases de datos relacionales',
                'content' => 'SQL es el lenguaje estándar para bases de datos relacionales...',
                'video_url' => 'https://www.youtube.com/watch?v=HXV3zeQKqGY',
                'duration' => 75,
                'difficulty_level' => 'beginner',
                'points' => 75,
                'category_ids' => [2], // Bases de Datos
                'quiz' => [
                    'title' => 'Quiz de SQL',
                    'questions' => [
                        [
                            'question' => '¿Qué comando se usa para seleccionar datos?',
                            'answers' => [
                                ['text' => 'SELECT', 'correct' => true],
                                ['text' => 'GET', 'correct' => false],
                                ['text' => 'FETCH', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se insertan datos en una tabla?',
                            'answers' => [
                                ['text' => 'INSERT INTO', 'correct' => true],
                                ['text' => 'ADD INTO', 'correct' => false],
                                ['text' => 'PUT INTO', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué cláusula filtra resultados?',
                            'answers' => [
                                ['text' => 'WHERE', 'correct' => true],
                                ['text' => 'FILTER', 'correct' => false],
                                ['text' => 'HAVING', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es una PRIMARY KEY?',
                            'answers' => [
                                ['text' => 'Identificador único de cada registro', 'correct' => true],
                                ['text' => 'La primera columna de la tabla', 'correct' => false],
                                ['text' => 'Una contraseña', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'MySQL Avanzado',
                'description' => 'Consultas complejas, índices y optimización',
                'content' => 'MySQL es uno de los sistemas de gestión de bases de datos más populares...',
                'video_url' => 'https://www.youtube.com/watch?v=7S_tz1z_5bA',
                'duration' => 90,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [2],
                'quiz' => [
                    'title' => 'Quiz de MySQL Avanzado',
                    'questions' => [
                        [
                            'question' => '¿Qué es un índice en MySQL?',
                            'answers' => [
                                ['text' => 'Estructura que acelera las consultas', 'correct' => true],
                                ['text' => 'Un tipo de tabla', 'correct' => false],
                                ['text' => 'Una función', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué tipo de JOIN devuelve solo coincidencias?',
                            'answers' => [
                                ['text' => 'INNER JOIN', 'correct' => true],
                                ['text' => 'LEFT JOIN', 'correct' => false],
                                ['text' => 'RIGHT JOIN', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué comando optimiza una tabla?',
                            'answers' => [
                                ['text' => 'OPTIMIZE TABLE', 'correct' => true],
                                ['text' => 'CLEAN TABLE', 'correct' => false],
                                ['text' => 'FIX TABLE', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es una transacción?',
                            'answers' => [
                                ['text' => 'Conjunto de operaciones que se ejecutan como una unidad', 'correct' => true],
                                ['text' => 'Una consulta SELECT', 'correct' => false],
                                ['text' => 'Un tipo de índice', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'MongoDB: NoSQL Database',
                'description' => 'Bases de datos orientadas a documentos',
                'content' => 'MongoDB es una base de datos NoSQL orientada a documentos...',
                'video_url' => 'https://www.youtube.com/watch?v=pWbMrx5rVBE',
                'duration' => 80,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [2],
                'quiz' => [
                    'title' => 'Quiz de MongoDB',
                    'questions' => [
                        [
                            'question' => '¿En qué formato almacena datos MongoDB?',
                            'answers' => [
                                ['text' => 'JSON/BSON', 'correct' => true],
                                ['text' => 'XML', 'correct' => false],
                                ['text' => 'CSV', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se llama una "tabla" en MongoDB?',
                            'answers' => [
                                ['text' => 'Colección', 'correct' => true],
                                ['text' => 'Documento', 'correct' => false],
                                ['text' => 'Base', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué método se usa para buscar documentos?',
                            'answers' => [
                                ['text' => 'find()', 'correct' => true],
                                ['text' => 'select()', 'correct' => false],
                                ['text' => 'query()', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es un documento en MongoDB?',
                            'answers' => [
                                ['text' => 'Un registro individual en formato JSON', 'correct' => true],
                                ['text' => 'Una tabla', 'correct' => false],
                                ['text' => 'Una base de datos', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],

            // Algorithms
            [
                'title' => 'Estructuras de Datos Básicas',
                'description' => 'Arrays, listas enlazadas, pilas y colas',
                'content' => 'Las estructuras de datos son formas de organizar y almacenar información...',
                'video_url' => 'https://www.youtube.com/watch?v=bum_19loj9A',
                'duration' => 70,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [3], // Algoritmos
                'quiz' => [
                    'title' => 'Quiz de Estructuras de Datos',
                    'questions' => [
                        [
                            'question' => '¿Qué es una pila (stack)?',
                            'answers' => [
                                ['text' => 'Estructura LIFO (Last In First Out)', 'correct' => true],
                                ['text' => 'Estructura FIFO', 'correct' => false],
                                ['text' => 'Un tipo de árbol', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué operación agrega un elemento a una pila?',
                            'answers' => [
                                ['text' => 'push', 'correct' => true],
                                ['text' => 'pop', 'correct' => false],
                                ['text' => 'enqueue', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es la complejidad de acceso a un array por índice?',
                            'answers' => [
                                ['text' => 'O(1)', 'correct' => true],
                                ['text' => 'O(n)', 'correct' => false],
                                ['text' => 'O(log n)', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué estructura sigue el principio FIFO?',
                            'answers' => [
                                ['text' => 'Cola (Queue)', 'correct' => true],
                                ['text' => 'Pila (Stack)', 'correct' => false],
                                ['text' => 'Árbol', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Algoritmos de Ordenamiento',
                'description' => 'Bubble Sort, Quick Sort, Merge Sort',
                'content' => 'Los algoritmos de ordenamiento organizan datos en un orden específico...',
                'video_url' => 'https://www.youtube.com/watch?v=kPRA0W1kECg',
                'duration' => 85,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [3],
                'quiz' => [
                    'title' => 'Quiz de Algoritmos de Ordenamiento',
                    'questions' => [
                        [
                            'question' => '¿Cuál es la complejidad promedio de Quick Sort?',
                            'answers' => [
                                ['text' => 'O(n log n)', 'correct' => true],
                                ['text' => 'O(n²)', 'correct' => false],
                                ['text' => 'O(n)', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué algoritmo divide el array en mitades recursivamente?',
                            'answers' => [
                                ['text' => 'Merge Sort', 'correct' => true],
                                ['text' => 'Bubble Sort', 'correct' => false],
                                ['text' => 'Selection Sort', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cuál es el algoritmo más simple pero menos eficiente?',
                            'answers' => [
                                ['text' => 'Bubble Sort', 'correct' => true],
                                ['text' => 'Quick Sort', 'correct' => false],
                                ['text' => 'Heap Sort', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué algoritmo usa un pivote?',
                            'answers' => [
                                ['text' => 'Quick Sort', 'correct' => true],
                                ['text' => 'Insertion Sort', 'correct' => false],
                                ['text' => 'Bubble Sort', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],

            // More lessons...
            [
                'title' => 'Git y Control de Versiones',
                'description' => 'Aprende a gestionar código con Git y GitHub',
                'content' => 'Git es un sistema de control de versiones distribuido...',
                'video_url' => 'https://www.youtube.com/watch?v=RGOj5yH7evk',
                'duration' => 60,
                'difficulty_level' => 'beginner',
                'points' => 50,
                'category_ids' => [5], // DevOps
                'quiz' => [
                    'title' => 'Quiz de Git',
                    'questions' => [
                        [
                            'question' => '¿Qué comando inicializa un repositorio Git?',
                            'answers' => [
                                ['text' => 'git init', 'correct' => true],
                                ['text' => 'git start', 'correct' => false],
                                ['text' => 'git create', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se agrega un archivo al staging area?',
                            'answers' => [
                                ['text' => 'git add', 'correct' => true],
                                ['text' => 'git stage', 'correct' => false],
                                ['text' => 'git include', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué comando guarda los cambios en el repositorio?',
                            'answers' => [
                                ['text' => 'git commit', 'correct' => true],
                                ['text' => 'git save', 'correct' => false],
                                ['text' => 'git store', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se sube código a un repositorio remoto?',
                            'answers' => [
                                ['text' => 'git push', 'correct' => true],
                                ['text' => 'git upload', 'correct' => false],
                                ['text' => 'git send', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Docker Básico',
                'description' => 'Contenedores y despliegue de aplicaciones',
                'content' => 'Docker permite empaquetar aplicaciones en contenedores...',
                'video_url' => 'https://www.youtube.com/watch?v=CV_Uf3Dq-EU',
                'duration' => 90,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [5],
                'quiz' => [
                    'title' => 'Quiz de Docker',
                    'questions' => [
                        [
                            'question' => '¿Qué es un contenedor Docker?',
                            'answers' => [
                                ['text' => 'Entorno aislado para ejecutar aplicaciones', 'correct' => true],
                                ['text' => 'Una máquina virtual', 'correct' => false],
                                ['text' => 'Un servidor físico', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué archivo define una imagen Docker?',
                            'answers' => [
                                ['text' => 'Dockerfile', 'correct' => true],
                                ['text' => 'docker.json', 'correct' => false],
                                ['text' => 'container.yml', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué comando ejecuta un contenedor?',
                            'answers' => [
                                ['text' => 'docker run', 'correct' => true],
                                ['text' => 'docker start', 'correct' => false],
                                ['text' => 'docker execute', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es Docker Hub?',
                            'answers' => [
                                ['text' => 'Repositorio de imágenes Docker', 'correct' => true],
                                ['text' => 'Un IDE', 'correct' => false],
                                ['text' => 'Un servidor web', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Python para Principiantes',
                'description' => 'Fundamentos de programación con Python',
                'content' => 'Python es un lenguaje versátil y fácil de aprender...',
                'video_url' => 'https://www.youtube.com/watch?v=rfscVS0vtbw',
                'duration' => 120,
                'difficulty_level' => 'beginner',
                'points' => 75,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de Python',
                    'questions' => [
                        [
                            'question' => '¿Cómo se imprime en Python?',
                            'answers' => [
                                ['text' => 'print()', 'correct' => true],
                                ['text' => 'console.log()', 'correct' => false],
                                ['text' => 'echo', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué símbolo se usa para comentarios?',
                            'answers' => [
                                ['text' => '#', 'correct' => true],
                                ['text' => '//', 'correct' => false],
                                ['text' => '<!--', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se define una función?',
                            'answers' => [
                                ['text' => 'def nombre():', 'correct' => true],
                                ['text' => 'function nombre()', 'correct' => false],
                                ['text' => 'func nombre()', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué estructura de datos usa corchetes []?',
                            'answers' => [
                                ['text' => 'Lista', 'correct' => true],
                                ['text' => 'Diccionario', 'correct' => false],
                                ['text' => 'Tupla', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Node.js y Express',
                'description' => 'Backend con JavaScript',
                'content' => 'Node.js permite ejecutar JavaScript en el servidor...',
                'video_url' => 'https://www.youtube.com/watch?v=Oe421EPjeBE',
                'duration' => 110,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [4],
                'quiz' => [
                    'title' => 'Quiz de Node.js',
                    'questions' => [
                        [
                            'question' => '¿Qué es Node.js?',
                            'answers' => [
                                ['text' => 'Entorno de ejecución de JavaScript en el servidor', 'correct' => true],
                                ['text' => 'Un framework frontend', 'correct' => false],
                                ['text' => 'Una base de datos', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué gestor de paquetes usa Node.js?',
                            'answers' => [
                                ['text' => 'npm', 'correct' => true],
                                ['text' => 'pip', 'correct' => false],
                                ['text' => 'composer', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se importa un módulo en Node.js?',
                            'answers' => [
                                ['text' => 'require()', 'correct' => true],
                                ['text' => 'import', 'correct' => false],
                                ['text' => 'include', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es Express?',
                            'answers' => [
                                ['text' => 'Framework web para Node.js', 'correct' => true],
                                ['text' => 'Una base de datos', 'correct' => false],
                                ['text' => 'Un lenguaje de programación', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'API REST: Diseño y Buenas Prácticas',
                'description' => 'Crea APIs RESTful profesionales',
                'content' => 'REST es un estilo de arquitectura para servicios web...',
                'video_url' => 'https://www.youtube.com/watch?v=Q-BpqyOT3a8',
                'duration' => 95,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de API REST',
                    'questions' => [
                        [
                            'question' => '¿Qué método HTTP se usa para obtener datos?',
                            'answers' => [
                                ['text' => 'GET', 'correct' => true],
                                ['text' => 'POST', 'correct' => false],
                                ['text' => 'DELETE', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué código de estado indica éxito?',
                            'answers' => [
                                ['text' => '200', 'correct' => true],
                                ['text' => '404', 'correct' => false],
                                ['text' => '500', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué método se usa para crear un recurso?',
                            'answers' => [
                                ['text' => 'POST', 'correct' => true],
                                ['text' => 'GET', 'correct' => false],
                                ['text' => 'PUT', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es JSON?',
                            'answers' => [
                                ['text' => 'Formato de intercambio de datos', 'correct' => true],
                                ['text' => 'Un lenguaje de programación', 'correct' => false],
                                ['text' => 'Una base de datos', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Seguridad Web Básica',
                'description' => 'Protege tus aplicaciones contra ataques comunes',
                'content' => 'La seguridad web es fundamental para proteger aplicaciones...',
                'video_url' => 'https://www.youtube.com/watch?v=WlmKwIe9z1Q',
                'duration' => 80,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [6], // Seguridad
                'quiz' => [
                    'title' => 'Quiz de Seguridad Web',
                    'questions' => [
                        [
                            'question' => '¿Qué es XSS?',
                            'answers' => [
                                ['text' => 'Cross-Site Scripting', 'correct' => true],
                                ['text' => 'Extra Security System', 'correct' => false],
                                ['text' => 'XML Security Standard', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué ataque inyecta código SQL malicioso?',
                            'answers' => [
                                ['text' => 'SQL Injection', 'correct' => true],
                                ['text' => 'XSS', 'correct' => false],
                                ['text' => 'CSRF', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué protocolo asegura la comunicación HTTP?',
                            'answers' => [
                                ['text' => 'HTTPS', 'correct' => true],
                                ['text' => 'FTP', 'correct' => false],
                                ['text' => 'SMTP', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es CSRF?',
                            'answers' => [
                                ['text' => 'Cross-Site Request Forgery', 'correct' => true],
                                ['text' => 'Client Side Request Format', 'correct' => false],
                                ['text' => 'Certified Security Reference Framework', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Testing: Unit y Integration Tests',
                'description' => 'Asegura la calidad de tu código con pruebas',
                'content' => 'Las pruebas automatizadas son esenciales para el desarrollo...',
                'video_url' => 'https://www.youtube.com/watch?v=r9HdJ8P6GQI',
                'duration' => 85,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de Testing',
                    'questions' => [
                        [
                            'question' => '¿Qué es un Unit Test?',
                            'answers' => [
                                ['text' => 'Prueba de una unidad individual de código', 'correct' => true],
                                ['text' => 'Prueba del sistema completo', 'correct' => false],
                                ['text' => 'Prueba de interfaz de usuario', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué metodología es TDD?',
                            'answers' => [
                                ['text' => 'Test-Driven Development', 'correct' => true],
                                ['text' => 'Test-Debug-Deploy', 'correct' => false],
                                ['text' => 'Total Development Design', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es un mock en testing?',
                            'answers' => [
                                ['text' => 'Objeto simulado para pruebas', 'correct' => true],
                                ['text' => 'Un error en el código', 'correct' => false],
                                ['text' => 'Una base de datos de prueba', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué herramienta es popular para testing en JavaScript?',
                            'answers' => [
                                ['text' => 'Jest', 'correct' => true],
                                ['text' => 'Python', 'correct' => false],
                                ['text' => 'Maven', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Laravel: Framework PHP Moderno',
                'description' => 'Desarrollo web con Laravel',
                'content' => 'Laravel es el framework PHP más popular...',
                'video_url' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
                'duration' => 130,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [4],
                'quiz' => [
                    'title' => 'Quiz de Laravel',
                    'questions' => [
                        [
                            'question' => '¿Qué comando crea un nuevo proyecto Laravel?',
                            'answers' => [
                                ['text' => 'laravel new proyecto', 'correct' => true],
                                ['text' => 'php create proyecto', 'correct' => false],
                                ['text' => 'composer start proyecto', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es Eloquent en Laravel?',
                            'answers' => [
                                ['text' => 'ORM para bases de datos', 'correct' => true],
                                ['text' => 'Un sistema de plantillas', 'correct' => false],
                                ['text' => 'Un servidor web', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué motor de plantillas usa Laravel?',
                            'answers' => [
                                ['text' => 'Blade', 'correct' => true],
                                ['text' => 'Twig', 'correct' => false],
                                ['text' => 'Smarty', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué comando ejecuta migraciones?',
                            'answers' => [
                                ['text' => 'php artisan migrate', 'correct' => true],
                                ['text' => 'php migrate run', 'correct' => false],
                                ['text' => 'composer migrate', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'TypeScript: JavaScript con Tipos',
                'description' => 'JavaScript tipado para proyectos escalables',
                'content' => 'TypeScript añade tipado estático a JavaScript...',
                'video_url' => 'https://www.youtube.com/watch?v=BwuLxPH8IDs',
                'duration' => 75,
                'difficulty_level' => 'intermediate',
                'points' => 100,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de TypeScript',
                    'questions' => [
                        [
                            'question' => '¿Qué añade TypeScript a JavaScript?',
                            'answers' => [
                                ['text' => 'Tipado estático', 'correct' => true],
                                ['text' => 'Async/await', 'correct' => false],
                                ['text' => 'Clases', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Cómo se declara el tipo de una variable?',
                            'answers' => [
                                ['text' => 'let nombre: string', 'correct' => true],
                                ['text' => 'let nombre = string', 'correct' => false],
                                ['text' => 'string nombre', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué archivo configura TypeScript?',
                            'answers' => [
                                ['text' => 'tsconfig.json', 'correct' => true],
                                ['text' => 'typescript.config', 'correct' => false],
                                ['text' => 'ts.json', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿TypeScript se ejecuta directamente en el navegador?',
                            'answers' => [
                                ['text' => 'No, se compila a JavaScript', 'correct' => true],
                                ['text' => 'Sí, directamente', 'correct' => false],
                                ['text' => 'Solo en Node.js', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'GraphQL: API del Futuro',
                'description' => 'Lenguaje de consultas para APIs',
                'content' => 'GraphQL es un lenguaje de consultas para APIs...',
                'video_url' => 'https://www.youtube.com/watch?v=eIQh02xuVw4',
                'duration' => 90,
                'difficulty_level' => 'advanced',
                'points' => 125,
                'category_ids' => [1],
                'quiz' => [
                    'title' => 'Quiz de GraphQL',
                    'questions' => [
                        [
                            'question' => '¿Qué ventaja tiene GraphQL sobre REST?',
                            'answers' => [
                                ['text' => 'Consultas flexibles y específicas', 'correct' => true],
                                ['text' => 'Más rápido siempre', 'correct' => false],
                                ['text' => 'No necesita servidor', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es un resolver en GraphQL?',
                            'answers' => [
                                ['text' => 'Función que obtiene datos para un campo', 'correct' => true],
                                ['text' => 'Un tipo de consulta', 'correct' => false],
                                ['text' => 'Una base de datos', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué palabra clave se usa para obtener datos?',
                            'answers' => [
                                ['text' => 'query', 'correct' => true],
                                ['text' => 'get', 'correct' => false],
                                ['text' => 'fetch', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué operación modifica datos en GraphQL?',
                            'answers' => [
                                ['text' => 'mutation', 'correct' => true],
                                ['text' => 'update', 'correct' => false],
                                ['text' => 'change', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Machine Learning con Python',
                'description' => 'Introducción al aprendizaje automático',
                'content' => 'Machine Learning permite a las computadoras aprender...',
                'video_url' => 'https://www.youtube.com/watch?v=ukzFI9rgwfU',
                'duration' => 140,
                'difficulty_level' => 'advanced',
                'points' => 150,
                'category_ids' => [8], // Machine Learning
                'quiz' => [
                    'title' => 'Quiz de Machine Learning',
                    'questions' => [
                        [
                            'question' => '¿Qué es el aprendizaje supervisado?',
                            'answers' => [
                                ['text' => 'Aprendizaje con datos etiquetados', 'correct' => true],
                                ['text' => 'Aprendizaje sin datos', 'correct' => false],
                                ['text' => 'Aprendizaje manual', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué librería es popular para ML en Python?',
                            'answers' => [
                                ['text' => 'scikit-learn', 'correct' => true],
                                ['text' => 'React', 'correct' => false],
                                ['text' => 'jQuery', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es un modelo de ML?',
                            'answers' => [
                                ['text' => 'Representación matemática aprendida de los datos', 'correct' => true],
                                ['text' => 'Una base de datos', 'correct' => false],
                                ['text' => 'Un algoritmo de ordenamiento', 'correct' => false],
                            ]
                        ],
                        [
                            'question' => '¿Qué es overfitting?',
                            'answers' => [
                                ['text' => 'Cuando el modelo se ajusta demasiado a los datos de entrenamiento', 'correct' => true],
                                ['text' => 'Cuando el modelo es muy simple', 'correct' => false],
                                ['text' => 'Un error de sintaxis', 'correct' => false],
                            ]
                        ],
                    ]
                ]
            ],
        ];

        foreach ($lessons as $index => $lessonData) {
            // Create lesson
            $lesson = Lesson::create([
                'title' => $lessonData['title'],
                'description' => $lessonData['description'],
                'content' => $lessonData['content'],
                'video_url' => $lessonData['video_url'],
                'duration' => $lessonData['duration'],
                'difficulty_level' => $lessonData['difficulty_level'],
                'points' => $lessonData['points'],
                'teacher_id' => $teacher->id,
                'order' => $index + 1
            ]);

            // Attach categories
            if (isset($lessonData['category_ids'])) {
                $lesson->categories()->attach($lessonData['category_ids']);
            }

            // Create quiz
            $quiz = Quiz::create([
                'lesson_id' => $lesson->id,
                'title' => $lessonData['quiz']['title'],
                'description' => 'Pon a prueba tus conocimientos de ' . $lesson->title,
                'passing_score' => 75,
                'max_attempts' => 3
            ]);

            // Create questions and answers
            foreach ($lessonData['quiz']['questions'] as $qIndex => $questionData) {
                $question = QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'points' => 25,
                    'order' => $qIndex + 1
                ]);

                foreach ($questionData['answers'] as $aIndex => $answerData) {
                    QuizAnswer::create([
                        'question_id' => $question->id,
                        'answer' => $answerData['text'],
                        'is_correct' => $answerData['correct'],
                        'order' => $aIndex + 1
                    ]);
                }
            }
        }

        $this->command->info('✓ Created ' . count($lessons) . ' lessons with quizzes!');
    }
}
