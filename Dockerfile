FROM php:8.0-apache
COPY . /var/www/html/
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN a2enmod rewrite
