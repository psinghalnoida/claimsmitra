FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        mariadb-client \
        mariadb-server \
        php8.3 \
        php8.3-bcmath \
        php8.3-cli \
        php8.3-curl \
        php8.3-gd \
        php8.3-intl \
        php8.3-mbstring \
        php8.3-mysqli \
        php8.3-xml \
        php8.3-zip \
    && rm -rf /var/lib/apt/lists/*
