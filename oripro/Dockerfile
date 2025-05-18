FROM php:8.3-fpm-alpine

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションのソースコードをコピー
COPY . /var/www

# GD 拡張機能に必要な Alpine パッケージをインストール
RUN apk add --no-cache --update libpng-dev libjpeg-turbo-dev freetype-dev

# GD 拡張機能の設定
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# 必要な PHP 拡張機能をすべてインストール
RUN docker-php-ext-install -j$(nproc) gd

# Composer をインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 必要な Alpine パッケージをインストール (zip/unzip)
RUN apk add --no-cache zip unzip

# Laravel アプリケーションに必要な権限を設定
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# ポート 9000 を公開 (PHP-FPM のデフォルトポート)
EXPOSE 9000

# コンテナ起動時のデフォルトコマンド
CMD ["php-fpm"]