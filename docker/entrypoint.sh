#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

# Run common commands
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

role=${CONTAINER_ROLE:-app}

case "$role" in
    "app")
        php artisan serve --port=$PORT --host=127.0.0.1 --env=.env
        exec docker-php-entrypoint "$@"
        ;;
    "queue")
        echo "Running the queue ... "
        php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
        ;;
    *)
        echo "Unknown role: $role"
        ;;
esac