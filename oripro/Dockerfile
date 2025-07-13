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

# RUN touch .env && echo "APP_KEY=dummyappkey123456=" >> .env



RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer



# 🔁 必要ファイルだけ順番にコピー
COPY composer.json composer.lock ./
COPY package.json vite.config.js ./
COPY resources/ resources/
COPY public/ public/
COPY bootstrap/ bootstrap/
COPY tailwind.config.js ./

# アプリ全体コピー（残りのファイル）
COPY . .

ENV APP_ENV=production

RUN composer install --no-dev --no-interaction --optimize-autoloader \
    && npm install && npm run build



# 権限設定
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

RUN php artisan storage:link

# RUN php artisan config:cache \
#     && php artisan route:cache \
#     && php artisan view:cacheｃ



# Dockerfile に追加（php.ini 設定）
RUN echo "upload_max_filesize=50M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=50M" >> /usr/local/etc/php/conf.d/uploads.ini

# ビルド時に .env は使わず Render の環境変数で代替
# chmod やディレクトリ作成だけしておく
RUN mkdir -p storage/framework/cache/data \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
# 本番サーバでは php-fpm を起動（←ここが大事！）
# CMD ["php-fpm"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

