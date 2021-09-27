#cp .env.example .env
composer install

php artisan optimize

php artisan migrate

php artisan optimize
