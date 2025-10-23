@extends('layouts.app')

@section('title', 'Editar Lección')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('dashboard.teacher') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar Lección</h1>
        </div>
        <p class="text-gray-600">Actualiza la información de tu lección</p>
    </div>

    <form action="{{ route('teacher.lessons.update', $lesson->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Información Básica</h2>
            
            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <label class="form-label" for="title">Título de la Lección *</label>
                    <input type="text" id="title" name="title" 
                           value="{{ old('title', $lesson->title) }}" 
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
                              required maxlength="1000">{{ old('description', $lesson->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="form-label" for="content">Contenido Completo *</label>
                    <textarea id="content" name="content" rows="8" 
                              class="input-field @error('content') border-red-500 @enderror" 
                              required>{{ old('content', $lesson->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div>
                    <label class="form-label" for="video_url">URL del Video (YouTube, Vimeo, etc.)</label>
                    <input type="url" id="video_url" name="video_url" 
                           value="{{ old('video_url', $lesson->video_url) }}" 
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
                        <input type="number" id="duration" name="duration" 
                               value="{{ old('duration', $lesson->duration) }}" 
                               class="input-field @error('duration') border-red-500 @enderror" 
                               required min="1">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label" for="points">Puntos *</label>
                        <input type="number" id="points" name="points" 
                               value="{{ old('points', $lesson->points) }}" 
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
                            <option value="beginner" {{ old('difficulty_level', $lesson->difficulty_level) == 'beginner' ? 'selected' : '' }}>Principiante</option>
                            <option value="intermediate" {{ old('difficulty_level', $lesson->difficulty_level) == 'intermediate' ? 'selected' : '' }}>Intermedio</option>
                            <option value="advanced" {{ old('difficulty_level', $lesson->difficulty_level) == 'advanced' ? 'selected' : '' }}>Avanzado</option>
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
                                       {{ $lesson->categories->contains($category->id) ? 'checked' : '' }}>
                                <span class="text-sm">{{ $category->icon }} {{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if($lesson->quiz)
        <div class="card p-6">
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                <div class="flex">
                    <div class="shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Esta lección tiene un quiz asociado: <strong>{{ $lesson->quiz->title }}</strong>. 
                            Para editarlo, necesitarás gestionarlo desde la sección de quizzes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('dashboard.teacher') }}" class="btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i>
                Actualizar Lección
            </button>
        </div>
    </form>

    <!-- Delete Section -->
    <div class="card p-6 mt-6 border-red-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Zona de Peligro</h3>
        <p class="text-sm text-gray-600 mb-4">
            Una vez que elimines esta lección, no podrá recuperarse. Por favor, ten cuidado.
        </p>
        <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" method="POST" 
              onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta lección? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                <i class="fas fa-trash mr-2"></i>
                Eliminar Lección
            </button>
        </form>
    </div>
</div>
@endsection
