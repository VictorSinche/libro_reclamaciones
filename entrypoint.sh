#!/bin/bash

echo "📦 Iniciando contenedor Laravel..."

# Verifica permisos
echo "🔐 Ajustando permisos..."
chmod -R 775 storage bootstrap/cache

# Crear symlink storage si no existe
if [ ! -L "public/storage" ]; then
    echo "🔗 Enlace simbólico 'public/storage' no encontrado. Creando..."
    php artisan storage:link || echo "⚠️  No se pudo crear el enlace simbólico (puede que ya exista o esté restringido)."
else
    echo "✅ Enlace simbólico 'public/storage' ya existe."
fi

echo "🧹 Limpiando cachés de Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Mostrar logs de Laravel
touch storage/logs/laravel.log
tail -f storage/logs/laravel.log &

echo "🚀 Ejecutando servidor Laravel en el puerto 8080..."
php -S 0.0.0.0:8080 -t public
