@extends('layouts.app')

@section('title', 'Dashboard Profesor - LMS Simple')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard del Profesor</h1>
                <p class="mt-2 text-gray-600">Bienvenido de vuelta, {{ auth()->user()->name }}!</p>
            </div>
            <div>
                <a href="{{ route('teacher.lessons.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Nueva Lección
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Lessons -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Lecciones</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalLessons }}</p>
                </div>
            </div>
        </div>

        <!-- Total Students -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-graduate text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Estudiantes</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>

        <!-- Enrollment Rate -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tasa de Inscripción</p>
                    <p class="text-2xl font-bold text-gray-900">85%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Lessons -->
    <div class="card">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Mis Lecciones</h3>
        </div>
        
        @if($lessons->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lección
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duración
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estudiantes
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Creada
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lessons as $lesson)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-play text-primary-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $lesson->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($lesson->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $lesson->duration ?? 'N/A' }} min</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $lesson->enrolledStudents->count() }} inscritos
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $lesson->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('lessons.show', $lesson->id) }}" 
                                       class="text-primary-600 hover:text-primary-900" 
                                       title="Ver lección">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-900"
                                       title="Editar lección">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta lección?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900"
                                                title="Eliminar lección">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $lessons->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay lecciones</h3>
                <p class="text-gray-500 mb-4">Comienza creando tu primera lección para tus estudiantes.</p>
                <a href="{{ route('teacher.lessons.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Primera Lección
                </a>
            </div>
        @endif
    </div>
</div>
@endsection