# 1. Base PHP 8.3 con Apache
FROM php:8.3-apache

# 2. Instalamos dependencias del sistema, librerías de PostgreSQL y Node.js
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql

# 3. Habilitamos el módulo mod_rewrite de Apache
RUN a2enmod rewrite

# 4. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Directorio de trabajo
WORKDIR /var/www/html

# 6. Copiamos el código del proyecto
COPY . .

# 7. Configuramos la carpeta pública de Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Asignamos permisos de lectura/escritura a Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Instalamos dependencias de PHP (Composer)
RUN composer install --no-dev --optimize-autoloader

# 10. Instalamos dependencias de Node.js y compilamos Vite
RUN npm install && npm run build

# 11. Damos permisos al script de inicio
RUN chmod +x build.sh

EXPOSE 80

# 12. Comando de arranque del servidor y migraciones
CMD php artisan config:clear && php artisan config:cache && php artisan route:cache && php artisan migrate --force && apache2-foreground