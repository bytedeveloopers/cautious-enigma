@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Results Header -->
        <div class="text-center mb-8">
            @if($attempt->score >= 75)
                <div class="mb-4">
                    <i class="fas fa-trophy text-8xl text-yellow-500 animate-bounce"></i>
                </div>
                <h1 class="text-4xl font-bold text-green-600 mb-2">¡Felicidades! 🎉</h1>
                <p class="text-xl text-gray-700">Has aprobado el quiz</p>
            @else
                <div class="mb-4">
                    <i class="fas fa-sad-tear text-8xl text-gray-400"></i>
                </div>
                <h1 class="text-4xl font-bold text-red-600 mb-2">No aprobaste esta vez</h1>
                <p class="text-xl text-gray-700">¡Sigue intentando!</p>
            @endif
        </div>

        <!-- Score Card -->
        <div class="bg-white rounded-lg shadow-xl p-8 mb-8">
            <div class="text-center mb-8">
                <p class="text-gray-600 mb-2">Tu Puntuación</p>
                <div class="relative inline-block">
                    <svg class="transform -rotate-90 w-48 h-48">
                        <circle cx="96" cy="96" r="88" stroke="#e5e7eb" stroke-width="16" fill="none" />
                        <circle 
                            cx="96" 
                            cy="96" 
                            r="88" 
                            stroke="{{ $attempt->score >= 75 ? '#10b981' : '#ef4444' }}" 
                            stroke-width="16" 
                            fill="none"
                            stroke-dasharray="{{ 2 * 3.14159 * 88 }}"
                            stroke-dashoffset="{{ 2 * 3.14159 * 88 * (1 - $attempt->score / 100) }}"
                            class="transition-all duration-1000"
                        />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-5xl font-bold {{ $attempt->score >= 75 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $attempt->score }}%
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <i class="fas fa-check-circle text-3xl text-blue-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Correctas</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $attempt->correct_answers }}
                    </p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <i class="fas fa-times-circle text-3xl text-red-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Incorrectas</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $attempt->total_questions - $attempt->correct_answers }}
                    </p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <i class="fas fa-star text-3xl text-purple-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Calificación</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $attempt->grade }}</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <i class="fas fa-clock text-3xl text-green-600 mb-2"></i>
                    <p class="text-sm text-gray-600">Tiempo</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $attempt->time_taken ? gmdate('i:s', $attempt->time_taken) : 'N/A' }}
                    </p>
                </div>
            </div>

            @if($attempt->score >= 75)
                <div class="bg-green-50 border-l-4 border-green-400 p-4">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                        <div>
                            <h3 class="text-sm font-medium text-green-800">¡Aprobado!</h3>
                            <p class="mt-1 text-sm text-green-700">
                                Has alcanzado la nota mínima requerida de 75%. 
                                @if($attempt->quiz->lesson->points)
                                    Has ganado {{ $attempt->quiz->lesson->points }} puntos.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <i class="fas fa-times-circle text-red-600 mt-1 mr-3"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">No aprobado</h3>
                            <p class="mt-1 text-sm text-red-700">
                                Necesitas al menos 75% para aprobar. Obtuviste {{ $attempt->score }}%.
                                @php
                                    $attemptCount = $attempt->quiz->userAttempts(auth()->id())->count();
                                @endphp
                                @if($attemptCount < 3)
                                    Te quedan {{ 3 - $attemptCount }} intento(s).
                                @else
                                    Has alcanzado el límite de intentos.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Question Review -->
        <div class="bg-white rounded-lg shadow-xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                <i class="fas fa-list-check mr-2"></i>
                Revisión de Respuestas
            </h2>

            @foreach($attempt->quiz->questions as $index => $question)
                @php
                    $questionData = collect($attempt->answers)->firstWhere('question_id', $question->id);
                    $userAnswerId = $questionData['user_answer_id'] ?? null;
                    $isCorrect = $questionData['is_correct'] ?? false;
                    $correctAnswer = $question->answers->where('is_correct', true)->first();
                    $userAnswer = $question->answers->where('id', $userAnswerId)->first();
                @endphp

                <div class="mb-6 p-6 border-2 {{ $isCorrect ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }} rounded-lg">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 w-10 h-10 {{ $isCorrect ? 'bg-green-500' : 'bg-red-500' }} text-white rounded-full flex items-center justify-center font-bold mr-4">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $question->question }}</h3>
                            <div class="flex items-center">
                                @if($isCorrect)
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-check-circle mr-1"></i> Correcta
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-times-circle mr-1"></i> Incorrecta
                                    </span>
                                @endif
                                <span class="ml-3 text-sm text-gray-600">{{ $question->points }} puntos</span>
                            </div>
                        </div>
                    </div>

                    <div class="ml-14 space-y-2">
                        @foreach($question->answers as $answer)
                            <div class="p-3 rounded-lg border-2
                                {{ $answer->is_correct ? 'border-green-400 bg-green-100' : '' }}
                                {{ $answer->id == $userAnswerId && !$answer->is_correct ? 'border-red-400 bg-red-100' : '' }}
                                {{ $answer->id != $userAnswerId && !$answer->is_correct ? 'border-gray-200 bg-gray-50' : '' }}
                            ">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-800 font-medium">{{ $answer->answer }}</span>
                                    <div class="flex items-center gap-2">
                                        @if($answer->id == $userAnswerId)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                                Tu respuesta
                                            </span>
                                        @endif
                                        @if($answer->is_correct)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">
                                                <i class="fas fa-check mr-1"></i> Correcta
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <a href="{{ route('lessons.show', $attempt->quiz->lesson->id) }}" 
               class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a la lección
            </a>
            
            @if($attempt->quiz->canUserAttempt(auth()->id()))
                <a href="{{ route('quizzes.show', $attempt->quiz->lesson->id) }}" 
                   class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-center">
                    <i class="fas fa-redo mr-2"></i>
                    Intentar de nuevo
                </a>
            @endif
        </div>

    </div>
</div>
@endsection
