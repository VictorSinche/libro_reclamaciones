# Etapa base con PHP, Composer y Node
FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    libcurl4-openssl-dev libssl-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js (opcional para frontend con Laravel Mix o Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install && npm run build

# Cachear configuración
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && php artisan migrate --force \
 && php artisan db:seed --force

# Exponer puerto
EXPOSE 8080

# Comando final
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
