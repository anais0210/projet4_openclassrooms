FROM php:7.2-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y $PHPIZE_DEPS make curl git g++ mysql-client openssh-client libxml2 libxml2-dev zip unzip
RUN docker-php-ext-install bcmath intl mbstring opcache pcntl pdo pdo_mysql

ENV APACHE_DOCUMENT_ROOT /var/www/html/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


WORKDIR /var/www/html
