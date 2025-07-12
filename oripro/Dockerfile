FROM php:8.3-fpm-alpine

# 作業ディレクトリを設定
WORKDIR /var/www


# 必要な Alpine パッケージ（Node.jsあり）
RUN apk add --no-cache \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    mariadb-client mariadb-dev \
    zip unzip \
    nodejs npm \
    bash curl

# PHP 拡張機能の設定とインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Composer をインストール
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Laravelのファイル群をコピー
COPY . .

# Laravel アプリケーションに必要な権限を設定
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Laravel依存をインストール
RUN composer install --no-dev --no-interaction --optimize-autoloader \
    && npm install && npm run build

# キャッシュをクリアするコマンド（Composerの後などに追加）
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear


# ポート 9000 を公開 (PHP-FPM のデフォルトポート)
EXPOSE 9000

# コンテナ起動時のデフォルトコマンドを修正
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]