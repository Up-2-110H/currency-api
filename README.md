Необходимо
------------

Минимальное требование проекта, чтобы ваш веб-сервер поддерживал PHP 7.4.


Установка
------------

Выполнить:

~~~
git clone https://github.com/Up-2-110H/currency-api.git
composer install
~~~

Переименовать файл `.env.example` на `.env` и указать необходимые параметры:

~~~
YII_ENV=dev
YII_DEBUG=1

DB_DSN=mysql:host=localhost;dbname=dbname
DB_USER=username
DB_PASSWORD=password

TEST_YII_ENV=test
TEST_DB_DSN=mysql:host=localhost;dbname=dbname
~~~

Выполнить:

~~~
yii migrate
~~~