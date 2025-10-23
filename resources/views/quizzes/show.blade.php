@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('lessons.show', $lesson->id) }}" class="text-primary-600 hover:text-primary-800 font-medium mb-4 inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a la lección
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mt-4">📝 Quiz: {{ $lesson->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $lesson->description }}</p>
        </div>

        <!-- Quiz Info Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Información del Quiz</h2>
                @if($bestScore !== null)
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Mejor Puntuación</p>
                        <p class="text-3xl font-bold {{ $bestScore >= 75 ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $bestScore }}%
                        </p>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <i class="fas fa-question-circle text-3xl text-blue-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Preguntas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $quiz->questions->count() }}</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4 text-center">
                    <i class="fas fa-clock text-3xl text-green-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Puntos por pregunta</p>
                    <p class="text-2xl font-bold text-gray-900">25</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4 text-center">
                    <i class="fas fa-check-circle text-3xl text-purple-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Nota mínima</p>
                    <p class="text-2xl font-bold text-gray-900">75%</p>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <div class="flex">
                    <i class="fas fa-info-circle text-yellow-600 mt-1 mr-3"></i>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-800">Instrucciones</h3>
                        <ul class="mt-2 text-sm text-yellow-700 list-disc list-inside space-y-1">
                            <li>El quiz tiene {{ $quiz->questions->count() }} preguntas de opción múltiple</li>
                            <li>Cada pregunta vale 25 puntos</li>
                            <li>Necesitas al menos 75% para aprobar</li>
                            <li>Tienes máximo 3 intentos</li>
                            <li>Una vez iniciado, debes completar todas las preguntas</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Start Quiz Button -->
            <form action="{{ route('quizzes.start', $quiz->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-play-circle mr-2 text-2xl"></i>
                    <span class="text-xl">Iniciar Quiz</span>
                </button>
            </form>
        </div>

        <!-- Previous Attempts -->
        @if($previousAttempts->count() > 0)
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">📊 Historial de Intentos</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Intento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntuación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Calificación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($previousAttempts as $index => $attempt)
                        <tr class="{{ $attempt->score >= 75 ? 'bg-green-50' : 'bg-red-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $previousAttempts->count() - $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $attempt->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-2xl font-bold {{ $attempt->score >= 75 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $attempt->score }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $attempt->grade == 'A' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $attempt->grade == 'B' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $attempt->grade == 'C' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $attempt->grade == 'D' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $attempt->grade == 'F' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $attempt->grade }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($attempt->score >= 75)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Aprobado
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Reprobado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('quizzes.result', $attempt->id) }}" 
                                   class="text-primary-600 hover:text-primary-900 font-medium">
                                    <i class="fas fa-eye mr-1"></i> Ver detalles
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">Intentos realizados</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $previousAttempts->count() }} / 3</p>
                    </div>
                    @if($previousAttempts->count() >= 3)
                        <div class="text-right">
                            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-lg font-medium">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Límite de intentos alcanzado
                            </span>
                        </div>
                    @else
                        <div class="text-right">
                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Te quedan {{ 3 - $previousAttempts->count() }} intento(s)
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
