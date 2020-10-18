#!/bin/sh

apt-get install -y --no-install-recommends \
    acl \
    bash \
    ca-certificates \
    cron \
    curl \
    imagemagick \
    git \
    gnupg \
    less \
    libmagickwand-dev \
    libmemcached-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libxslt1.1 \
    libxslt-dev \
    libzip-dev \
    unzip \
    wget \
    zlib1g-dev

rm -rf /var/lib/apt/lists/*