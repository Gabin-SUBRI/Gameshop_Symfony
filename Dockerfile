FROM php:8.4-cli

# cache bust 2026-03-04
WORKDIR /app

RUN apt-get update && apt-get install -y git unzip zip && \
    docker-php-ext-install pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

EXPOSE 8000

CMD php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration && \
    php bin/console doctrine:fixtures:load --no-interaction --append && \
    php -S 0.0.0.0:$PORT -t public