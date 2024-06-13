serve:
	php artisan serve

refresh_db:
	php artisan migrate:refresh --seed

migrate:
	php artisan migrate

status_db:
	php artisan migrate:status

new_translation:
	touch lang/{ar,en}/$(name).php

folder:
	explorer.exe .