#!/bin/sh

# Garantir permissões corretas
chmod -R 775 /application/storage

# Cria link simbólico para pasta storage (idempotente)
php artisan storage:link 2>/dev/null || true

# Iniciar nginx, php-fpm e queue worker via supervisor
exec supervisord -c /etc/supervisor.d/supervisord.ini
