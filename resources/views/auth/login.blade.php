@extends('layouts.app')

@section('title', 'Iniciar Sesión - LMS Simple')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg">
            
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">¡Bienvenido de vuelta!</h1>
                <p class="text-lg text-gray-600">Accede a tu plataforma de aprendizaje</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">
                    
                    <!-- Demo Credentials Info -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                        <h3 class="text-sm font-semibold text-blue-800 mb-2">
                            <i class="fas fa-info-circle mr-2"></i>Credenciales de Prueba
                        </h3>
                        <div class="text-xs text-blue-700 space-y-1">
                            <p><strong>Profesor:</strong> profesor@lms.com</p>
                            <p><strong>Estudiante:</strong> estudiante@lms.com</p>
                            <p><strong>Contraseña:</strong> password</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Correo Electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    autocomplete="email" 
                                    required 
                                    class="w-full pl-12 pr-4 py-4 border rounded-xl focus:ring-2 transition duration-200 text-gray-900 placeholder-gray-500 {{ $errors->has('email') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                                    placeholder="ejemplo@email.com"
                                    value="{{ old('email') }}"
                                >
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    autocomplete="current-password" 
                                    required 
                                    class="w-full pl-12 pr-12 py-4 border rounded-xl focus:ring-2 transition duration-200 text-gray-900 placeholder-gray-500 {{ $errors->has('password') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' }}"
                                    placeholder="••••••••••"
                                >
                                <button 
                                    type="button" 
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition duration-200"
                                    onclick="togglePassword()"
                                >
                                    <i id="password-icon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input 
                                    id="remember" 
                                    name="remember" 
                                    type="checkbox" 
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200"
                                >
                                <label for="remember" class="ml-3 text-sm text-gray-700 font-medium">
                                    Recordarme
                                </label>
                            </div>
                            
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-indigo-800 transform hover:scale-105 transition duration-200 shadow-lg hover:shadow-xl"
                        >
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Iniciar Sesión
                        </button>
                        
                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500 font-medium">o</span>
                            </div>
                        </div>
                        
                        <!-- Quick Login Buttons -->
                        <div class="grid grid-cols-2 gap-3">
                            <button 
                                type="button" 
                                onclick="quickLogin('profesor@lms.com')"
                                class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200"
                            >
                                <i class="fas fa-chalkboard-teacher mr-2 text-blue-600"></i>
                                Demo Profesor
                            </button>
                            <button 
                                type="button" 
                                onclick="quickLogin('estudiante@lms.com')"
                                class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200"
                            >
                                <i class="fas fa-user-graduate mr-2 text-green-600"></i>
                                Demo Estudiante
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Register Link -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 text-center">
                    <p class="text-gray-600">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200">
                            Regístrate gratis
                        </a>
                    </p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} LMS Simple. Plataforma de aprendizaje moderna.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');
    
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

function quickLogin(email) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = 'password';
    
    // Opcional: Auto-submit después de un pequeño delay
    setTimeout(() => {
        document.querySelector('form').submit();
    }, 500);
}
</script>
@endsection