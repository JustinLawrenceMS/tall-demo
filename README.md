
Here are instructions for deploying this app to localhost


1. ``git clone /github/url``
2. navigate to app root  ``cd /path/to/app ``
3. run ``composer install``
4. configure database with test user and schema
5. run ``php artisan migrate``
6. run ``php artisan key:generate``
7. run ``npm install``
8. run ``npm run dev``
9. run ``php artisan storage:link``
10. run ``php artisan db:seed --class=UserSeeder``

