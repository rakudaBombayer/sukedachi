# ベースイメージの指定
FROM php:8.2-fpm

# 作業ディレクトリの指定
WORKDIR /var/www/html

# Laravelのインストール
COPY composer.json composer.lock ./
RUN composer install

# アプリケーションのコードのコピー
COPY . .