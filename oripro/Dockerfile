FROM php:8.3-fpm-alpine

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションのソースコードをコピー
COPY . /var/www

# 必要な Alpine パッケージをインストール
RUN apk add --no-cache --update libpng-dev libjpeg-turbo-dev freetype-dev mariadb-client mariadb-dev zip unzip

# PHP 拡張機能の設定とインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Composer をインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Laravel アプリケーションに必要な権限を設定
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# ポート 9000 を公開 (PHP-FPM のデフォルトポート)
EXPOSE 9000

# コンテナ起動時のデフォルトコマンドを修正
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]