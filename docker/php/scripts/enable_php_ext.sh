#!/bin/sh

docker-php-ext-install \
    bcmath \
    dba \
    gd \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    soap \
    xml \
    xmlrpc \
    xsl \
    zip
docker-php-ext-enable \
    bcmath \
    dba \
    gd \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    soap \
    xml \
    xmlrpc \
    xsl \
    zip

pecl install xdebug-2.9.1

docker-php-ext-enable xdebug
