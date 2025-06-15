# --------------------------
# ETAPA 1: Base con PHP + dependencias
# --------------------------
FROM php:8.2-cli

# Instalar librerías del sistema necesarias
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd \
        --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        gd \
        mbstring \
        exif \
        pcntl \
        bcmath \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js (requerido para npm run build)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Establecer directorio de trabajo
WORKDIR /app

# Copiar los archivos del proyecto
COPY . .

# --------------------------
# ETAPA 2: Instalación de dependencias y build
# --------------------------

# Instalar dependencias de PHP y Node
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install \
    && npm run build

# Cachear configuración Laravel
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force \
    && php artisan db:seed --force

# Exponer el puerto 8080
EXPOSE 8080

# --------------------------
# ETAPA 3: Iniciar servidor
# --------------------------

# Servir desde la carpeta /public en el puerto 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
