#!/usr/bin/env bash
# exit on error
set -o errexit

echo "--- INICIANDO PROCESO DE CONSTRUCCIÓN EN PRODUCCIÓN ---"

# 1. Instalar dependencias de PHP sin herramientas de desarrollo (más rápido y ligero)
composer install --no-dev --optimize-autoloader

# 2. Limpiar e instalar caché de configuración y rutas en Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Ejecutar las migraciones en la base de datos PostgreSQL de producción
php artisan migrate --force

echo "--- CONSTRUCCIÓN Y MIGRACIÓN COMPLETADAS CON ÉXITO ---"