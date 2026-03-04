FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y git unzip zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

RUN php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || true

EXPOSE 8000

CMD php -S 0.0.0.0:$PORT -t public