@extends('layouts.app')

@section('title', 'Registrarse - LMS Simple')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-primary-600 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Crear Cuenta</h2>
            <p class="mt-2 text-gray-600">Únete a nuestra plataforma de aprendizaje</p>
        </div>
        
        <div class="card p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="form-label">
                        <i class="fas fa-user mr-2 text-gray-400"></i>
                        Nombre Completo
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        autocomplete="name" 
                        required 
                        class="input-field @error('name') border-red-500 @enderror"
                        placeholder="Tu nombre completo"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                        Correo Electrónico
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required 
                        class="input-field @error('email') border-red-500 @enderror"
                        placeholder="tu@email.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="form-label">
                        <i class="fas fa-user-tag mr-2 text-gray-400"></i>
                        Tipo de Usuario
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <input 
                                id="role-student" 
                                name="role" 
                                type="radio" 
                                value="student" 
                                class="hidden"
                                {{ old('role') == 'student' ? 'checked' : '' }}
                            >
                            <label 
                                for="role-student" 
                                class="block cursor-pointer border-2 border-gray-200 rounded-lg p-4 text-center hover:border-primary-300 transition duration-200 role-option"
                            >
                                <i class="fas fa-user-graduate text-3xl text-gray-400 mb-2"></i>
                                <div class="font-medium text-gray-900">Estudiante</div>
                                <div class="text-sm text-gray-500">Acceso a cursos</div>
                            </label>
                        </div>
                        
                        <div class="relative">
                            <input 
                                id="role-teacher" 
                                name="role" 
                                type="radio" 
                                value="teacher" 
                                class="hidden"
                                {{ old('role') == 'teacher' ? 'checked' : '' }}
                            >
                            <label 
                                for="role-teacher" 
                                class="block cursor-pointer border-2 border-gray-200 rounded-lg p-4 text-center hover:border-primary-300 transition duration-200 role-option"
                            >
                                <i class="fas fa-chalkboard-teacher text-3xl text-gray-400 mb-2"></i>
                                <div class="font-medium text-gray-900">Profesor</div>
                                <div class="text-sm text-gray-500">Crear cursos</div>
                            </label>
                        </div>
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="form-label">
                        <i class="fas fa-lock mr-2 text-gray-400"></i>
                        Contraseña
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password" 
                            required 
                            class="input-field @error('password') border-red-500 @enderror pr-10"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('password')"
                        >
                            <i id="password-icon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock mr-2 text-gray-400"></i>
                        Confirmar Contraseña
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password" 
                            required 
                            class="input-field pr-10"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('password_confirmation')"
                        >
                            <i id="password_confirmation-icon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full btn-primary py-3 text-lg font-semibold"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Cuenta
                    </button>
                </div>
                
                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500 font-medium transition duration-200">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Role selection functionality
document.addEventListener('DOMContentLoaded', function() {
    const roleOptions = document.querySelectorAll('.role-option');
    const radioInputs = document.querySelectorAll('input[name="role"]');
    
    roleOptions.forEach((option, index) => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            roleOptions.forEach(opt => {
                opt.classList.remove('border-primary-500', 'bg-primary-50');
                opt.classList.add('border-gray-200');
            });
            
            // Add active class to selected option
            this.classList.remove('border-gray-200');
            this.classList.add('border-primary-500', 'bg-primary-50');
            
            // Check the corresponding radio input
            radioInputs[index].checked = true;
        });
    });
    
    // Initialize with selected value
    radioInputs.forEach((input, index) => {
        if (input.checked) {
            roleOptions[index].classList.remove('border-gray-200');
            roleOptions[index].classList.add('border-primary-500', 'bg-primary-50');
        }
    });
});

function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const passwordIcon = document.getElementById(fieldId + '-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
</script>
@endsection