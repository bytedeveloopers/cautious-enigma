# Sistema de Quizzes y Ranking - LMS

## 🎯 Características Implementadas

### ✅ Sistema de Quizzes Completo

#### Estructura:
- **4 preguntas por quiz** (cada una vale 25 puntos = 100 total)
- **3 opciones de respuesta por pregunta** (1 correcta, 2 incorrectas)
- **Múltiples intentos** (configurable, por defecto 3 intentos)
- **Puntaje mínimo para aprobar**: 75%
- **Tracking de tiempo** de realización del quiz

#### Funcionalidades:
✨ Los estudiantes pueden:
- Ver el quiz de cada lección
- Iniciar un intento
- Responder las 4 preguntas
- Ver sus resultados detallados
- Ver intentos anteriores
- Ver su mejor puntaje

✨ El sistema registra:
- Score (0-100)
- Respuestas correctas/incorrectas
- Tiempo empleado
- Si aprobó o no
- Todas las respuestas del usuario

---

### 🏆 Sistema de Ranking

#### Cálculo del Ranking:
```
Ranking Score = (Puntos Totales) + 
                (Lecciones Completadas × 50) + 
                (Quizzes Aprobados × 100)
```

#### Métricas del Estudiante:
- **Puntos totales** acumulados
- **Lecciones completadas**
- **Quizzes aprobados** (cuenta solo una vez aunque lo tome varias veces)
- **Promedio de score** en quizzes
- **Posición en el ranking**

#### Leaderboard:
- Top 50 estudiantes
- Ordenados por puntos → lecciones completadas
- Muestra: nombre, puntos, lecciones, quizzes, nivel
- Posición actual del usuario
- Actualización en tiempo real

---

### 📚 20 Lecciones Creadas

Lecciones organizadas por categorías:

#### **Programación Web** (1)
1. Introducción a HTML5 - Beginner (50 pts)
2. CSS3: Estilos y Diseño - Beginner (50 pts)
3. JavaScript Básico - Beginner (75 pts)
4. Python para Principiantes - Beginner (120 min)
5. TypeScript: JavaScript con Tipos - Intermediate (75 min)
6. API REST: Diseño y Buenas Prácticas - Intermediate (95 min)
7. Testing: Unit y Integration Tests - Intermediate (85 min)

#### **Frameworks** (4)
8. React: Componentes y Props - Intermediate (100 pts)
9. Vue.js Esencial - Intermediate (100 pts)
10. Node.js y Express - Intermediate (100 pts)
11. Laravel: Framework PHP Moderno - Intermediate (130 min)

#### **Bases de Datos** (2)
12. SQL Fundamentos - Beginner (75 pts)
13. MySQL Avanzado - Intermediate (100 pts)
14. MongoDB: NoSQL Database - Intermediate (100 pts)

#### **Algoritmos** (3)
15. Estructuras de Datos Básicas - Intermediate (100 pts)
16. Algoritmos de Ordenamiento - Intermediate (100 pts)

#### **DevOps** (5)
17. Git y Control de Versiones - Beginner (50 pts)
18. Docker Básico - Intermediate (100 pts)

#### **Seguridad** (6)
19. Seguridad Web Básica - Intermediate (100 pts)

#### **Machine Learning** (8)
20. GraphQL: API del Futuro - Advanced (125 pts)
21. Machine Learning con Python - Advanced (150 pts)

---

## 🗄️ Base de Datos

### Nuevas Tablas:

#### `quizzes`
- lesson_id (relación 1:1 con lecciones)
- title, description
- passing_score (default: 75)
- time_limit (opcional)
- max_attempts (default: 3)
- is_active

#### `quiz_questions`
- quiz_id
- question (texto)
- points (default: 25)
- order

#### `quiz_answers`
- question_id
- answer (texto)
- is_correct (boolean)
- order

#### `quiz_attempts`
- quiz_id, user_id
- score (0-100)
- correct_answers
- total_questions
- passed (boolean)
- started_at, completed_at
- time_spent (segundos)
- answers (JSON con todas las respuestas)

#### Campos añadidos a `lesson_enrollments`:
- quiz_passed
- quiz_score
- quiz_attempts

---

## 🎮 Flujo de Usuario

### Para Estudiantes:

1. **Ver Lección** → Ver contenido y video
2. **Tomar Quiz** → Botón para iniciar quiz
3. **Responder** → 4 preguntas de opción múltiple
4. **Ver Resultado** → Score, grado (A-F), respuestas correctas/incorrectas
5. **Reintentar** → Si no aprobó y tiene intentos disponibles
6. **Ver Ranking** → Compararse con otros estudiantes

### Reglas:
- ✅ Máximo 3 intentos por quiz
- ✅ Solo el mejor score cuenta
- ✅ Mínimo 75% para aprobar
- ✅ Los puntos se otorgan al aprobar
- ✅ No se pueden cambiar respuestas una vez enviadas

---

## 📊 Modelos Creados

1. **Quiz** - Un quiz por lección
2. **QuizQuestion** - 4 preguntas por quiz
3. **QuizAnswer** - 3 opciones por pregunta
4. **QuizAttempt** - Registro de cada intento

### Relaciones:
```
Lesson → hasOne(Quiz)
Quiz → hasMany(QuizQuestion)
Quiz → hasMany(QuizAttempt)
QuizQuestion → hasMany(QuizAnswer)
QuizAttempt → belongsTo(User)
User → hasMany(QuizAttempt)
```

---

## 🎯 Controlador y Rutas

### QuizController:
- `show($lessonId)` - Mostrar quiz de una lección
- `start($quizId)` - Iniciar nuevo intento
- `take($attemptId)` - Página para tomar quiz
- `submit($attemptId)` - Enviar respuestas y calificar
- `result($attemptId)` - Ver resultados detallados
- `leaderboard()` - Ver ranking de estudiantes

### Rutas:
```php
GET  /lessons/{lesson}/quiz - Ver quiz
POST /quizzes/{quiz}/start - Iniciar intento
GET  /quiz-attempts/{attempt} - Tomar quiz
POST /quiz-attempts/{attempt}/submit - Enviar respuestas
GET  /quiz-attempts/{attempt}/result - Ver resultado
GET  /leaderboard - Ver ranking
```

---

## 🚀 Instalación

```bash
# 1. Ejecutar migraciones
php artisan migrate

# 2. Poblar base de datos (borra datos anteriores)
php artisan migrate:fresh --seed

# 3. Compilar assets
npm run dev
```

---

## 📈 Características del Quiz

### Calificación Automática:
- ✅ Se calcula el score en base a respuestas correctas
- ✅ Cada pregunta vale 25 puntos
- ✅ Score total: 0-100
- ✅ Grade letters: A (90+), B (80+), C (70+), D (60+), F (<60)

### Estadísticas:
- Mejor intento
- Intentos restantes
- Tiempo empleado
- Respuestas correctas vs incorrectas
- Historial completo de intentos

### Sistema de Puntos:
- Los puntos de la lección se otorgan al aprobar el quiz
- Solo se otorgan una vez (no por cada intento)
- Se acumulan en el perfil del estudiante
- Contribuyen al ranking global

---

## 🎨 Calificaciones con Color

```php
A (90-100) → Verde   ✅ Excelente
B (80-89)  → Azul    💙 Muy Bien
C (70-79)  → Amarillo ⚠️ Bien
D (60-69)  → Naranja  🔶 Suficiente
F (0-59)   → Rojo     ❌ Reprobado
```

---

## 💡 Próximas Mejoras Sugeridas

1. 🎮 **Gamificación**:
   - Badges por logros
   - Streaks (días consecutivos)
   - Retos especiales

2. 📊 **Analytics**:
   - Gráficas de progreso
   - Estadísticas por categoría
   - Comparativa con promedio

3. ⏱️ **Límite de Tiempo**:
   - Quizzes con temporizador
   - Bonus por rapidez

4. 🎯 **Preguntas Dinámicas**:
   - Pool de preguntas aleatorias
   - Dificultad adaptativa

5. 🏅 **Competencias**:
   - Torneos entre estudiantes
   - Premios semanales/mensuales

---

## ✅ Todo Completado

- ✅ Modelos y migraciones
- ✅ 20+ lecciones con videos
- ✅ Quizzes con 4 preguntas c/u
- ✅ 3 opciones por pregunta
- ✅ Sistema de calificación automática
- ✅ Ranking de estudiantes
- ✅ Controladores y rutas
- ✅ Seeder completo
- ✅ Documentación

¡El sistema está listo para usar! 🚀
