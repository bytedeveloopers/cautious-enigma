# 🚀 Guía de Deployment - LMS Simple en Hostinger

## 📋 Pre-requisitos

- Cuenta de Hostinger con acceso a hosting PHP
- Acceso FTP/SFTP o File Manager
- Base de datos MySQL creada en el panel de Hostinger
- PHP 8.2 o superior
- Composer instalado en el servidor (o acceso SSH)

---

## 🗂️ Paso 1: Preparar archivos localmente

### 1.1 Generar APP_KEY
```bash
php artisan key:generate --show
```
Copia la key generada (ejemplo: `base64:xxxxx...`)

### 1.2 Compilar assets para producción
```bash
npm run build
```
Esto genera los archivos CSS/JS optimizados en `public/build/`

### 1.3 Crear archivo .env
Copia `.env.example` a `.env` y configura:

```env
APP_NAME="LMS Simple"
APP_ENV=production
APP_KEY=base64:TU_KEY_GENERADA_AQUI
APP_DEBUG=false
APP_URL=https://tu-dominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nombre_db_hostinger
DB_USERNAME=usuario_db_hostinger
DB_PASSWORD=password_db_hostinger

SESSION_DRIVER=cookie
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=single
```

---

## 📤 Paso 2: Subir archivos al servidor

### Opción A: Via FTP/SFTP (Recomendado)

**Archivos a subir:**
- ✅ Todo el contenido del proyecto
- ❌ **NO subir:** `node_modules/`, `.git/`, `storage/logs/`, `storage/framework/cache/`

**Estructura en el servidor:**
```
/public_html/
├── tu-proyecto/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   ├── artisan
│   ├── composer.json
│   └── ...
```

### Opción B: Via Git (Si tienes acceso SSH)

```bash
cd /home/usuario/public_html
git clone https://github.com/bytedeveloopers/cautious-enigma.git tu-proyecto
cd tu-proyecto
```

---

## 🔧 Paso 3: Configurar el servidor

### 3.1 Instalar dependencias de Composer

**Si tienes acceso SSH:**
```bash
cd /home/usuario/public_html/tu-proyecto
composer install --no-dev --optimize-autoloader
```

**Si NO tienes SSH:**
- Sube también la carpeta `vendor/` completa desde tu máquina local

### 3.2 Configurar permisos

```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework/sessions
chmod -R 775 storage/framework/views
chmod -R 775 storage/framework/cache
```

### 3.3 Configurar Document Root

En el panel de Hostinger:
1. Ve a **Website Settings**
2. Busca **Document Root** o **Public Directory**
3. Cambia a: `/public_html/tu-proyecto/public`

**Si no puedes cambiar el Document Root:**
- Mueve el contenido de `public/` a `/public_html/`
- Edita `/public_html/index.php` y cambia las rutas:

```php
<?php
require __DIR__.'/../tu-proyecto/bootstrap/app.php';
```

---

## 🗄️ Paso 4: Configurar Base de Datos

### 4.1 Crear base de datos en Hostinger

1. Panel de Hostinger → **MySQL Databases**
2. Crear nueva base de datos
3. Anotar: nombre DB, usuario, password, host

### 4.2 Ejecutar migraciones

**Via SSH:**
```bash
cd /home/usuario/public_html/tu-proyecto
php artisan migrate --force
```

**Via phpMyAdmin:**
- Importa manualmente los SQL desde `database/migrations/`

### 4.3 Poblar datos iniciales (seeders)

```bash
php artisan db:seed --force
```

Esto crea:
- ✅ Usuarios de prueba (admin/teacher/student)
- ✅ 21 lecciones de programación
- ✅ 84 preguntas de quiz
- ✅ 252 respuestas

---

## 🔐 Paso 5: Optimizaciones de Producción

```bash
# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache

# Optimizar autoload
composer dump-autoload --optimize --no-dev
```

---

## ✅ Paso 6: Verificación

### 6.1 Verificar que funciona
Visita: `https://tu-dominio.com`

Deberías ver la página de inicio del LMS

### 6.2 Credenciales de prueba

**Admin:**
- Email: `admin@lms.com`
- Password: `password`

**Profesor:**
- Email: `teacher@lms.com`
- Password: `password`

**Estudiante:**
- Email: `student@lms.com`
- Password: `password`

### 6.3 Verificar funcionalidades
- ✅ Login/Registro
- ✅ Ver lecciones (21 disponibles)
- ✅ Tomar quizzes (4 preguntas, 3 respuestas)
- ✅ Ver ranking de estudiantes
- ✅ Panel de profesor (CRUD lecciones)

---

## 🐛 Troubleshooting

### Error 500
```bash
# Ver logs de Laravel
tail -f storage/logs/laravel.log

# Verificar permisos
ls -la storage/
```

### "No application encryption key"
```bash
php artisan key:generate
```

### Assets no cargan (CSS/JS)
- Verifica que `public/build/` exista y tenga archivos
- Revisa `APP_URL` en `.env`

### Errores de base de datos
- Verifica credenciales en `.env`
- Confirma que el host sea `localhost` (no `127.0.0.1`)
- Verifica que el usuario tenga permisos en la DB

### Session issues
```bash
# Limpiar sesiones
php artisan session:clear
```

---

## 📞 Soporte

Si tienes problemas:
1. Revisa `storage/logs/laravel.log`
2. Verifica archivo `.env`
3. Confirma permisos de `storage/`
4. Verifica que PHP >= 8.2

---

## 🎉 ¡Listo!

Tu LMS está ahora en producción con:
- ✅ 21 lecciones de programación
- ✅ Sistema de quizzes (4 preguntas, 3 respuestas)
- ✅ Ranking de estudiantes
- ✅ Panel de administración para profesores
- ✅ Sistema de puntos y progreso

**URL del proyecto:** https://tu-dominio.com
**Repositorio:** https://github.com/bytedeveloopers/cautious-enigma
