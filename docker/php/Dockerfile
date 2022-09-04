FROM php:7.4-fpm

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
ENV PHP_MEMORY_LIMIT=1024M
#RUN echo $PHP_MEMORY_LIMIT

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/testrec

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "youssef.abdallah0505@gmail.com" \ 
    && git config --global user.name "youssefabdallah"


RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Africa/Tunis /etc/localtime
RUN "date"

COPY . /var/www/testrec/
COPY composer.json /var/www/testrec
RUN composer install 

#CMD [ "php bin/console server:run" ]