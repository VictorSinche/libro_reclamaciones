# --------------------------
# ETAPA BASE: PHP + Extensiones
# --------------------------
FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js para compilar assets
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias PHP y JS
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && npm install && npm run build

# --------------------------
# PERMISOS Y ENLACES
# --------------------------

# Crear carpetas necesarias con permisos
RUN mkdir -p storage/app/public \
    && chmod -R 775 storage bootstrap/cache

# --------------------------
# ENTRYPOINT y SERVIDOR
# --------------------------

# Copiar el script de arranque
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exponer el puerto esperado por Railway
EXPOSE 8080

# Iniciar usando el script
CMD ["/entrypoint.sh"]
