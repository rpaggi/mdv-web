#!/bin/sh

# Garantir que as dependências estejam instaladas
composer install --no-interaction --optimize-autoloader

# Garantir permissões corretas
chmod -R 777 /application/storage

# Iniciar supervisor em segundo plano
supervisord -c /etc/supervisor.d/supervisord.ini &

# Iniciar PHP-FPM em primeiro plano
exec php-fpm 