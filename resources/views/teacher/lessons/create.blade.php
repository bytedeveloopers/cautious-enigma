@extends('layouts.app')

@section('title', 'Crear Nueva Lección')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('dashboard.teacher') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Crear Nueva Lección</h1>
        </div>
        <p class="text-gray-600">Completa el formulario para crear una nueva lección para tus estudiantes</p>
    </div>

    <form action="{{ route('teacher.lessons.store') }}" method="POST" class="space-y-6" id="lessonForm">
        @csrf

        <!-- Basic Information -->
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Información Básica</h2>
            
            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <label class="form-label" for="title">Título de la Lección *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="input-field @error('title') border-red-500 @enderror" 
                           required maxlength="255">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="form-label" for="description">Descripción Corta *</label>
                    <textarea id="description" name="description" rows="3" 
                              class="input-field @error('description') border-red-500 @enderror" 
                              required maxlength="1000">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="form-label" for="content">Contenido Completo *</label>
                    <textarea id="content" name="content" rows="8" 
                              class="input-field @error('content') border-red-500 @enderror" 
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div>
                    <label class="form-label" for="video_url">URL del Video (YouTube, Vimeo, etc.)</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" 
                           class="input-field @error('video_url') border-red-500 @enderror"
                           placeholder="https://www.youtube.com/watch?v=...">
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration and Points -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="form-label" for="duration">Duración (minutos) *</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration', 30) }}" 
                               class="input-field @error('duration') border-red-500 @enderror" 
                               required min="1">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="points">Puntos *</label>
                        <input type="number" id="points" name="points" value="{{ old('points', 50) }}" 
                               class="input-field @error('points') border-red-500 @enderror" 
                               required min="0">
                        @error('points')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="difficulty_level">Dificultad *</label>
                        <select id="difficulty_level" name="difficulty_level" 
                                class="input-field @error('difficulty_level') border-red-500 @enderror" required>
                            <option value="beginner" {{ old('difficulty_level') == 'beginner' ? 'selected' : '' }}>Principiante</option>
                            <option value="intermediate" {{ old('difficulty_level') == 'intermediate' ? 'selected' : '' }}>Intermedio</option>
                            <option value="advanced" {{ old('difficulty_level') == 'advanced' ? 'selected' : '' }}>Avanzado</option>
                        </select>
                        @error('difficulty_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <label class="form-label">Categorías</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2">
                        @foreach($categories as $category)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                       class="rounded text-primary-600 mr-2"
                                       {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                <span class="text-sm">{{ $category->icon }} {{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Section -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900">Quiz de Evaluación</h2>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="create_quiz" id="create_quiz" value="1" 
                           class="rounded text-primary-600 mr-2"
                           {{ old('create_quiz') ? 'checked' : '' }}>
                    <span class="text-sm font-medium">Agregar Quiz</span>
                </label>
            </div>

            <div id="quizSection" class="space-y-4" style="display: {{ old('create_quiz') ? 'block' : 'none' }}">
                <!-- Quiz Settings -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="form-label" for="quiz_title">Título del Quiz</label>
                            <input type="text" id="quiz_title" name="quiz_title" 
                                   value="{{ old('quiz_title') }}" 
                                   class="input-field">
                        </div>
                        <div>
                            <label class="form-label" for="passing_score">Puntaje Mínimo (%)</label>
                            <input type="number" id="passing_score" name="passing_score" 
                                   value="{{ old('passing_score', 75) }}" 
                                   class="input-field" min="0" max="100">
                        </div>
                        <div>
                            <label class="form-label" for="max_attempts">Intentos Máximos</label>
                            <input type="number" id="max_attempts" name="max_attempts" 
                                   value="{{ old('max_attempts', 3) }}" 
                                   class="input-field" min="1" max="10">
                        </div>
                    </div>
                </div>

                <!-- Questions (4 questions, 3 answers each) -->
                <div id="questionsContainer">
                    @for($i = 0; $i < 4; $i++)
                        <div class="border border-gray-200 rounded-lg p-4 mb-4">
                            <h4 class="font-medium text-gray-900 mb-3">Pregunta {{ $i + 1 }}</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Pregunta</label>
                                <input type="text" name="questions[{{ $i }}][question]" 
                                       value="{{ old("questions.$i.question") }}"
                                       class="input-field" placeholder="Escribe la pregunta...">
                            </div>

                            <div class="space-y-2">
                                <label class="form-label">Opciones de Respuesta</label>
                                @for($j = 0; $j < 3; $j++)
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="questions[{{ $i }}][correct_answer]" 
                                               value="{{ $j }}" 
                                               {{ old("questions.$i.correct_answer") == $j ? 'checked' : '' }}
                                               class="text-green-600">
                                        <input type="text" name="questions[{{ $i }}][answers][{{ $j }}][text]" 
                                               value="{{ old("questions.$i.answers.$j.text") }}"
                                               class="input-field" 
                                               placeholder="Opción {{ $j + 1 }}">
                                    </div>
                                @endfor
                                <p class="text-xs text-gray-500 mt-1">Selecciona el radio button de la respuesta correcta</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('dashboard.teacher') }}" class="btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i>
                Crear Lección
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const createQuizCheckbox = document.getElementById('create_quiz');
    const quizSection = document.getElementById('quizSection');
    
    createQuizCheckbox.addEventListener('change', function() {
        quizSection.style.display = this.checked ? 'block' : 'none';
    });
});
</script>
@endsection
