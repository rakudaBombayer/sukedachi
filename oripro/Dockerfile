FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    mariadb-client mariadb-dev \
    zip unzip \
    nodejs npm \
    bash curl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY . .

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

RUN composer install --no-dev --no-interaction --optimize-autoloader \
    && npm install && npm run build

RUN cp .env.example .env \
    && echo "APP_KEY=dummyappkey123456=" >> .env

# ビルド時に .env は使わず Render の環境変数で代替
# chmod やディレクトリ作成だけしておく
RUN mkdir -p storage/framework/cache/data \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["sh", "-c", "php artisan config:clear && php artisan route:clear && php artisan cache:clear && php artisan serve --host=0.0.0.0 --port=9000"]
