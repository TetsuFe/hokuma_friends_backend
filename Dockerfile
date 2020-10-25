FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y libzip-dev \
  && apt-get install -y zlib1g-dev mariadb-client \
  && docker-php-ext-install zip pdo_mysql

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html

COPY . .

EXPOSE 8000

RUN composer install \
    && composer install --no-progress --no-dev \
    && php artisan config:clear

CMD ["php","artisan","serve","--host","0.0.0.0", "--port", "8000"]
