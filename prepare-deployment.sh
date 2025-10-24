#!/bin/bash

echo "🚀 Preparando deployment para Hostinger..."
echo ""

# 1. Limpiar caché local
echo "🧹 Limpiando caché local..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. Compilar assets
echo "📦 Compilando assets para producción..."
npm run build

# 3. Optimizar autoload
echo "⚡ Optimizando autoload..."
composer dump-autoload --optimize

# 4. Crear zip del proyecto
echo "📁 Creando archivo ZIP..."
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
FILENAME="lms-simple-$TIMESTAMP.zip"

# Excluir archivos innecesarios
zip -r $FILENAME . \
  -x "node_modules/*" \
  -x ".git/*" \
  -x "storage/logs/*" \
  -x "storage/framework/cache/*" \
  -x "storage/framework/sessions/*" \
  -x "storage/framework/views/*" \
  -x ".env" \
  -x "*.log" \
  -x ".vercelignore" \
  -x "vercel.json"

echo ""
echo "✅ Archivo creado: $FILENAME"
echo ""
echo "📤 Siguiente paso:"
echo "1. Sube $FILENAME a Hostinger via FTP"
echo "2. Descomprime en /public_html/tu-proyecto/"
echo "3. Sigue las instrucciones en DEPLOYMENT.md"
echo ""
