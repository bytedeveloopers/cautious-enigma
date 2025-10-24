@echo off
echo 🚀 Preparando deployment para Hostinger...
echo.

REM 1. Limpiar caché local
echo 🧹 Limpiando caché local...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

REM 2. Compilar assets
echo 📦 Compilando assets para producción...
call npm run build

REM 3. Optimizar autoload
echo ⚡ Optimizando autoload...
call composer dump-autoload --optimize

echo.
echo ✅ Proyecto preparado para deployment
echo.
echo 📤 Siguiente paso:
echo 1. Comprime el proyecto manualmente (excluye: node_modules, .git, storage/logs)
echo 2. Sube el ZIP a Hostinger via FTP
echo 3. Descomprime en /public_html/tu-proyecto/
echo 4. Sigue las instrucciones en DEPLOYMENT.md
echo.
pause
