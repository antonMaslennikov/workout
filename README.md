composer install
npm i
php artisan jwt:secret
php artisan migrate

# создание ролей и супер-пользователя
php artisan db:seed --class=UserSeeder

# для создания фейковых упраженений
php artisan db:seed --class=ActivitieSeeder

# сборка статики
npm run watch