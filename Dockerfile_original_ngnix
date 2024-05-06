# Usamos la imagen base oficial de PHP 8.2
FROM php:8.1.9-fpm-alpine

# Instalamos las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    supervisor \
    nginx \
    libzip-dev \
    libpng-dev

# Instalamos las extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql zip gd

# Copiamos los archivos de la aplicación Laravel
COPY . /var/www/html

# Instalamos las dependencias de Composer
RUN cd /var/www/html && composer install

# Copiamos el archivo de entorno
COPY .env.example .env

# Limpieza de la caché de Laravel
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear

# Copiamos la configuración de Nginx
COPY nginx/default /etc/nginx/sites-available/default

# Copiamos la configuración de Supervisor
COPY supervisor/* /etc/supervisor/conf.d/

# Asignamos los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage

# Puerto expuesto por Nginx
EXPOSE 80

# Iniciamos los servicios de Nginx y Supervisor
CMD service supervisor start && nginx -g 'daemon off;'