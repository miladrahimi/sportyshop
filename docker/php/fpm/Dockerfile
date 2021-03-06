FROM dockage/php:7.3-fpm-alpine3.9

ENV APP_INSTALL_DIR="/app"

RUN apk --no-cache --update add \
        composer \
        confd@testing \
        file \
        git \
        openssh-client \
        openssl \
        php7-bcmath \
        php7-ctype \
        php7-curl \
        php7-dom \
        php7-fileinfo \
        php7-gd \
        php7-gettext \
        php7-iconv \
        php7-intl \
        php7-json \
        php7-mbstring \
        php7-mcrypt \
        php7-pdo_mysql \
        php7-phar \
        php7-redis \
        php7-session \
        php7-simplexml \
        php7-soap \
        php7-tokenizer \
        php7-xml \
        php7-xmlreader \
        php7-xmlwriter \
        php7-zip \
        php7-zlib

RUN mkdir -p /root/.ssh ${APP_INSTALL_DIR} \
    # Configure PHP
    && sed -i -e "s/;date.timezone =.*/date.timezone = UTC/g" \
        -e "s/;always_populate_raw_post_data = -1/always_populate_raw_post_data = -1/g" \
        -e "s/upload_max_filesize = .*/upload_max_filesize = 0/g" \
        -e "s/post_max_size = .*/post_max_size = 0/g" \
        -e "s/memory_limit = .*/memory_limit = -1/g" \
        /etc/php/7.3/php-fpm.d/www.conf \
    # Configure SSH known_hosts
    && ssh-keyscan -H github.com gitlab.com >> /root/.ssh/known_hosts

WORKDIR ${APP_INSTALL_DIR}
