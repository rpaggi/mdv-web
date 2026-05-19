FROM composer:2.2 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

FROM node:16 AS node-builder

WORKDIR /app

COPY package.json package-lock.json* vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
COPY tailwind.config.js postcss.config.js ./

COPY --from=composer-builder /app/vendor ./vendor

RUN npm install
RUN npm run build
RUN ls -la public/build/ || echo "Build directory not found"
RUN find public -name "*.css" || echo "No CSS files found"

FROM php:8.1-fpm-alpine

WORKDIR "/application"

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx \
    autoconf \
    libtool \
    build-base \
    libzip-dev \
    freetype-dev \
    jpeg-dev \
    oniguruma-dev \
    icu-dev \
    bash

RUN docker-php-ext-install pdo pdo_mysql bcmath xml zip mbstring intl exif sockets \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install redis && docker-php-ext-enable redis

RUN mkdir -p /etc/supervisor.d/ /var/log/supervisor/ \
    && chown -R root:root /etc/supervisor.d/ \
    && chown -R www-data:www-data /var/log/supervisor/ \
    && chmod -R 755 /var/log/supervisor/

COPY docker/supervisor/supervisord.ini /etc/supervisor.d/supervisord.ini
RUN chmod 644 /etc/supervisor.d/supervisord.ini

COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
RUN mkdir -p /run/nginx

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY . .
COPY --from=node-builder /app/public/build ./public/build
COPY --from=composer-builder /app/vendor ./vendor

RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data . \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 755 /application/public

RUN { \
    echo '[www]'; \
    echo 'user = www-data'; \
    echo 'group = www-data'; \
    echo 'listen = 9000'; \
    echo 'pm = dynamic'; \
    echo 'pm.max_children = 5'; \
    echo 'pm.start_servers = 2'; \
    echo 'pm.min_spare_servers = 1'; \
    echo 'pm.max_spare_servers = 3'; \
    echo 'clear_env = no'; \
    echo 'catch_workers_output = yes'; \
    echo 'decorate_workers_output = no'; \
    echo 'access.log = /proc/self/fd/2'; \
    echo 'access.format = "%R - %u %t \"%m %r%Q%q\" %s %f %{mili}d %{kilo}M %C%%"'; \
    echo 'php_admin_value[error_log] = /proc/self/fd/2'; \
    echo 'php_admin_flag[log_errors] = on'; \
} > /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /run/php \
    && chmod 775 /run/php

COPY docker/entrypoint.sh /etc/entrypoint.sh
RUN chmod +x /etc/entrypoint.sh \
    && chown root:root /etc/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["sh", "/etc/entrypoint.sh"] 
