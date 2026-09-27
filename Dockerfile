# Usamos la imagen oficial de PHP con servidor Apache
FROM php:8.2-apache

# Instalamos dependencias del sistema y librerías necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitamos el módulo mod_rewrite de Apache para las rutas de Laravel
RUN a2enmod rewrite

# Instalamos Composer de forma oficial dentro del contenedor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definimos el directorio de trabajo dentro del servidor
WORKDIR /var/www/html

# Copiamos todo el código de tu proyecto al servidor
COPY . .

# Configuramos Apache para que apunte directamente a la carpeta public/ de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Damos permisos a las carpetas de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalamos dependencias de Composer y optimizamos el proyecto
RUN composer install --no-dev --optimize-autoloader

# Damos permisos de ejecución al script build.sh y ejecutamos comandos iniciales
RUN chmod +x build.sh

# Exponemos el puerto 80 estándar
EXPOSE 80

# Comando para iniciar Apache y ejecutar migraciones
CMD php artisan config:cache && php artisan route:cache && php artisan migrate --force && apache2-foreground