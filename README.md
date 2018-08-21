```
composer install
mkdir -p storage/logs storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views

chmod -R 777 storage
cp .env.example  .env
php artisan key:generate
php artisan migrate
php artisan db:init

```
登陆账号
yaoyao
123456






