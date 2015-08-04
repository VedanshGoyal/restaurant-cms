
refreshDB:
	php artisan migrate:reset
	php artisan migrate --seed

refreshAutoloader:
	composer dumpautoload
	php artisan optimize

test:
	phpunit
