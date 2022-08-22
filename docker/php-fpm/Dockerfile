# See https://github.com/docker-library/php/blob/master/7.1/fpm/Dockerfile
FROM php:8.0-fpm
ARG TIMEZONE

MAINTAINER Maxence POUTORD <crash.strelkov@gmail.com>

RUN apt-get update && apt-get install -y \
    openssl \
    supervisor \
    git \
    unzip

#install Redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

# Type docker-php-ext-install to see available extensions
RUN apt-get update \
    && apt-get install -y \
    && docker-php-ext-install mysqli pdo_mysql

RUN apt-get update && apt-get install -y libpng-dev
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

#RUN docker-php-ext-configure gd \
#    --with-gd \
#    --with-webp-dir \
#    --with-jpeg-dir \
#    --with-png-dir \
#    --with-zlib-dir \
#    --with-xpm-dir \
#    --with-freetype-dir \
#    --enable-gd-native-ttf

#RUN docker-php-ext-install gd

#install some base extensions
#RUN apt-get install -y \
#        libzip-dev \
#        zip \
#  && docker-php-ext-configure zip --with-libzip \
#  && docker-php-ext-install zip

WORKDIR /var/www/
