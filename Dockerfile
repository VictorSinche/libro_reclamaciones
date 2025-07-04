FROM php:8.2-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath zip

# Activar mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Instalar dependencias JS y compilar assets
RUN npm install --legacy-peer-deps && npm run build

# Permisos necesarios para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copiar script de inicio
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

CMD ["/entrypoint.sh"]


# # --------------------------
# # ETAPA BASE: PHP + Extensiones
# # --------------------------
# FROM php:8.2-cli

# # Instalar dependencias del sistema y extensiones necesarias para Laravel
# RUN apt-get update && apt-get install -y \
#     git unzip zip curl \
#     libpng-dev libjpeg-dev libfreetype6-dev \
#     libonig-dev libxml2-dev libzip-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath zip xml \
#     && rm -rf /var/lib/apt/lists/*

# # Instalar Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Instalar Node.js para compilar assets
# RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
#     && apt-get install -y nodejs

# # Establecer directorio de trabajo
# WORKDIR /app

# # Copiar archivos del proyecto
# COPY . .

# # Aumentar límite de memoria para Composer
# ENV COMPOSER_MEMORY_LIMIT=-1

# # Instalar dependencias PHP (sin ejecutar scripts aún)
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# # Copiar .env y modificar DB_CONNECTION para evitar errores durante build
# RUN cp .env.example .env \
#     && sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env \
#     && php artisan key:generate --ansi || echo "⚠️ key:generate falló, probablemente por entorno incompleto (normal en build)"

# # Ejecutar scripts manuales ahora que APP_KEY existe
# RUN php artisan package:discover --ansi || echo "⚠️ package:discover falló"

# # Instalar dependencias JS y compilar assets
# RUN npm install --legacy-peer-deps && npm run build

# # Cache de Laravel
# RUN php artisan config:clear \
#     && php artisan config:cache \
#     && php artisan route:cache \
#     && php artisan view:cache

# # Crear carpetas necesarias con permisos
# RUN mkdir -p storage/app/public bootstrap/cache \
#     && chmod -R 775 storage bootstrap/cache

# # Copiar script de arranque
# COPY entrypoint.sh /entrypoint.sh
# RUN chmod +x /entrypoint.sh

# # Exponer el puerto esperado por Railway
# EXPOSE 8080

# # Iniciar usando el script
# CMD ["/entrypoint.sh"]

