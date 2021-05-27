Разворачивание проекта
скопировать .env.example в .env, указать соответствующие настройки БД
настроить web-сервер, php7.3
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed (если ошибка composer dump-autoload)
npm run production
php artisan storage:link
Для работы нужно создать свое приложение ВК

В .env прописать:

настройки бд
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

настройки подключения к бергу
BERG_API_KEY=ключ
BERG_STOCK_REQUEST_URL=https://api.berg.ru/v1.0/ordering/get_stock.json
BERG_BRANDS_REQUEST_URL=https://api.berg.ru/v1.0/references/brands.json

настройки подключения к росско
ROSSKO_API_KEY_1=ключ 1
ROSSKO_API_KEY_2=ключ 2
ROSSKO_BASE_URL=http://api.rossko.ru/service/v2.1/

настройки подключения к авто-питер
AVTOPITER_USER_ID=
AVTOPITER_PASSWORD=
AVTOPITER_BASE_URL=http://autopiter-service/v2/price?WSDL

email и пароль админа
ADMIN_LOGIN=
ADMIN_PASSWORD=
