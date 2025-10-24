# 📚 LMS Simple - Sistema de Gestión de Aprendizaje

Sistema completo de gestión de aprendizaje (LMS) desarrollado con Laravel 11, que incluye sistema de quizzes, ranking de estudiantes, gestión de lecciones y más.

## ✨ Características Principales

### 🎓 Para Estudiantes
- **Catálogo de Lecciones**: Explora lecciones organizadas por categorías
- **Videos Integrados**: Soporte para YouTube, Vimeo, HLS y videos directos
- **Sistema de Quizzes**: 
  - 4 preguntas por lección con 3 opciones de respuesta
  - Calificación automática (0-100%)
  - Máximo 3 intentos por quiz
  - Nota mínima de 75% para aprobar
  - Retroalimentación detallada con correctas/incorrectas
- **Ranking Global**: Tabla de clasificación basada en puntos, lecciones completadas y quizzes aprobados
- **Sistema de Puntos**: Gana puntos completando lecciones y aprobando quizzes
- **Comentarios y Reseñas**: Participa en discusiones de cada lección
- **Certificados**: Obtén certificados al completar lecciones
- **Notificaciones**: Recibe actualizaciones sobre tus lecciones

### 👨‍🏫 Para Profesores
- **Gestión de Lecciones**: Crear, editar y eliminar lecciones
- **Creación de Quizzes**: Agregar quizzes con preguntas al crear lecciones
- **Dashboard Personalizado**: Vista general de todas tus lecciones
- **Gestión de Contenido**: Control completo sobre el contenido educativo

### 🎯 Características del Sistema
- **8 Categorías**: Web, Frameworks, Databases, Algorithms, DevOps, Security, Mobile, ML
- **21 Lecciones Precargadas**: Con quizzes completos listos para usar
- **Autenticación Completa**: Sistema de login con roles (estudiante/profesor)
- **Diseño Responsivo**: Interfaz moderna con Tailwind CSS
- **Sistema de Inscripción**: Los estudiantes se inscriben en las lecciones que les interesan

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Base de Datos**: SQLite (fácilmente cambiable a MySQL/PostgreSQL)
- **Autenticación**: Laravel Breeze
- **Assets**: Vite

## 📋 Requisitos Previos

- PHP 8.2 o superior
- Composer
- Node.js y NPM
- SQLite (o MySQL/PostgreSQL)

## 🚀 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/bytedeveloopers/cautious-enigma.git
cd cautious-enigma
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node**
```bash
npm install
```

4. **Crear archivo de configuración**
```bash
cp .env.example .env
```

5. **Generar key de aplicación**
```bash
php artisan key:generate
```

6. **Configurar base de datos**
Edita el archivo `.env` y configura tu base de datos. Por defecto usa SQLite:
```env
DB_CONNECTION=sqlite
```

7. **Ejecutar migraciones y seeders**
```bash
php artisan migrate:fresh --seed
```

Esto creará:
- 2 usuarios de prueba (estudiante y profesor)
- 8 categorías
- 21 lecciones con quizzes completos

8. **Compilar assets**
```bash
npm run build
```

9. **Iniciar servidor de desarrollo**
```bash
php artisan serve
```

10. **Acceder a la aplicación**
Abre tu navegador en `http://127.0.0.1:8000`

## 👥 Usuarios de Prueba

Después de ejecutar los seeders, puedes usar estas credenciales:

**Estudiante:**
- Email: `estudiante@lms.com`
- Password: `password`

**Profesor:**
- Email: `profesor@lms.com`
- Password: `password`

## 📁 Estructura del Proyecto

```
lms-simple/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── LessonController.php
│   │   ├── QuizController.php
│   │   └── Teacher/TeacherLessonController.php
│   └── Models/
│       ├── Lesson.php
│       ├── Quiz.php
│       ├── QuizQuestion.php
│       ├── QuizAnswer.php
│       └── QuizAttempt.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CompleteLessonsWithQuizzesSeeder.php
│       └── CategorySeeder.php
├── resources/
│   └── views/
│       ├── lessons/
│       ├── quizzes/
│       ├── dashboard/
│       └── teacher/
└── routes/
    └── web.php
```

## 🎮 Uso

### Como Estudiante
1. Regístrate o inicia sesión
2. Explora el catálogo de lecciones
3. Inscríbete en las lecciones que te interesen
4. Ve los videos y completa los quizzes
5. Compite en el ranking global

### Como Profesor
1. Inicia sesión con cuenta de profesor
2. Accede al dashboard de profesor
3. Crea nuevas lecciones con videos
4. Agrega quizzes con 4 preguntas y 3 respuestas cada una
5. Gestiona tus lecciones existentes

## 🏆 Sistema de Puntuación

El ranking se calcula con la siguiente fórmula:
```
Puntuación Total = total_points + (completed_lessons × 50) + (passed_quizzes × 100)
```

- **Puntos por lección**: Variable según la lección (25-100 puntos)
- **Bonus por lección completada**: 50 puntos
- **Bonus por quiz aprobado**: 100 puntos

## 🎯 Sistema de Quizzes

- **4 preguntas** por quiz
- **3 opciones** de respuesta por pregunta
- **25 puntos** por pregunta correcta (100 puntos total)
- **75%** nota mínima para aprobar
- **3 intentos** máximo por quiz
- **Calificación automática** con feedback detallado

## 📝 Funcionalidades Adicionales

- ✅ Sistema de comentarios en lecciones
- ✅ Sistema de reseñas con estrellas
- ✅ Notificaciones para estudiantes
- ✅ Certificados de finalización
- ✅ Progreso de lecciones
- ✅ Historial de intentos de quizzes
- ✅ Dashboard personalizado por rol

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 👨‍💻 Autor

Desarrollado por ByteDevelopers

## 🐛 Reportar Bugs

Si encuentras algún bug, por favor abre un issue en GitHub con:
- Descripción del problema
- Pasos para reproducirlo
- Comportamiento esperado
- Screenshots (si aplica)

## 🚀 Deploy to Vercel

- Create project in Vercel and import this repo.
- Set Environment Variables:
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_URL=https://<your-vercel-domain>`
  - `APP_KEY=<php artisan key:generate --show>`
  - (Option A) `DATABASE_URL=postgres://user:pass@host:5432/dbname`
  - (Option B) `DB_CONNECTION=pgsql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- First-time migrations should be run locally pointing to the remote DB:
  ```bash
  php artisan migrate --force && php artisan db:seed --force
  ```

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
