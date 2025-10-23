@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $attempt->quiz->lesson->title }}</h1>
                    <p class="text-gray-600 mt-1">Quiz de Evaluación</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Intento en progreso</p>
                    <p class="text-xl font-bold text-primary-600">
                        <i class="fas fa-clock mr-2"></i>{{ $attempt->created_at->format('H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Quiz Form -->
        <form action="{{ route('quizzes.submit', $attempt->id) }}" method="POST" id="quizForm">
            @csrf
            
            <!-- Questions -->
            @foreach($attempt->quiz->questions as $index => $question)
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-xl mr-4">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $question->question }}</h3>
                        <p class="text-sm text-gray-500">Puntos: {{ $question->points }}</p>
                    </div>
                </div>

                <div class="space-y-3 ml-16">
                    @foreach($question->answers as $answer)
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-400 hover:bg-primary-50 transition duration-200">
                        <input 
                            type="radio" 
                            name="answers[{{ $question->id }}]" 
                            value="{{ $answer->id }}"
                            class="w-5 h-5 text-primary-600 focus:ring-primary-500"
                            required>
                        <span class="ml-3 text-gray-800 font-medium">{{ $answer->answer }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Submit Section -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800">Antes de enviar</h3>
                            <p class="mt-1 text-sm text-yellow-700">
                                Asegúrate de haber respondido todas las preguntas. Una vez enviado, no podrás cambiar tus respuestas.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('lessons.show', $attempt->quiz->lesson->id) }}" 
                       class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-4 px-6 rounded-lg transition duration-200 text-center">
                        <i class="fas fa-times-circle mr-2"></i>
                        Cancelar
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200"
                        onclick="return confirm('¿Estás seguro de enviar tus respuestas? No podrás modificarlas después.')">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Respuestas
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
// Advertir antes de salir de la página
window.addEventListener('beforeunload', function (e) {
    const form = document.getElementById('quizForm');
    if (!form.dataset.submitted) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Marcar como enviado al hacer submit
document.getElementById('quizForm').addEventListener('submit', function() {
    this.dataset.submitted = 'true';
});
</script>
@endsection
