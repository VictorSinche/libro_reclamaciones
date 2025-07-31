FROM php:8.2-apache

# 📦 Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev nodejs npm netcat-openbsd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd mbstring exif pcntl bcmath zip

# 🔁 Activar mod_rewrite de Apache
RUN a2enmod rewrite

# 🔧 Establecer el DOCUMENT_ROOT en /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# 🔁 Reconfigurar Apache para usar /public como DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# ❗ Evitar warning del ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 📁 Establecer directorio de trabajo
WORKDIR /var/www/html

# 📤 Copiar archivos del proyecto
COPY . .

# 🔧 Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 📦 Instalar dependencias PHP (Laravel)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 📦 Instalar dependencias JS y compilar assets (si aplica)
RUN npm install --legacy-peer-deps && npm run build || echo "No build step defined"

# 🔐 Ajustar permisos necesarios para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 🚀 Copiar script de entrada
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# 🌐 Exponer el puerto HTTP
EXPOSE 80

# 🔁 Comando de inicio
CMD ["/entrypoint.sh"]
