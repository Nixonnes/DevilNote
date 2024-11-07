FROM php:8.3

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN apt-get update && apt-get install -y tzdata
RUN apt-get update && apt-get install -y procps
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app
RUN composer install
RUN composer update

# Запуск Laravel приложения
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8181"]
EXPOSE 8181

LABEL authors="Arthur"
