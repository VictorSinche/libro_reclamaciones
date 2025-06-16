FROM php:8.2-cli

ENV COMPOSER_MEMORY_LIMIT=-1 \
    PHP_MEMORY_LIMIT=512M \
    # evita preguntas de npm
    CI=1     

# … (apt y extensiones idénticas a las que ya tienes)

WORKDIR /app
COPY . .

# 1️⃣ Entorno mínimo
RUN cp .env.example .env \
    && php -r "file_exists('.env') ?: copy('.env.example', '.env');" \
    && php artisan key:generate --ansi \
    && sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env

# 2️⃣ Composer sin scripts
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Ejecutamos los scripts manualmente (ya con APP_KEY y sin tocar la BD)
RUN php artisan package:discover --ansi

# 3️⃣ Frontend
RUN npm ci --silent && npm run build

# 4️⃣ Cache de Laravel (opcional)
RUN php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# permisos
RUN mkdir -p storage/app/public bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache
