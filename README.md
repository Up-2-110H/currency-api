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

# PARSING DATA
PARSE_URL=http://www.cbr.ru/scripts/XML_daily.asp
~~~

Выполнить:

~~~
yii migrate
~~~

Тестирование
------------

~~~
vendor/bin/codecept run
~~~

Использование
------------

Обновление данных в бд по PARSE_URL
~~~
yii currency
или
yii currency/update
~~~

Получение списка курсов валют
~~~
GET /currencies
GET /currencies/:page_num
~~~

Получение курса валюты по его id
~~~
GET /currency/:id
~~~