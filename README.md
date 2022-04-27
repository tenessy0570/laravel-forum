# Installation

```shell
mkdir laravel_forum
cd laravel_forum
git clone https://github.com/tenessy0570/laravel-forum.git
cd larave-forum
composer install
composer update
```
unpack all project files to xampp/htdocs,
run apache/mysql server and or

```shell
# current dir: xampp/htdocs/
php artisan migrate
```
or use database sql dump
```shell
/database/DUMP.v.3.0.sql
```