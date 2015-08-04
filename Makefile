
refreshDB:
	php artisan migrate:reset
	php artisan migrate --seed

test:
	phpunit
