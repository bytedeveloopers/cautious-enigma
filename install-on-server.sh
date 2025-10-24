#!/bin/bash

echo "🔧 Script de instalación en servidor Hostinger"
echo "=============================================="
echo ""

# Verificar que estamos en el directorio correcto
if [ ! -f "artisan" ]; then
    echo "❌ Error: Este script debe ejecutarse desde la raíz del proyecto Laravel"
    exit 1
fi

# 1. Instalar dependencias de Composer
echo "📦 Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

# 2. Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework/sessions
chmod -R 775 storage/framework/views
chmod -R 775 storage/framework/cache

# 3. Verificar archivo .env
if [ ! -f ".env" ]; then
    echo "⚠️  Archivo .env no encontrado"
    echo "📝 Copiando .env.example..."
    cp .env.example .env
    echo "⚠️  IMPORTANTE: Edita .env con tus credenciales antes de continuar"
    echo "   Presiona ENTER cuando hayas configurado .env..."
    read
fi

# 4. Generar APP_KEY si no existe
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate
fi

# 5. Ejecutar migraciones
echo "🗄️  Ejecutando migraciones..."
read -p "¿Deseas ejecutar las migraciones? (s/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[SsYy]$ ]]; then
    php artisan migrate --force
    
    # Preguntar por seeders
    read -p "¿Deseas poblar la base de datos con datos de prueba? (s/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[SsYy]$ ]]; then
        php artisan db:seed --force
    fi
fi

# 6. Optimizaciones de producción
echo "⚡ Aplicando optimizaciones..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ ¡Instalación completada!"
echo ""
echo "🎉 Tu LMS está listo. Credenciales de prueba:"
echo "   Admin: admin@lms.com / password"
echo "   Profesor: teacher@lms.com / password"
echo "   Estudiante: student@lms.com / password"
echo ""
echo "📝 Recuerda configurar el Document Root a: /ruta/a/tu-proyecto/public"
echo ""
