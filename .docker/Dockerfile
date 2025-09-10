FROM php:8.2.23RC1-apache-bullseye

MAINTAINER Anupam Tiwari <vishtwr01@gmail.com>

ARG apache_user
ARG USER_ID
ENV APACHE_RUN_USER=$apache_user

RUN adduser --uid $USER_ID --gecos 'My Apache User' --disabled-password $APACHE_RUN_USER \
             && chown -R "$APACHE_RUN_USER:$APACHE_RUN_GROUP" /var/lock/apache2 /var/run/apache2 /var/www/html

RUN apt-get update
RUN apt-get install -y cron
RUN apt-get install -y gzip
RUN apt-get install -y libbz2-dev
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libicu-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libsodium-dev
RUN apt-get install -y libssh2-1-dev
RUN apt-get install -y libxslt1-dev
RUN apt-get install -y lsof
RUN apt-get install -y vim
RUN apt-get install -y zip

#RUN docker-php-ext-configure \
#  gd --with-freetype-dir=/usr/include/ --with-jpeg --with-pdo-mysql=/usr/include/ --with-mysqli=/usr/include/

RUN apt-get install -y zip libonig-dev libzip-dev

#RUN docker-php-ext-install \
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install bz2
RUN docker-php-ext-install calendar
RUN docker-php-ext-install exif
RUN docker-php-ext-install gd
RUN docker-php-ext-install gettext
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install soap
RUN docker-php-ext-install sockets
RUN docker-php-ext-install sysvmsg
RUN docker-php-ext-install sysvsem
RUN docker-php-ext-install sysvshm
RUN docker-php-ext-install xsl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo

RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN a2enmod rewrite

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
