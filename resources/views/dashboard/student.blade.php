@extends('layouts.app')

@section('title', 'Dashboard Estudiante - LMS Simple')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard del Estudiante</h1>
        <p class="mt-2 text-gray-600">¡Bienvenido de vuelta, {{ auth()->user()->name }}! Continúa tu aprendizaje.</p>
    </div>

    <!-- Progress Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Enrolled Lessons -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book-open text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Lecciones Inscritas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $enrolledLessons->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Lessons -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Lecciones Completadas</p>
                    <p class="text-2xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>

        <!-- Learning Hours -->
        <div class="card p-6">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Horas de Estudio</p>
                    <p class="text-2xl font-bold text-gray-900">0h</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs for different sections -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button class="tab-button active border-b-2 border-primary-500 py-2 px-1 text-primary-600 font-medium text-sm" data-tab="enrolled">
                    Mis Lecciones
                </button>
                <button class="tab-button border-b-2 border-transparent py-2 px-1 text-gray-500 hover:text-gray-700 font-medium text-sm" data-tab="available">
                    Lecciones Disponibles
                </button>
            </nav>
        </div>
    </div>

    <!-- Enrolled Lessons Tab -->
    <div id="enrolled-tab" class="tab-content">
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Mis Lecciones Inscritas</h3>
            </div>
            
            @if($enrolledLessons->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    @foreach($enrolledLessons as $lesson)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-primary-400 to-primary-600">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-play text-white text-3xl"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">{{ $lesson->title }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($lesson->description, 80) }}</p>
                            
                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Progreso</span>
                                    <span>0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-600 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $lesson->duration ?? 'N/A' }} min
                                </span>
                                <a href="{{ route('lessons.show', $lesson->id) }}" class="btn-primary text-sm py-1 px-3">
                                    Continuar
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $enrolledLessons->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-open text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No tienes lecciones inscritas</h3>
                    <p class="text-gray-500 mb-4">Explora las lecciones disponibles y comienza tu aprendizaje.</p>
                    <button class="btn-primary" onclick="switchTab('available')">
                        <i class="fas fa-search mr-2"></i>
                        Explorar Lecciones
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Available Lessons Tab -->
    <div id="available-tab" class="tab-content hidden">
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Lecciones Disponibles</h3>
            </div>
            
            @if($availableLessons->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    @foreach($availableLessons as $lesson)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-400 to-gray-600">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-play text-white text-3xl"></i>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">{{ $lesson->title }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($lesson->description, 80) }}</p>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $lesson->duration ?? 'N/A' }} min
                                </span>
                                @if($lesson->teacher)
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $lesson->teacher->name }}
                                </span>
                                @endif
                            </div>
                            
                            <button 
                                onclick="enrollInLesson({{ $lesson->id }})" 
                                class="w-full btn-primary text-sm py-2"
                                id="enroll-btn-{{ $lesson->id }}"
                            >
                                <i class="fas fa-plus mr-2"></i>
                                Inscribirse
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $availableLessons->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay lecciones disponibles</h3>
                    <p class="text-gray-500">Ya estás inscrito en todas las lecciones disponibles o no hay lecciones creadas aún.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            switchTab(tabName);
        });
    });
});

function switchTab(tabName) {
    // Remove active classes from all buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'border-primary-500', 'text-primary-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Activate selected tab
    const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
    const activeContent = document.getElementById(`${tabName}-tab`);
    
    activeButton.classList.add('active', 'border-primary-500', 'text-primary-600');
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeContent.classList.remove('hidden');
}

// Enrollment functionality
async function enrollInLesson(lessonId) {
    const button = document.getElementById(`enroll-btn-${lessonId}`);
    const originalText = button.innerHTML;
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Inscribiendo...';
    
    try {
        const response = await fetch(`/enroll/${lessonId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (response.ok) {
            // Success
            button.innerHTML = '<i class="fas fa-check mr-2"></i>Inscrito';
            button.classList.remove('btn-primary');
            button.classList.add('bg-green-500', 'hover:bg-green-600');
            
            // Show success message
            showNotification('¡Te has inscrito exitosamente!', 'success');
            
            // Reload page after a short delay
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            // Error
            button.disabled = false;
            button.innerHTML = originalText;
            showNotification(data.error || 'Error al inscribirse', 'error');
        }
    } catch (error) {
        // Network error
        button.disabled = false;
        button.innerHTML = originalText;
        showNotification('Error de conexión', 'error');
    }
}

// Simple notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.classList.add('bg-green-500', 'text-white');
    } else if (type === 'error') {
        notification.classList.add('bg-red-500', 'text-white');
    } else {
        notification.classList.add('bg-blue-500', 'text-white');
    }
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation-triangle' : 'info'} mr-2"></i>
            ${message}
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endsection